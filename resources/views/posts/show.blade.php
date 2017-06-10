@extends('main')

@section('title',$post->title)

@section('logo')
<div class="logo">
	<div class="parallax-window" data-parallax="scroll" data-image-src="{{ '../photos/shares/categories/'.$post->category->bgPostImg }}"></div>

		<script>
		 $(document).ready(function(){
		 	$('.parallax-window').parallax({imageSrc: '{{ '../photos/shares/categories/'.$post->category->bgPostImg }}'});
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
		<div class="row">
			<div class="col-sm-4">
				{{ Form::open(['route'=>['posts.publish',$post->id]]) }}
					{{ Form::submit('Publish Now!',['class'=>'btn btn-success']) }}
				{{ Form::close() }}
			</div>
		</div>
		@else
		<br><br>
		<div class="row">
			<div class="col-sm-4">
				{{ Form::open(['route'=>['posts.hide',$post->id]]) }}
					{{ Form::submit('Hide post',['class'=>'btn btn-danger']) }}
				{{ Form::close() }}
			</div>
		</div>
		@endif
		<h1 class="post-title">{{ $post->title }}</h1>
		{!! $post->body !!}
		<hr>
		{{ $post->category->name }}

        {{-- <pre class="line-numbers language-php" data-start="500">
<code>
&#x3C;?php
$servername = &#x22;localhost&#x22;;
$username = &#x22;username&#x22;;
$password = &#x22;password&#x22;;

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn-&#x3E;connect_error) {
    die(&#x22;Connection failed: &#x22; . $conn-&#x3E;connect_error);
} 
echo &#x22;Connected successfully&#x22;;
?&#x3E;
</code>
		</pre> --}}
	</div>

@endsection