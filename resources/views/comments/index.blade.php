@extends('main')

@section('title','All comments')

@section('logo')
<div class="logo" style="height:300px">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg" style="height:300px">
		
		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="code">Comments Manager</span>
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
	<br>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Post</th>
			<th>Author</th>
			<th>Email</th>
			<th>Body</th>
			<th style="min-width: 200px">Created at</th>
			<th></th>
		</thead>
		<tbody>

			@foreach($comments as $comment)
			<tr>
				<th>{{ $comment->id }}</th>
				<td>
					@foreach($posts as $post)
					@if($post->id==$comment->post_id)
						<a href="{{url("blog/".$post->slug)}}">{{$post->title}}</a>
					@endif
					@endforeach
				</td>
				<td>{{ $comment->name }}</td>
				<td>{{ $comment->email }}</td>
				<td>{{ $comment->comment }}</td>
				<td>{{ $comment->created_at }}</td>
				<td style="text-align: right">
					<button type="button" class="glyphicon glyphicon-trash option-a-glyphicon deletePost" data-toggle="modal" data-target="#destroyModal{{$comment->id}}" style="margin-left: 5px" href=""></button>
					{{-- {{ route('comments.destroy',['id'=>$comment->id]) }} --}}
				</td>
				<div class="modal fade" id="destroyModal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="deletecomment">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Are you sure to delate this comment ?</h4>
				      </div>
				      <div class="modal-body">
				       

						{!! Form::open(['route'=>['comments-admin.destroy',$comment->id],'method'=>'DELETE']) !!}
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
	{{-- {{ $comments->links() }} --}}
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
