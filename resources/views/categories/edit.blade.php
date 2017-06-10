@extends('main')

@section('title','Edit category')

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

@section('content')

	<div class="post">
	<a href="{{ route('categories-manager.index') }}" class="font-2"><< Back to categories manager</a>
	<br>
	<br>
		{{ Form::open(['route'=>['categories-manager.update',$category->id],'method'=>'PUT','files'=>true]) }}
			{{ Form::text('name',$category->name,['class'=>'form-control','placeholder'=>'Category name','style'=>'font-size: 1.2em;height: 45px']) }}
			<br>
			{{ Form::label('homePostImg','Image display home page:') }}
			<br>
			{{ Form::text('homePostImg',$category->homePostImg,['class'=>'form-control']) }}
			<br>
			{{ Form::label('bgPostImg','Image display in post background:') }}
			<br>
			{{ Form::text('bgPostImg',$category->bgPostImg,['class'=>'form-control']) }}
			<br>
			{{ Form::label('catImg','Image display in category list:') }}
			<br>
			{{ Form::text('catImg',$category->catImg,['class'=>'form-control']) }}
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