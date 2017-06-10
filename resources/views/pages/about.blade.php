@extends('main')

@section('title','About Me')

@section('logo')
<div class="logo">
	<div class="parallax-window post-bg" data-parallax="scroll" data-image-src="../img/me.jpg">

	</div>

	<script>
	 $(document).ready(function(){
	 	$('.parallax-window').parallax({imageSrc: '../img/me.jpg'});
	 });
	</script>
</div>
@endsection

@section('content')
<div class="post">
	@include('partials._messages')
	<h1 style="text-align:center" >About Me</h1>
	<hr>
	<br>
	Hello ! I'm Bartosz Salwiczek, 16 years old guy from Poland. I'm really glad that you visit my blog and you want to improve your programming skills. My first programming experience was when I was 11 - I wrote simple app using Scratch. Since then I've fallen in love with programming. I mostly enjoy web development, especially back-end (this page was created in Laravel framework). I hope you'll find some useful content on feel-code.com blog. Feel free to give me your feedback. You can email me on: bartoszsalwiczek@gmail.com or write directly from contact form:
	<br><br>

	<h2 class="text-center" style="margin-top: 50px" >Contact</h2>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
		{{ Form::open(['route'=>'send-about']) }}
		{{ Form::label('name','Name:') }}
		{{ Form::text('name',null,['class'=>'form-control','required'=>'']) }}
		{{ Form::label('email','Email:',['style'=>'margin-top: 20px']) }}
		{{ Form::text('email',null,['class'=>'form-control','required'=>'']) }}
		{{ Form::label('subject','Subject:',['style'=>'margin-top: 20px']) }}
		{{ Form::text('subject',null,['class'=>'form-control','required'=>'']) }}
		{{ Form::label('message','Message:',['style'=>'margin-top: 20px']) }}
		{{ Form::textarea('message',null,['class'=>'form-control','data-autoresize','required'=>'']) }}
		
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				{{ Form::submit('Send',['class'=>'btn btn-lg btn-success btn-block','style'=>'margin-top: 40px']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
	
</div>
<script>
//autoresize textarea
jQuery.each(jQuery('textarea[data-autoresize]'), function() {
    var offset = this.offsetHeight - this.clientHeight;
 
    var resizeTextarea = function(el) {
        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    };
    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
});
</script>
@endsection