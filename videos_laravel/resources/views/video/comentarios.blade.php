<hr>
<h4>Comentarios</h4>
<br>
@if (session('message'))
    <div class="alert alert-success" role="alert">
        <strong>{{ session('message')}}</strong>
    </div>
@endif
@if (Auth::check())
    <form action="{{ url('/comment') }}" method="post" class="col-md-8">
    {{ csrf_field() }}
        <input type="hidden" name="video_id" value="{{ $video->id }}" required />
        <p>
            <textarea name="body" id="body" class="form-control" required></textarea>
        </p>
        <input type="submit" value="Comentar" class="btn btn-success" />

    </form>
@endif

{{-- Lista de comentarios --}}
@if (isset($video->comments))

    <div>
        @foreach ($video->comments as $comment)
        <br>
            <div class="col-md-12 pull-left">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <strong>{{ $comment->user->name.' '.$comment->user->lastname }}</strong>  {{ \FormatTime::LongTimeFilter($comment->created_at)}}
                            </div>
                        </div>
                        <div class="card-body">
                                {{$comment->body}}
                                    @if (Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->id == $video->user_id))
                                    <div class="text-right">
                                            <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                                        <a href="#Modal{{ $comment->id  }}" role="button" class="btn btn-sm btn-primary" data-toggle="modal">Eliminar</a>
                                        
                                        <!-- Modal / Ventana / Overlay en HTML -->
                                        <div id="Modal{{ $comment->id  }}" class="modal fade">
                                            <div class="modal-dialog text-left">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Seguro que quieres borrar este Comentario?</p>
                                                        <p class="text-warning"><small>{{ $comment->body }}</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <a href="{{ url('delete-comment/'.$comment->id) }}" class="btn btn-danger">Eliminar</a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                        </div>
                    </div>

              
            </div>    

        @endforeach


    </div>


    
@endif

        

