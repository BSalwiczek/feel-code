@extends('main')

@section('title','All categories')

@section('logo')
<div class="logo" style="height:300px">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg" style="height:300px">
		
		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="code">Categories Manager</span>
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
	<a href="{{ route('categories-manager.create') }}" class="btn btn-lg btn-warning" >Create new category</a>
	<br>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Name</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($categories as $category)
			<tr>
				<th>{{ $category->id }}</th>
				<td>{{ $category->name }}</td>
				<td style="text-align: right">
					<a class="glyphicon glyphicon-edit option-a-glyphicon" style="margin-left: 5px" href="{{ route('categories-manager.edit',['id'=>$category->id]) }}"></a>
					<button type="button" class="glyphicon glyphicon-trash option-a-glyphicon deletePost" data-toggle="modal" data-target="#destroyModal{{$category->id}}" style="margin-left: 5px" href=""></button>
					{{-- {{ route('categorys.destroy',['id'=>$category->id]) }} --}}
				</td>
				<div class="modal fade" id="destroyModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="deletecategory">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Are you sure to delate this category ?</h4>
				      </div>
				      <div class="modal-body">
				       


						{!! Form::open(['route'=>['categories-manager.destroy',$category->id],'method'=>'DELETE']) !!}
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

