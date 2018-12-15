@extends('layout')

@section('contenido')

	<h1>Editar </h1>

<form method="POST" action="{{ route('mensajes.update', $mensaje->id) }}">
	{{ method_field('PUT') }}
	{{ csrf_field() }} 
	

	@unless($mensaje->user_id)

		<p><label for="nombre">
			Nombre
			{{-- <input class="form-control" type="text" name="nombre" value="{{ $mensaje->nombre }}"> --}}

			<input class="form-control" type="text" name="nombre" value="{{ $mensaje->nombre or old('nombre') }}">

			{{-- {!! $errors->first('nombre', :message) !!}  --}}
		</label>
		</p>	

		<p><label for="email">
			Email
			<input class="form-control" type="text" name="email" value="{{ $mensaje->email or old('email')}}">
			{{-- {!! $errors->first('email', message ) !!} --}}
		</label>
		</p>	


	@endunless

		<p><label for="mensaje">
			Mensaje
			<textarea class="form-control" name="mensaje">{{ $mensaje->mensaje }}</textarea>
			{{-- {!! $errors->first('mensaje', message ) !!} --}}
		</label>
		</p>	

	<input type="submit" value="Actualizar" class="btn btn-primary">
</form>

 

@endsection