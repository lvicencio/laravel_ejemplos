@extends('layouts.app')
@section('content')

    
        <h3>Información de  {{ $usuario->name }}</h3>
    
    
    @if (Session::has('success'))
        <div class="alert alert-danger" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif




    <div class="row col-md-4">
            <div class="card">
                    <div class="card-header">
                          N° de Identificación :  {{ $usuario->id }}
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Nombre:  {{ $usuario->name }}</h5>
                      <p class="card-text">Correo Electronico {{ $usuario->email }}</p>
                    
                    </div>
                    <a href="{{ URL('usuarios')}}">Volver </a>
            </div>

                  



                             
                               
                               
                                
                                   
                
        

    </div>

@endsection