<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use VitorBari\ImageToColorPalette\ColorPalette;
use Input;
use Validator;
use Response;
use Session;
use Faker\Factory as Faker;

class ColorController extends Controller
{
    public function index()
    {
        // On page load, initiate a color palette from a random image
        // provided by Faker (and lorempixel)
        $palette = new ColorPalette();
        $faker = Faker::create();
        $randomImg = $faker->image($dir = './tmp', $width = 300, $height = 300);
        $palette->set_image_file($randomImg);
        $colors = $palette->get_palette();

        return view('devbf/colors')
          -> with('colors', $colors)
          -> with('img', $randomImg);
    }

    public function upload()
    {
        //This function handles the color palette generation after a file
        // has been uploaded via Dropzone

        $palette = new ColorPalette();

        //Use validation to make sure that a file has been uploaded before
        // attemtping to generate a palette. If validation fails, regenerate
        // the default view with a helpful message.
        $validator = Validator::make(
            array('UploadFile' => session('fileName')),
            array('UploadFile' => 'required')
        );
        if ($validator->fails()) {
            $message = array("0" => "Error! Please upload a file first.");
            return view('devbf/colors')->with('errors', $message);
        }
        //Assuming validation was successful, make a color palette!
        $randomImg = session('fileName');
        $palette->set_image_file($randomImg);
        $colors = $palette->get_palette();
        session(['fileName' => ""]);
        return view('devbf/colors')
          -> with('colors', $colors)
          -> with('img', $randomImg);
    }

    public function uploadFile()
    {
        //This function handles the file upload duties from Dropzone
        // it's a little tricky working within an AJAX call in a controller!
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );
        //Validation checks for file type and size and will report an error
        // on the page if it fails.
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            $message = "Error! File must be an image that is less than 3 MB. Please try again.";
            return Response::make($message, 400);
        }
        //If validation successful, rename the file and move it into ./tmp directory
        $destinationPath = './tmp';
        $extension = Input::file('file')->getClientOriginalExtension();
        $fileName = rand(11111, 99999) . '.' . $extension;
        $filePath = $destinationPath . '/' . $fileName;
        $upload_success = Input::file('file')->move($destinationPath, $fileName);
        //If all went according to plan, the file has been uploaded, renamed and moved
        //use a session variable to store the uploaded file name so it can be accessed
        //by the upload() function above.
        session(['fileName' => $filePath]);
        return Response::json(array('success' => true), 200);
    }
}
