<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

class UserController extends Controller
{

    private function makeUsers($numUsers, $bday, $company, $phrase)
    {
        $faker = Faker::create();
        for ($i=0; $i<=$numUsers-1; $i++) {
              $userAr[$i] = array(
                  "Name" => $faker->firstName .' '. $faker->lastName,
                  "Email" => $faker->email,
                  "Address" => $faker->streetAddress.', '.$faker->city.', '.$faker->stateAbbr,
                  "Phone" => $faker->phoneNumber,
                  "Birthday" => 'Null',
                  "Employer" => 'Null',
                  "Phrase" => 'Null',
            );
            if ($bday == 1) {
                $userAr[$i]['Birthday'] = $faker->date($format = 'Y-m-d');
            }
            if ($company == 1) {
                $userAr[$i]['Employer'] = $faker->company;
            }
            if ($phrase == 1) {
                $userAr[$i]['Phrase'] = $faker->catchPhrase;
            }
        }
        return($userAr);
    }

    public function getUser()
    {
        #Open the page with random user already there
        #don't include any of the optional params by default
        $userAr = $this->makeUsers(1, 0, 0, 0);
        $jsonAr = json_encode($userAr, JSON_PRETTY_PRINT);

        return view('devbf/user')
          ->with('userAr', $userAr)
          ->with('jsonAr', $jsonAr);
    }

    public function postUser(Request $request)
    {
        //This validation ensures that the form entries are boolean 1 or 0 values
        //and the number of users is between 1 and 5
        $this->validate($request, [
            'birthday' => 'boolean',
            'company' => 'boolean',
            'phrase' => 'boolean',
            'numUsers' => 'numeric|min:1|max:5'
        ]);

        $userAr = $this->makeUsers($request['numUsers'], $request['birthday'], $request['company'], $request['phrase']);
        $jsonAr = json_encode($userAr, JSON_PRETTY_PRINT);

        return view('devbf/user')
          ->with('userAr', $userAr)
          ->with('jsonAr', $jsonAr);
    }
}
