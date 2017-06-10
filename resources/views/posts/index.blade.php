@extends('main')

@section('title','All posts')

@section('logo')
<div class="logo" style="height:300px">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg" style="height:300px">
		
		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="code">Posts Manager</span>
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


@section('content')
<div class="post">
@include('partials._messages')
@include('partials._adminMenu')
	<br>
	<a href="{{ route('posts.create') }}" class="btn btn-lg btn-success" >Create new post</a>
	<br>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Name</th>
			<th>Body</th>
			<th>Slug</th>
			<th style="text-align:center">Published</th>
			<th style="min-width: 110px"></th>
		</thead>
		<tbody>
			@foreach($posts as $post)
			<tr>
				<th>{{ $post->id }}</th>
				<td>{{ $post->title }}</td>
				<td style="max-width: 400px">{!! (strlen(strip_tags($post->body))>200)?substr(strip_tags($post->body),0,200):strip_tags($post->body) !!}</td>
				<td>{{ $post->slug }}</td>
				<td style="text-align:center">
				@if($post->status==0)
					<span style="color:red">No</span>
				@else
					<span style="color:green">Yes</span>
				@endif
				</td>
				<td style="text-align: right">
					<a class="glyphicon glyphicon-eye-open option-a-glyphicon" style="margin-left: 5px" href="{{ route('posts.show',['id'=>$post->id]) }}"></a>
					<a class="glyphicon glyphicon-edit option-a-glyphicon" style="margin-left: 5px" href="{{ route('posts.edit',['id'=>$post->id]) }}"></a>
					<button type="button" class="glyphicon glyphicon-trash option-a-glyphicon deletePost" data-toggle="modal" data-target="#destroyModal{{$post->id}}" style="margin-left: 5px" href=""></button>
					{{-- {{ route('posts.destroy',['id'=>$post->id]) }} --}}
				</td>
				<div class="modal fade" id="destroyModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePost">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Are you sure to delate this post ?</h4>
				      </div>
				      <div class="modal-body">
				       


						{!! Form::open(['route'=>['posts.destroy',$post->id],'method'=>'DELETE']) !!}
							 <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							{{ Form::submit('Yes',['class'=>'btn btn-danger']) }}

						{!! Form::close() !!}


				       {{--  <a href="{{ route('posts.destroy',['id'=>$post->id,'method'=>'DELETE']) }}"><button type="button" class="btn btn-danger">Yes</button></a> --}}
				      </div>
				    </div>
				  </div>
				</div>
			</tr>
			@endforeach
		</tbody>
	</table>
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


<!-- Modal -->

</div>
@endsection

