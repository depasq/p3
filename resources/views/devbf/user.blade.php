@extends('layouts.master')

@section('title')
    User Generator
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
  use Faker\Factory as Faker;
  
  $faker = Faker::create();
  echo $faker->name;      // ID number
  echo $faker->email; // Citizen ID number
?>
@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
@stop
