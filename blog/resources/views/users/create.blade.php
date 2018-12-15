@extends('layout')
@section('contenido')

	<h1>Crear  Usuario</h1>
@if(session()->has('info'))
	<div class="alert alert-success">{{ session('info') }}</div>
@endif


<form method="POST" action="{{ route('usuarios.store') }}">
	{{ csrf_field() }} 
	<p><label for="nombre">
		Nombre
		<input class="form-control" type="text" name="name" value="{{ $user->name or old('name') }}">
		{!! $errors->first('name', '<span class=error>:message</span>') !!} 
	</label>
	</p>	

	<p><label for="email">
		Email
		<input class="form-control" type="text" name="email" value="{{ $user->email  or old('email') }}">
			{!! $errors->first('email', '<span class=error>:message</span>' ) !!}
	</label>
	</p>	

	<p><label for="password">
		Password
		<input class="form-control" type="password" name="password">
		{!! $errors->first('password', '<span class=error>:message</span>') !!} 
	</label>
	</p>

	<p><label for="password_confirmation">
		Confirmar Password 
		<input class="form-control" type="password" name="password_confirmation">
		{!! $errors->first('password_confirmation', '<span class=error>:message</span>') !!} 
	</label>
	</p>

<div class="checkbox">
	@foreach ($roles as $id => $name)

		<label>
			<input type="checkbox" name="roles[]" value="{{ $id }}">
		{{-- 	{{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}> --}}
			{{$name}}


		</label> 
	@endforeach
	<br>
{!! $errors->first('roles', '<span class=error>:message</span>') !!}
</div>
	 <hr>	

	<input type="submit" value="Guardar" class="btn btn-primary">
</form>

@endsection