<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

use App\Video;
use App\Comment;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.crearVideo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacioj
        $validated = $this->validate($request,[
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4,mp3'
        ]);

        $video = new Video();
        $user = \Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        
        //subida de imagen y archivo video
        $image = $request->file('image');
        if ($image) {
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));

            $video->image = $image_path;
        }
        $video_file = $request->file('video');
        if ($video_file) {
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));

            $video->video_path = $video_path;
        }

        $video->save();

        return redirect()->route('home')->with('message','Video subido correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($video_id)
    {
        $video = Video::findOrFail($video_id);
        
        return view('video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($video_id)
    {
        $user = \Auth::user();
        $video = Video::findOrFail($video_id);

        if ($user && $video->user_id == $user->id) {
             return view('video.edit', compact('video'));
        }
        else{
            return redirect()->route('home')->with('message','No puede Editar el Video, no tiene los permisos necesarios');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $video_id)
    {
        $validated = $this->validate($request,[
            'title' => 'required|min:5',
            'description' => 'required',
            'video' => 'mimes:mp4,mp3'
        ]);

        $video = Video::findOrFail($video_id);
        $user = \Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        
        //subida de imagen y archivo video
        $image = $request->file('image');
        if ($image) {
            if($video->image) {
                Storage::disk('images')->delete($video->image);
            }
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));

            $video->image = $image_path;
        }
        $video_file = $request->file('video');
        if ($video_file) {
            if($video->image) {
                Storage::disk('videos')->delete($video->video_path);
            }
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));

            $video->video_path = $video_path;
        }

        $video->update();

        return redirect()->route('home')->with('message','Video Editado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($video_id)
    {
        $user = \Auth::user();
        $video = Video::findOrFail($video_id);
        $comments = Comment::where('video_id', $video_id)->get();

        if ($user && $video->user_id == $user->id) {
            
            if ($comments && count($comments) >= 1 ) {
               foreach ($comments as $comment) {
                 $comment->delete();
               }
                
            }

            
            //borrar foto y video
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            //borrar registro
            $video->delete();

            $message = array('message' => 'Video Eliminado con Exito');
            
        }else{
            $message =  array('message' => 'Error al Eliminar');
        }

        return redirect()->route('home')->with($message);
    }

    public function buscar(Request $request, $buscar = null)
    {
       // dd($request);
       $buscar = \Request::get('buscar');
        
      
        if($buscar == null) 
        {
          // dd($buscar);
          // $videos = Video::where('title', 'LIKE', '%'.$request->get('buscar').'%')->paginate(5);
          //return redirect()->route('buscarVideo', compact('buscar')); 
          return redirect()->route('home', compact('buscar')); 
        }

        $videos = Video::where('title', 'LIKE', '%'.$buscar.'%')->paginate(5);

        return view('video.buscar', compact('videos','buscar'));

    }

    //METODOS Y FUNCIONES

    //retornar imagenes
    public function getImage($filename)
    {
        $file = \Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function getVideo($filename)
    {
        $file = \Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }
}
