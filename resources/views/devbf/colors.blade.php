@extends('layouts.master')

@section('title')
    Color Palette Generator
@stop

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
<link rel="stylesheet" href="css/dropzone.css">
@stop


@section('content')
<div class="header">
      <h1>Color Palette From Image Generator</h1>
</div>

<div class="content">
  <p>Use this generator to create a color palette from either a random image or one that you upload.</p>
  <a class="pure-button" href="/">Go Back</a>
  <hr class="rule"/>
  <div id="dropzone">
    {!! Form::open(['url' => '/colors', 'files'=>'true', 'data-ajax' => 'true', 'class' => 'dropzone', 'id' => "my-awesome-dropzone" ] ) !!}
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    {!! Form::close() !!}
  </div>

<!--<?php
  $palette = new VitorBari\ImageToColorPalette\ColorPalette();
  $palette->set_image_file('img/tycho.jpg');
  $colors = $palette->get_palette();
  echo "<pre>";
  print_r($colors);
?>-->
@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
<script src="js/dropzone.js"></script>
@stop
