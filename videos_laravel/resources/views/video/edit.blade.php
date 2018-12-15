@extends('layouts.app')

@section('content')
    

    <div class="container">
        <h2>{{$video->title}}</h2>
        <hr>
        <div class="row">
           
            <form action="{{ route('updateVideo',['video_id' => $video->id]) }}" method="POST" enctype="multipart/form-data" class="col-md-10 col-md-offset-1">
                {{ csrf_field() }}
                @if($errors->any())
                
                    <div class="alert alert-danger" >
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>                        
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                        <label for="title">Titulo</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $video->title }}">
                </div>
        
                <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description" class="form-control"> {{ $video->description }} </textarea>
                </div>
                
                <div class="form-group">
                         <label for="image">Miniatura</label><br>
                        @if (Storage::disk('images')->has($video->image))
                         <img class="rounded fload-left img-thumbnail" src="{{ url('/miniatura/'.$video->image) }}"  height="150px" width="150px">                                
                        @endif
                        <input type="file" name="image" id="image" class="form-control">
                </div>
                
                <div class="form-group">
                        <label for="video">Video</label> <br>
                        <video controls id="video-player">
                                <source src="{{ route('fileVideo', ['filename' => $video->video_path ]) }}" >
                                </source>
                                Tu Navegador no es compatible
                        </video>
                        
                        <input type="file" name="video" id="video" class="form-control">
                </div>
        
                     <button type="submit" class="btn btn-success">Editar Video</button>

            </form>


        </div>

    </div>


@endsection