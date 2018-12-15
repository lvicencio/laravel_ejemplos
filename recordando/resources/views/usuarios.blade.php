@extends('layouts.app')
@section('content')

    <center >
        <h3>Opciones de Usuarios</h3>
    </center>
    
    @if (Session::has('success'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif




    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <center>
                        <a href="{{ URL('usuarios/create') }}" class="btn btn-success ">Nuevo Usuario</a>
                        </center>
                        <tr>
                            <th width="5">ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Opción</th>

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($usuarios as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <center>
                                        <a href="{{ URL('usuarios/'. $user->id ) }}" class="btn btn-xs btn-success">Ver</a>
                                        <a href="{{ URL('usuarios/'. $user->id .'/edit') }}" class="btn btn-xs btn-info">Editar</a>
                                        
                                        <form action="{{ URL('usuarios/' . $user->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE')}}
                                            <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                        </form>
                                        
                                       
                                    </center>
                                </td>
                            </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection