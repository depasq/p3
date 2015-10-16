@extends('layouts.master')

@section('title')
    Developer's Best Friend
@stop

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
    {{-- <link href="/css/books/show.css" type='text/css' rel='stylesheet'> --}}
@stop


@section('content')
  <div class="header">
      <h1>Developer's Best Friend</h1>
  </div>

  <div class="content">
        <p>A collection of useful generator tools for web development.</p>
        <div class="pure-controls">
          <a class="pure-button" href="/lip">Lorem Ipsum</a>
          <a class="pure-button" href="/user">Random User</a>
          <a class="pure-button" href="/colors">Color Palette</a>
          {{-- <a class="pure-button" href="/pwdgen">Password</a> --}}
        </div>
  </div>
@stop


{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
    {{-- <script src="/js/books/show.js"></script> --}}
@stop
