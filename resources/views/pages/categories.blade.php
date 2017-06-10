@extends('main')

@section('title','Categories')

@section('logo')
{{-- <div class="logo">
	<div class="parallax-window post-bg" data-parallax="scroll" data-image-src="../img/categories.png">

	</div>

	<script>
	 $(document).ready(function(){
	 	$('.parallax-window').parallax({imageSrc: '../img/categories.png'});
	 });
	</script>
</div> --}}
@endsection

@section('content')
	<div class="post">

		
		<div class="row">
			<h1 style="text-align:center">Categories</h1>
			<hr>
			<br>
			@foreach($categories as $category)
			<a href=""><div class="col-sm-4 col-lg-3 category" >
				
				<img src="photos/shares/categories/{{ $category->catImg }}" class="img-responsive cat-img">
				<div class="cat-name">{{$category->name}}</div>

			</div></a>
			@endforeach
		</div>
		<script>
			$('document').ready(function(){
				var h = $('img.cat-img').css("height");
				var w = $('img.cat-img').css('width');
				$('.cat-name').css({'height':h,'width':w,'top':'-'+h});
			})
			$(window).resize(function(){
				var h = $('img.cat-img').css("height");
				var w = $('img.cat-img').css('width');
				$('.cat-name').css({'height':h,'width':w,'top':'-'+h});
			})
		</script>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
@endsection