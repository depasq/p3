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
    <div class="pure-u-1-1">
      Optional Includes:
      {!! Form::open(['url' => 'user', 'class' => 'pure-form pure-form-aligned'] ) !!}
           <div class="pure-control-group">
            {!! Form::label('birthday', 'Birthday') !!}
            {!! Form::checkbox('birthday', 1) !!}
          </div>
          <div class="pure-control-group">
            {!! Form::label('company', 'Employer') !!}
            {!! Form::checkbox('company', 1) !!}
          </div>
          <div class="pure-control-group">
            {!! Form::label('phrase', 'Phrase') !!}
            {!! Form::checkbox('phrase', 1) !!}
          </div>
          <div class="pure-control-group">
            {!! Form::label('numUsers', 'Number of Users') !!}
            {!! Form::selectRange('numUsers', 1,5) !!}
          </div>
          <div class="pure-controls">
            {!! Form::submit('Generate', ['class' => 'pure-button pure-button-primary']) !!}
            <a href="#json" class="json pure-button" onclick="toggle_visibility('json-box');">Show JSON</a>
          </div>
            {!! Form::close() !!}
          <br/>

    </div>

    <div class="pure-u-1-1">
      @for ( $i=0; $i <= count($userAr)-1; $i++  )
        <div class="UserBG">
          <div class="image-cropper">
              <img id="user-pic" src = {!! 'img/lego/'.rand(0, 9).'.jpg'; !!} alt="Headshot">
            </div>
              <ul class="links">
                <li id="tbump"><i class="fa fa-user"></i>{!!$userAr[$i]['Name']!!}
                </li>
                <li><i class="fa fa-envelope"></i>{!!$userAr[$i]['Email']!!}
                </li>
                <li><i class="fa fa-home"></i>{!!$userAr[$i]['Address']!!}
                </li>
                <li><i class="fa fa-phone"></i>{!!$userAr[$i]['Phone']!!}
                </li>
                @if ($userAr[$i]['Birthday'] != 'Null')
                  <li><i class="fa fa-birthday-cake"></i>{!!$userAr[$i]['Birthday']!!}</li>
                @endif
                @if ($userAr[$i]['Employer'] != 'Null')
                  <li><i class="fa fa-cog"></i>{!!$userAr[$i]['Employer']!!}</li>
                @endif
                @if ($userAr[$i]['Phrase'] != 'Null')
                  <li id="bbump"><i class="fa fa-quote-right"></i>{!!$userAr[$i]['Phrase']!!}</li>
                @endif
              </ul>
       </div><br/>
      @endfor

   </div>
   <div class="pure-u-1-1 json-box" id="json-box">
   <pre id="json">
       {!!$jsonAr!!}
   </pre>
 </div>
  </div>
</div>

@stop
{{--
This short javascript is used to toggle the visibility of the JSON formatted
user output.
--}}
@section('body')
<script type="text/javascript">

    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }

</script>
@stop
