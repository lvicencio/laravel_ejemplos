<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request,[
            'body' => 'required'
        ]);

        $comentario = new Comment();
        $user = \Auth::user();

        $comentario->user_id = $user->id;
        $comentario->video_id = $request->input('video_id');
        $comentario->body   = $request->input('body');

        $comentario->save();

        return redirect()->route('detalleVideo',['video_id' => $comentario->video_id])->with('message','Comentario creado con Exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
        $user = \Auth::user();
        $comment = Comment::findOrFail($comment_id);

        if ($user && ($comment->user_id == $user->id  || $comment->video->user_id == $user->id  )) {
           $comment->delete();
        }

        return redirect()->route('detalleVideo',['video_id' => $comment->video_id])->with('message','Comentario borrado con exito');
    }


}
