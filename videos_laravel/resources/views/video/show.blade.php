
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <h2>{{$video->title}}</h2>
        <hr>

        <div class="col-8">
            {{-- video --}}
            <video controls id="video-player">
                <source src="{{ route('fileVideo', ['filename' => $video->video_path ]) }}" >
                </source>
                Tu Navegador no es compatible
            </video>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Subido por <strong><p><a href="{{ route('userCanal', ['user_id' => $video->user->id] ) }}">{{ $video->user->name.' '.$video->user->lastname }}</a></p></strong>  {{ \FormatTime::LongTimeFilter($video->created_at)}}
                    </div>
                </div>
                <div class="card-body">
                        {{$video->description}}
                </div>
            </div>


        </div>

       <br>
       
             @include('video.comentarios')
      

    </div>
</div>


@endsection

