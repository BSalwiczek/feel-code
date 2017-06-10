@extends('main')

@section('title','Create new quote')

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
	<a href="{{ route('quotes.index') }}" class="font-2"><< Back to quotes manager</a>
	<br>
	<br>
		{{ Form::open(['route'=>'quotes.store']) }}
			<br>
			{{ Form::label('author','Quote author:') }}
			<br>
			{{ Form::text('author',null,['class'=>'form-control']) }}
			<br>
			{{ Form::label('content','Quote Conent:') }}
			<br>
			{{ Form::textarea('content',null,['class'=>'form-control']) }}
			<br>
			<br>
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					{{ Form::submit('Save quote',['class'=>'btn btn-lg btn-block btn-success']) }}
				</div>
			</div>
			

		{{ Form::close() }}
	</div>

@endsection