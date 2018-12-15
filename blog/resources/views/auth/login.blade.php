@extends('layout')

@section('contenido')

	<h2>Entrar al Sitio</h2>

<form method="POST" action="/login" class="form-inline">
	{{ csrf_field() }}
	<input class="form-control" type="email" name="email" placeholder="Email">
	<input class="form-control" type="password" name="password" placeholder="Password">
	<input type="submit" name="entrar" value="Entrar"  class="btn btn-primary">
</form>
<br>
@endsection