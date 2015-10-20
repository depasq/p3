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
      <img src= {!! $img !!} height=300px width=300px alt='Image'>
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

</div>

@stop
{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
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
