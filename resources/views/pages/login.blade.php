<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="row" style="margin-top: 100px; width:100%">
	<div class="col-sm-6 col-sm-offset-3">
	{!! Form::open(['route'=>'login','method'=>'post']) !!}

		{{ Form::label('login','Login:') }}
		<br>
		{{ Form::text('login',null,['class'=>'form-control']) }}
		<br><br>
		{{ Form::label('password','Password:') }}
		<br>
		{{ Form::password('password',['class'=>'form-control']) }}
		<br><br>
		{{ Form::submit('submit',['class'=>'btn btn-block btn-lg btn-success']) }}

	{!! Form::close() !!}
	</div>
</div>