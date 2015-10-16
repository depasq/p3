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
        $pic = 'https://randomuser.me/api/portraits/med/lego/'.rand(0, 9).'.jpg';
        $faker = Faker::create();
        $name = $faker->firstName .' '. $faker->lastName;
        $email = $faker->email;
        $address = $faker->streetAddress.', '.$faker->city.', '.$faker->stateAbbr;
        $phone = $faker->phoneNumber;

        #don't include any of the optional params by default
        return view('devbf/user')
          ->with('pic', $pic)
          ->with('name', $name)
          ->with('email', $email)
          ->with('address', $address)
          ->with('phone', $phone)
          ->with('bday', 0)
          ->with('emp', 0)
          ->with('blurb', 0);
    }

    public function postUser(Request $request)
    {
        //This validation ensures that the form entries are boolean 1 or 0 values
        $this->validate($request, [
            'birthday' => 'boolean',
            'company' => 'boolean',
            'blurb' => 'boolean'
        ]);

        $pic = 'https://randomuser.me/api/portraits/med/lego/'.rand(0, 9).'.jpg';
        $faker = Faker::create();
        $name = $faker->firstName .' '. $faker->lastName;
        $email = $faker->email;
        $address = $faker->streetAddress.', '.$faker->city.', '.$faker->stateAbbr;
        $phone = $faker->phoneNumber;

        if ($request['birthday'] == 1) {
            $bday = $faker->date($format = 'Y-m-d');
        } else {
            $bday = 0;
        }
        if ($request['company'] == 1) {
            $emp = $faker->company;
        } else {
            $emp = 0;
        }
        if ($request['blurb'] == 1) {
            $blurb = $faker->catchPhrase;
        } else {
            $blurb = 0;
        }

        return view('devbf/user')
          ->with('pic', $pic)
          ->with('name', $name)
          ->with('email', $email)
          ->with('address', $address)
          ->with('phone', $phone)
          ->with('bday', $bday)
          ->with('emp', $emp)
          ->with('blurb', $blurb);
    }
}
