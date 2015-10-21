<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Faker\Factory as Faker;

class UserController extends Controller
{

    public function getUser()
    {
        #Open the page with random user already there
        $pic = 'img/lego/'.rand(0, 9).'.jpg';
        $faker = Faker::create();
        $userAr[0] = array(
          "Name" => $faker->firstName .' '. $faker->lastName,
          "Email" => $faker->email,
          "Address" => $faker->streetAddress.', '.$faker->city.', '.$faker->stateAbbr,
          "Phone" => $faker->phoneNumber,
          "Birthday" => 'Null',
          "Employer" => 'Null',
          "Phrase" => 'Null',
        );

        $json_string = json_encode($userAr, JSON_PRETTY_PRINT);

        #don't include any of the optional params by default
        return view('devbf/user')
          ->with('pic', $pic)
          ->with('userAr', $userAr)
          ->with('json', $json_string);
    }

    public function postUser(Request $request)
    {
        //This validation ensures that the form entries are boolean 1 or 0 values
        $this->validate($request, [
            'birthday' => 'boolean',
            'company' => 'boolean',
            'phrase' => 'boolean',
            'numUsers' => 'numeric:max:5'
        ]);

        $pic = 'img/lego/'.rand(0, 9).'.jpg';
        $faker = Faker::create();
        $userAr = array();
        for ($i=0; $i<=$request['numUsers']-1; $i++) {

            $userAr[$i] = array(
              "Name" => $faker->firstName .' '. $faker->lastName,
              "Email" => $faker->email,
              "Address" => $faker->streetAddress.', '.$faker->city.', '.$faker->stateAbbr,
              "Phone" => $faker->phoneNumber,
              "Birthday" => 'Null',
              "Employer" => 'Null',
              "Phrase" => 'Null',
            );

            if ($request['birthday'] == 1) {
                $userAr[$i]['Birthday'] = $faker->date($format = 'Y-m-d');
            }
            if ($request['company'] == 1) {
                $userAr[$i]['Employer'] = $faker->company;
            }
            if ($request['phrase'] == 1) {
                $userAr[$i]['Phrase'] = $faker->catchPhrase;
            }
        }

        $json_string = json_encode($userAr, JSON_PRETTY_PRINT);

        return view('devbf/user')
          ->with('pic', $pic)
          ->with('userAr', $userAr)
          ->with('json', $json_string);
    }
}
