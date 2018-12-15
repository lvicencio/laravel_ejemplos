@extends('layout')
@section('contenido')

<h1>{{ $user->name  }}</h1>
	<table class="table">
		
		<tr>
			<th>Nombre: </th>
			<td>{{ $user->name }}</td>
		</tr>
		<tr>
			<th>Correo: </th>
			<td>{{ $user->email }}</td>
		</tr>

		<tr>
			<th>Roles: </th>
			<td> @foreach ($user->roles as $role)

				{{ $role->display }}<br>

				@endforeach </td>
		</tr>

	</table>

@can('edit',$user)
	<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>
@endcan

@can('destroy', $user)
	<form style="display:inline;" method="POST" action="{{  route('usuarios.destroy', $user->id) }}">

		{!! csrf_field() !!}
		{!!  method_field('DELETE') !!}
		<button class="btn btn-danger" type="submit">Eliminar</button>

		</form>
@endcan

@endsection