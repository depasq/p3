@extends('layouts.master')

@section('title')
    Color Palette Generator
@stop

{{--
Load dropzone custom css for this view to format the dropzone box.
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
  <div class="pure-g">
    <div class="pure-u-1-2">
      Use a random image: <br/><br/>
      <a class="pure-button" href="/colors">Surprise me!</a><br/>
      <hr class="rule" style="width: 50%;">

      Or upload your own picture: <br/><br/>

      <div class="container">
              <div class="dropzone" id="dropzoneFileUpload">
              </div>
      </div><br/>
      <a class="pure-button" href="/colorsU">Generate Palette!</a><br/>
    </div>

    <div class="pure-u-1-2">
      Source Image: <br/><br/>
      {{--
      Check for errors on file upload before assuming there's an image to display
      --}}
      @if(count($errors) > 0)
          <h2> {!! $errors[0] !!} </h2>
      @else
              <img src= {!! $img !!} height='300' width='300' alt='Image'>
            </div>
          </div>
         <br />
        <hr class="rule">
        Color Palette:
        <br/>
        <div class="pure-g">
          <div class="pure-u-1-1">
              <div class="bar" style= {!! '"background-color: '.$colors[0].';"' !!}><br/>{!! $colors[0] !!}</div>
              <div class="bar" style= {!! '"background-color: '.$colors[1].';"' !!}><br/>{!! $colors[1] !!}</div>
              <div class="bar" style= {!! '"background-color: '.$colors[2].';"' !!}><br/>{!! $colors[2] !!}</div>
              <div class="bar" style= {!! '"background-color: '.$colors[3].';"' !!}><br/>{!! $colors[3] !!}</div>
              <div class="bar" style= {!! '"background-color: '.$colors[4].';"' !!}><br/>{!! $colors[4] !!}</div>
          </div>
        </div>
      @endif

</div>

@stop
{{--
Utilize dropzone js and the custom script to handle the file upload process
--}}
@section('body')
<script src="js/dropzone.js"></script>

<script type="text/javascript">
        var baseUrl = "{{ url('/colors') }}";
        var token = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#dropzoneFileUpload", {
            url: baseUrl,
            params: {
                _token: token
            }
        });
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 3, // MB
            uploadMultiple: false,
            addRemoveLinks: true,
            success: function(file, resposne) {
            },
        };
</script>

@stop
