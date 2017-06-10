@extends('main')


@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
 <script src="../../vendor/laravel-filemanager/js/lfm.js"></script>

<script>
var editor_config = {
    path_absolute : "/",
    selector: "textarea",
    content_css: "../../css/tinymce_config.css",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern autoresize"
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

@section('title',$post->title.'| Edit')

@section('logo')
<div class="logo">
	<div class="parallax-window" data-parallax="scroll" data-image-src="{{ '../../photos/shares/categories/'.$post->category->bgPostImg }}"></div>

		<script>
		 $(document).ready(function(){
		 	$('.parallax-window').parallax({imageSrc: '{{ '../../photos/shares/categories/'.$post->category->bgPostImg }}'});
		 });
		</script>
</div>
@endsection

@section('content')
	
	<div class="post">
		<a href="{{ route('posts.index') }}" class="font-2"><< Back to posts manager</a>
		@if($post->status==0)
		<br>
		<br>
			<div class="alert alert-danger">
				Post is not published yet
			</div>
		@endif
		{{ Form::open(['route'=>['posts.update',$post->id],'method'=>'PUT']) }}
		{{ Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title','style'=>'font-size:3.5em;height:90px;text-align:center']) }}
		<br>
		{{ Form::textarea('body',$post->body,['class'=>'form-control body-textarea','placeholder'=>'Body','data-autoresize'=>'']) }}
		<br>
		{{ Form::text('slug',$post->slug,['class'=>'form-control','placeholder'=>'Slug']) }}
		<br>
		{{ Form::select('category_id',$categories,$post->category->id,['class'=>'form-control']) }}
		<br>
	    {{ Form::label('home_body','Home body(displayed on home site):') }}
	    {{ Form::textarea('home_body',$post->home_body,['class'=>'form-control','data-autoresize'=>'']) }}
		<br>
	    {{ Form::text('tags',$post->tags,['class'=>'form-control','placeholder'=>'Tags']) }}
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				{{ Form::submit('Save changes',['class'=>'btn btn-lg btn-success btn-block']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>

	<script>
		jQuery.each(jQuery('textarea[data-autoresize]'), function() {
	    var offset = this.offsetHeight - this.clientHeight;
	 
	    var resizeTextarea = function(el) {
	        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
	    };
	    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
	});
	</script>
	
@endsection