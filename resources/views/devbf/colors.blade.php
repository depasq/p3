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
@stop


@section('content')
<?php
  $palette = new VitorBari\ImageToColorPalette\ColorPalette();
  $palette->set_image_file('img/tycho.jpg');
  $colors = $palette->get_palette();
  echo "<pre>";
  print_r($colors);
?>
@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
@stop
