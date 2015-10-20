<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PwdController extends Controller
{
    //Define a private function for reading CSV file
    private function readCSV($infile)
    {
        $fileRead = fopen($infile, 'r');
        while (!feof($fileRead)) {
             $line[] = fgetcsv($fileRead, 1024);
        }
        fclose($fileRead);
        return $line;
    }

    //Another private function for doing the dirty work of generating the
    //password. This keeps the index and post functions very clean.
    private function processPwd($params)
    {
        $symbols = array('!','@','#','$','%','^','&','*');
        $numbers = array('0','1','2','3','4','5','6','7','8','9');
        $words = array();
        $pwdArray = array();
        $cleanArray = array();

        /*Define function to read in CSV file with information about Chandra press releases
        Searched for methods to read CSV file in php and used this:
        http://www.codedevelopr.com/articles/reading-csv-files-into-php-array/ */

        $cxcData = $this->readCSV('./cxc_sources.csv');
        //note ignore 0th element as it's the header of the CSV
        $entry = rand(1, count($cxcData)-2);
        $data = array(
          'title' => $cxcData[$entry][7],
          'source' => $cxcData[$entry][8],
          'link' => $cxcData[$entry][10],
          'headline' => $cxcData[$entry][11],
          'image' => $cxcData[$entry][12]
        );
        $content = new \DOMDocument();
        libxml_use_internal_errors(true);
        $content->loadHTML(file_get_contents($data['link']));
        $grafList = $content->getElementsByTagName('p');
        $i=0;
        foreach ($grafList as $graf) {
            if ($i <= 1) {
                $words=preg_split('/\s+/', $content->saveHTML($graf));
                $i++;
            }
        }
        /*Clean the array to filter out any special characters as well
        ignore any words with less than 4 characters */
        foreach ($words as $word) {
            if (preg_match('/^[A-z]{4,100}+$/i', $word, $matches)) {
                array_push($cleanArray, $matches[0]);
            }
        }
        for ($i=0; $i <= $params['numWords']-1; $i++) {
            if ($params['cap'] == 1) {
                array_push($pwdArray, strtoupper($cleanArray[rand(0, count($cleanArray)-1)]));
            } else {
                array_push($pwdArray, strtolower($cleanArray[rand(0, count($cleanArray)-1)]));
            }
        }
        if ($params['sym'] == 1) {
            $temp = array_pop($pwdArray) . $symbols[rand(0, 7)];
            array_push($pwdArray, $temp);
        }
        if ($params['num'] == 1) {
            $temp = array_pop($pwdArray) . $numbers[rand(0, 9)];
            array_push($pwdArray, $temp);
        }
        $output = array(
          'data' => $data,
          'pwdArray' => $pwdArray
        );
        return $output;
    }


    public function getPwd()
    {
        //This function generates the default view of the page when it's
        //first loaded. It assumes default values for the form inputs and sends
        //that to the processPwd funcion.
        $params = array(
          'numWords' => 4,
          'sep' => '-',
          'sym' => 0,
          'num' => 0,
          'cap' => 0
        );

        $result = $this->processPwd($params);

        return view('devbf/pwdgen')
          -> with('data', $result['data'])
          -> with('pwdArray', $result['pwdArray'])
          -> with('sep', $params['sep'])
          -> with('numWords', $params['numWords']);
    }

    public function postPwd(Request $request)
    {
      //Here's the form handling function processing the form requests.

      //Form validation for the number of words
        $this->validate($request, [
            'numWords' => 'numeric|max:9',
          ]);

      //Some checks on the Separator value
        if (empty($request['Separator'])) {
            $request['Separator'] = '-';
        } elseif (strlen($request['Separator']) > 1) {
            $request['Separator'] = substr($request['Separator'], 0, 1);
        }

      //Define the input array for the processPwd function and send it along.
        $params = array(
          'numWords' => $request['numWords'],
          'sep' => $request['Separator'],
          'sym' => $request['Symbol'],
          'num' => $request['Number'],
          'cap' => $request['Capital']
        );

        $result = $this->processPwd($params);

        return view('devbf/pwdgen')
          -> with('data', $result['data'])
          -> with('pwdArray', $result['pwdArray'])
          -> with('sep', $request['Separator'])
          -> with('numWords', $request['numWords']);
    }
}
