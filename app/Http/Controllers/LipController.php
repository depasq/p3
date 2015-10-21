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
          ->with('numSent', 2);
    }

    public function postLip(Request $request)
    {
          // Validate the request data
          // This validation will prevent anyone from maliciously entering
          // very large numbers into the field
        $this->validate($request, [
            'numGraphs' => 'numeric|max:8',
            'numSent' => 'numeric|max:8'
        ]);
        $graphs=array();
        $faker = Faker::create();
        for ($x=0; $x <= $request['numGraphs']-1; $x++) {
              $graphs[$x] = $faker->paragraph($nbSentences = $request['numSent']);
        }

        // Using $_POST here to maintain user selected values after submitting
        // the form. Otherwise reset to defaults.
        if (isset($_POST)) {
            $numGraphs = $_POST['numGraphs'];
            $numSent = $_POST['numSent'];
        } else {
            $numGraphs = 1;
            $numSent = 2;
        }

        return view('devbf/lip')
          ->with('graphs', $graphs)
          ->with('numGraphs', $numGraphs)
          ->with('numSent', $numSent);
    }
}
