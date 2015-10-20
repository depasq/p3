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
use Redirect;
use Session;
use Faker\Factory as Faker;

class ColorController extends Controller
{
    public function index()
    {
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
        $palette = new ColorPalette();
        $randomImg = session('fileName');
        $palette->set_image_file($randomImg);
        $colors = $palette->get_palette();

        return view('devbf/colors')
          -> with('colors', $colors)
          -> with('img', $randomImg);
    }

    public function uploadFile()
    {
        $palette = new ColorPalette();
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }

        $destinationPath = './tmp'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $filePath = $destinationPath . '/' . $fileName;
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        //View::share('fileName', $fileName);

        if ($upload_success) {
            //return Response::json('success', 200);
            session(['fileName' => $filePath]);
            return Response::json(array('success' => true, 'fileName' => $fileName), 200);
            //return Redirect::route('/colorsU')->with('fileName', $fileName);
        } else {
            return Response::json('error', 400);
        }
    }
}
