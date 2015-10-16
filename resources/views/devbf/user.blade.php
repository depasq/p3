@extends('layouts.master')

@section('title')
    User Generator
@stop

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
@stop


@section('content')
<div class="header">
      <h1>Random User Generator</h1>
</div>

<div class="content">
  <p>Use this generator to create random users for testing purposes.</p>
  <a class="pure-button" href="/">Go Back</a>
  <hr class="rule"/><br>

  <div class="pure-g">
    <div class="pure-u-1-3">
      Optional Includes:
      {!! Form::open(['url' => 'user', 'class' => 'pure-form pure-form-aligned'] ) !!}
      <fieldset>
           <div class="pure-control-group">
            {!! Form::label('birthday', 'Birthday') !!}
            {!! Form::checkbox('birthday', 1) !!}
          </div>
          <div class="pure-control-group">
            {!! Form::label('company', 'Employer') !!}
            {!! Form::checkbox('company', 1) !!}
          </div>
          <div class="pure-control-group">
            {!! Form::label('blurb', 'Phrase') !!}
            {!! Form::checkbox('blurb', 1) !!}
          </div>
          <div class="pure-controls">
            {!! Form::submit('Generate User', ['class' => 'pure-button pure-button-primary']) !!}
          </div>
            {!! Form::close() !!}
      </fieldset>
    </div>

    <div class="pure-u-1-2">
      <div class="UserBG">
            <img src = {!!$pic!!} alt="Headshot">
            <ul class="links">
              <li><i class="fa fa-user"></i>{!!$name!!}
              </li>
              <li><i class="fa fa-envelope"></i>{!!$email!!}
              </li>
              <li><i class="fa fa-home"></i>{!!$address!!}
              </li>
              <li><i class="fa fa-phone"></i>{!!$phone!!}
              </li>
              @if ($bday != 'false')
                <li><i class="fa fa-birthday-cake"></i>{!!$bday!!}</li>
              @endif
              @if ($emp != 'false')
                <li><i class="fa fa-cog"></i>{!!$emp!!}</li>
              @endif
              @if ($blurb != 'false')
                <li><i class="fa fa-quote-right"></i>{!!$blurb!!}</li>
              @endif
            </ul>
     </div>
   </div>

  </div>
</div>

@stop
{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
@stop
