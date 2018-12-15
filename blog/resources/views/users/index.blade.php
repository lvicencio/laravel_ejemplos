@extends('layout')
@section('contenido')

	<h1>Lista de Usuarios</h1>

<a class="btn btn-primary pull-right" href="{{ route('usuarios.create')  }}">Crear Nuevo Usuario</a> 
</br>
	<table class="table table-bordered table-hover">
		<thead>
			
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Role</th>
				<th>Opciones</th>
			</tr>

		</thead>
		<tbody>
			@foreach($users as $user )
				<tr>
					<td>{{ $user->id }}</td>
					<td>
					<a href="{{ route('usuarios.show', $user->id) }}">
					{{ $user->name }}
					</a>
					</td>

					<td>{{ $user->email }}</td>
					
					<td>

						{{$user->roles->pluck('display')->implode(' - ') }}

						{{-- @foreach ($user->roles as $role)
							- {{ $role->display }} 
				       		@endforeach --}}
					</td>
					<td>
						<a class="btn btn-info btn-xs"  href="{{ route('usuarios.edit', $user->id) }}">Editar</a>
						<form style="display:inline;" method="POST" action="{{  route('usuarios.destroy', $user->id) }}">

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