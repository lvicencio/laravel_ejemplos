@extends('layouts.app')
@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <form action="{{ URL('usuarios')  }}{{ isset($usuario) ? '/' . $usuario->id  : '' }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    
                    @if(isset($usuario))
                        {{ method_field('PUT') }}
                    @endif

                     <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                        value="{{ isset($usuario) ? $usuario->name : '' }}"
                     >
                     <input type="text" class="form-control" name="email" placeholder="Correo Electronico"
                        value="{{ isset($usuario) ? $usuario->email : '' }}"
                     >
                     <button type="submit" class="btn btn-sm btn-success">Guardar</button>

                </div>

            </form>
        </div>
    </div>

@endsection