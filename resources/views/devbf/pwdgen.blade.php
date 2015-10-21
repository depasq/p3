@extends('layouts.master')

@section('title')
    Password Generator
@stop

@section('head')
@stop

@section('content')

<div class="header">
<h1><a class="head-link" href="https://xkcd.com/936/" target="_blank">xkcd-Style</a> Password Generator v2.0</h1>
</div><br>
<div class="content">
  <a class="pure-button" href="/">Go Back</a><br><br>
  <div class="pwd-block">
    Random Password:<br>
    <div class="pwd">
    {!!implode($sep, $pwdArray)!!}
   </div>
  </div>
  <div class="pure-g">
    <div class="pure-u-1-3">

      {!! Form::open(['url' => 'pwdgen', 'class' => "pure-form pure-form-aligned " ]) !!}
        <div class="pure-control-group">
          {!! Form::label('numWords', '# of Words (4-9)') !!}
          {!! Form::selectRange('numWords', 4, 9) !!}
        </div>
        <div class="pure-control-group">
          {!! Form::label('Separator', 'Seperator (default: -)') !!}
          {!! Form::text('Separator', '-', array('class'=>'pure-input')) !!}
        </div>
        <div class="pure-control-group">
          {!! Form::label('Symbol', 'Add a Symbol?') !!}
          {!! Form::checkbox('Symbol', 1) !!}
        </div>
        <div class="pure-control-group">
          {!! Form::label('Number', 'Add a Number?') !!}
          {!! Form::checkbox('Number', 1) !!}
        </div>
        <div class="pure-control-group">
          {!! Form::label('Capital', 'Capitalize?') !!}
          {!! Form::checkbox('Capital', 1) !!}
        </div>
        <div class="pure-controls">
          {!! Form::submit('Generate Password', ['class' => 'pure-button pure-button-primary']) !!}
        </div>
      {!! Form::close() !!}

    <img class="pure-img-responsive" src="./img/craft.jpg" alt="Chandra">
  </div>
  <div class="pure-u-1-2">
    Learn more:<br><a class="head-link" href= {!! $data['link'] !!} target="_blank"> {!! $data['title'] !!}</a>
    <img class="pure-img-responsive" src={!! $data['image'] !!} alt= {!! '"'.$data['source'].'"' !!} >
  </div>
</div>
  <div class="footer">
    <p>The <a class="head-link" href="https://xkcd.com/936/" target="_blank">xkcd comic</a> that inspired this tool shows that passwords
    composed of random words are easier to remember, yet harder for brute-force method attacks to guess.  This astronomically-biased password
    generator sources the text of a randomly selected press release from the Chandra X-ray Observatory's
    <a class="head-link" href="http://chandra.si.edu" target="_blank">public website</a>.</p>
  </div>
</div>

@stop

@section('body')
@stop
