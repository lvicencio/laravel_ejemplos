@extends('layout')

@section('contenido')

	<h1>Lista de Mensajes</h1>

 

	<table class="table table-bordered table-hover">
		<thead>
			
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
				<th>Opciones</th>
			</tr>

		</thead>
		<tbody>
			@foreach($mensajes as $mensaje )
				<tr>
					<td>{{ $mensaje->id }}</td>
					@if($mensaje -> user_id)

						<td>
							<a href="{{ route('usuarios.show', $mensaje->user_id) }}">{{ $mensaje->user->name }}</a>

							

						</td>
						<td>{{ $mensaje->user->email }}</td>
					@else
						<td>{{ $mensaje->nombre }}</td>
						<td>{{ $mensaje->email }}</td>
					@endif
						<td>
							<a href="{{ route('mensajes.show', $mensaje->id) }}">
							{{ $mensaje->mensaje }}
						</a>
						</td>

					<td>
						<a class="btn btn-info btn-xs"  href="{{ route('mensajes.edit', $mensaje->id) }}">Editar</a>
						<form style="display:inline;" method="POST" action="{{  route('mensajes.destroy', $mensaje->id) }}">

							{!! csrf_field() !!}
							{!!  method_field('DELETE') !!}
							
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>

						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection