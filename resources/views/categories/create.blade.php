@extends('main')

@section('title','Create new category')

@section('logo')
<div class="logo">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg">
	</div>

	<script>
	 $(document).ready(function(){
	 	$('.parallax-window').parallax({imageSrc: '../img/logo.jpg'});
	 });
	</script>
</div>
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
	<a href="{{ route('categories-manager.index') }}" class="font-2"><< Back to categories manager</a>
	<br>
	<br>
		{{ Form::open(['route'=>'categories-manager.store']) }}
			{{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Category name','style'=>'font-size: 1.2em;height: 45px']) }}
			<br>
			<span class="input-group-btn">
		    	<a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success btn-lg">
		   		<i class="fa fa-picture-o"></i> Upload file
		    	</a>
		    </span>
		    <script>$('#lfm').filemanager('image');</script>
			<br>
			{{ Form::label('homePostImg','Image display home page:') }}
			<br>
			{{ Form::text('homePostImg',null,['class'=>'form-control']) }}
			<br>
			{{ Form::label('bgPostImg','Image display in post background:') }}
			<br>
			{{ Form::text('bgPostImg',null,['class'=>'form-control']) }}
			<br>
			{{ Form::label('catImg','Image display in category list:') }}
			<br>
			{{ Form::text('catImg',null,['class'=>'form-control']) }}
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					{{ Form::submit('Save category',['class'=>'btn btn-lg btn-block btn-success']) }}
				</div>
			</div>
			

		{{ Form::close() }}
	</div>

@endsection