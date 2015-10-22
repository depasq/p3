<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

class LipController extends Controller
{
    public function getLip()
    {
      //The default view shows the user where text will appear
        $graphs = array(0 => 'Lorem Ipsum text will appear here.');
        return view('devbf/lip')
          ->with('graphs', $graphs)
          ->with('numGraphs', 1)
          ->with('size', 's');
    }

    public function postLip(Request $request)
    {
        // Validate the request data
        // This validation will prevent anyone from maliciously entering
        // very large numbers into the field
        $this->validate($request, [
            'numGraphs' => 'numeric|max:8',
        ]);

        $graphs=array();
        $faker = Faker::create();

        // Set the number of sentences per paragraph
        if ($request['size'] == 's') {
            $numSent = 2;
        } elseif ($request['size'] == 'm') {
            $numSent = 4;
        } elseif ($request['size'] == 'l') {
            $numSent = 8;
        }
        // Generate the paragraphs array
        for ($x=0; $x <= $request['numGraphs']-1; $x++) {
              $graphs[$x] = $faker->paragraph($nbSentences = $numSent);
        }
        //Return the paragraphs and settings used for the form elements
        return view('devbf/lip')
          ->with('graphs', $graphs)
          ->with('numGraphs', $request['numGraphs'])
          ->with('size', $request['size']);
    }
}
