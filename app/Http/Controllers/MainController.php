<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
         //return 'List all the books DUDE';
        return view('test');
    }

    /**
       * Responds to requests to GET /books/show/{id}
       */
    // public function getShow($test = null) {
    //
    //     return view('test.show')->with('test', $test);
    //
    // }
}
