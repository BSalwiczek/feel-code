@extends('main')

@section('title','All quotes')

@section('logo')
<div class="logo" style="height:300px">
	<div class="parallax-window" data-parallax="scroll" data-image-src="../img/logo.jpg" style="height:300px">
		
		<div class="fadeOnLogo">
		    <div class="logo-text">
			    <span class="code">Quotes Manager</span>
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
	<a href="{{ route('quotes.create') }}" class="btn btn-lg btn-primary" >Create new quote</a>
	<br>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Author</th>
			<th>Content</th>
			<th style="min-width: 75px"></th>
		</thead>
		<tbody>
			@foreach($quotes as $quote)
			<tr>
				<th>{{ $quote->id }}</th>
				<td>{{ $quote->author }}</td>
				<td>{{ $quote->content }}</td>
				<td style="text-align: right">
					<a class="glyphicon glyphicon-edit option-a-glyphicon" style="margin-left: 5px" href="{{ route('quotes.edit',['id'=>$quote->id]) }}"></a>
					<button type="button" class="glyphicon glyphicon-trash option-a-glyphicon deletePost" data-toggle="modal" data-target="#destroyModal{{$quote->id}}" style="margin-left: 5px" href=""></button>
					{{-- {{ route('quotes.destroy',['id'=>$quote->id]) }} --}}
				</td>
				<div class="modal fade" id="destroyModal{{$quote->id}}" tabindex="-1" role="dialog" aria-labelledby="deletequote">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Are you sure to delate this quote ?</h4>
				      </div>
				      <div class="modal-body">
				       


						{!! Form::open(['route'=>['quotes.destroy',$quote->id],'method'=>'DELETE']) !!}
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

