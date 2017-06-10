@if (Session::has('success'))

	<div class="alert alert-success" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success: </strong>{{ Session::get('success') }}
	</div>
@endif

@if(count($errors)>0)
	<div class="alert alert-danger" role="alert">
		<strong>Errors: </strong>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif