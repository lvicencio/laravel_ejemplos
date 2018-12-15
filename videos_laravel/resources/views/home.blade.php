@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    <strong>{{ session('message')}}</strong>
                </div>
            @endif
        
                <div id="lista-videos" class="col-sm-6">

                    @if (count($videos) >= 1)
                        
                    
                        @foreach ($videos as $video)
                        <div class="card">
                                <h4 class="card-title"><a href="{{ route('detalleVideo',['video_id' => $video->id] )}}">{{ $video->title }}</a></h4>
                                @if (Storage::disk('images')->has($video->image))
                                <img class="rounded float-left img-thumbnail" src="{{ url('/miniatura/'.$video->image) }}"  height="250px" width="250px">                                
                                @endif
                                
                                <div class="card-body">
                                    <div>
                                    {{-- <h4><a href="">{{ $video->title }}</a></h4> --}}
                                    <p><a href="{{ route('userCanal', ['user_id' => $video->user->id] ) }}">{{ $video->user->name.' '.$video->user->lastname }}</a></p>  {{ \FormatTime::LongTimeFilter($video->created_at)}}
                                    </div>
                                    <a href="{{ route('detalleVideo',['video_id' => $video->id] )}}" class="btn btn-success">Ver</a>
                                @if (Auth::check() && Auth::user()->id == $video->user->id)
                                    <a href="{{ route('editarVideo',['video_id' => $video->id] )}}" class="btn btn-warning">Editar</a>
                                    {{-- Modal eliminar video --}}
                                
                                        <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                        <a href="#Modal{{ $video->id  }}" role="button" class="btn  btn-primary" data-toggle="modal">Eliminar</a>
                                        
                                        <!-- Modal / Ventana / Overlay en HTML -->
                                        <div id="Modal{{ $video->id  }}" class="modal fade">
                                            <div class="modal-dialog text-left">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Seguro que quieres borrar este Video?</p>
                                                        <p class="text-warning"><small>{{ $video->title }}</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <a href="{{ url('delete-video/'.$video->id) }}" class="btn btn-danger">Eliminar</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    {{-- fin modal  --}}
                                    
                                @endif
                                </div>
                        </div>

                        <br>
                        @endforeach
                    
                    @else

                    <div class="alert alert-warning" role="alert">
                      <h4 class="alert-heading">No Hay Videos</h4>
                      
                    </div>
                    
                    @endif

                </div>
        
        </div>

        {{ $videos->links() }}

    </div>
</div>
@endsection
