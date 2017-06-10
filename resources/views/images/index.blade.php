@extends('main')

@section('title','Images')

@section('logo')
<div class="logo" style="height:300px">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg" style="height:300px">
		
		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="code">Images Manager</span>
		    </div>
		</div>
	</div>
</div>

<script>
 $(document).ready(function(){
 	$('.parallax-window').parallax({imageSrc: '../img/logo.jpg'});
 });
</script>
@endsection

@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script src="../../vendor/laravel-filemanager/js/lfm.js"></script>

<script>
var editor_config = {
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

@endsection
@section('content')
<div class="post">

@include('partials._messages')
@include('partials._adminMenu')
	<br>
	{{-- {{ Form::open(['route'=>'images.store','files'=>true]) }}
		{{Form::file('image')}}
		<br>
		{{Form::submit('Upload file',['class'=>'btn btn-lg btn-success'])}}
	{{ Form::close() }} --}}

      <span class="input-group-btn">
        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success btn-lg">
          <i class="fa fa-picture-o"></i> Upload file
        </a>
      </span>
      {{-- <input id="thumbnail" class="form-control" type="text" name="filepath"> --}}

    <img id="holder" style="margin-top:15px;max-height:100px;">
    <script>$('#lfm').filemanager('image');</script>



	<br>
	<br>
	<br>
	<br>
	<br>

</div>
@endsection

