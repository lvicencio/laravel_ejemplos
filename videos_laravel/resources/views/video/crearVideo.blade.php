@extends('layouts.app')

@section('content')

<div class="container">
        <h2>Subir Nuevo Video</h2>
        <hr>
    <div class="row">
            
    <form action="{{ route('guardarVideo') }}" method="POST" enctype="multipart/form-data" class="col-lg-7">
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
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" name="description" id="description" class="form-control"> {{old('description')}} </textarea>
            </div>
            <div class="form-group">
                 <label for="image">Miniatura</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
           <div class="form-group">
                <label for="video">Video</label>
                <input type="file" name="video" id="video" class="form-control">
             </div>

             <button type="submit" class="btn btn-success">Subir Video</button>
        </form>

    </div>
    


</div>


@endsection