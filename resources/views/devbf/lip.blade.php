@extends('layouts.master')

@section('title')
    Lorem-Ipsum Generator
@stop

@section('head')
@stop


@section('content')
<div class="header">
      <h1>Lorem Ipsum Generator</h1>
</div>

<div class="content">
  <p>Use the form below to generate Lorem Ipsum text and then copy the text to the clipboard.</p>
  <a class="pure-button" href="/">Go Back</a>
  <hr class="rule"/>
<div class="pure-g">
  <div class="pure-u-1-3">
    {!! Form::open(['url' => 'lip', 'class' => 'pure-form pure-form-aligned'] ) !!}
        <div class="pure-control-group">
        {!! Form::label('numGraphs', 'Number of Paragraphs') !!}
        {!! Form::selectRange('numGraphs', 1,8, $numGraphs) !!}
       </div>
        <div class="pure-control-group">
        {!! Form::label('numSent', 'Sentences per Paragraph') !!}
        {!! Form::selectRange('numSent', 2, 8, $numSent) !!}
       </div>
       <div class="pure-controls">
        {!! Form::submit('Generate Text!', ['class' => 'pure-button pure-button-primary']) !!}
       </div>
        {!! Form::close() !!}
    <button id="copy-button" class="pure-button pure-button-primary" data-clipboard-target="cbtext" title="Click to copy me.">Copy to Clipboard</button>
      <script src="js/ZeroClipboard.js"></script>
      <script src="js/copy.js"></script>
  </div>

  <div class="pure-u-1-2 extend">
    <p id="cbtext">

      @if(count($errors) > 0)
          <ul id="error">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      @endif

      @for($i=0; $i < count($graphs); $i++)
        {!! $graphs[$i] !!}<br/><br/>
      @endfor

    </p>
  </div>
  </div>
</div>

@stop

@section('body')
@stop
