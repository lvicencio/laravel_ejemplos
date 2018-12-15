<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Mensaje;

class MensajesController extends Controller
{

    function __construct()
    {
        $this->middleware('auth',['except'=>['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $mensajes = DB::table('messages')->get();

        $mensajes = Mensaje::all();

        return view('mensajes.index', compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensajes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // DB::table('messages')->insert([
       //      "nombre" => $request->input('nombre'),
       //      "email" => $request->input('email'),
       //      "mensaje" => $request->input('mensaje'),
       //      "created_at" => Carbon::now(),
       //      "updated_at" => Carbon::now()
       // ]);

        $message = Mensaje::create($request->all());

        if (auth()->check())
        {
            auth()->user()->messages()->save($message);
        }

       return redirect()->route('mensajes.create')->with('info', 'Mensaje Enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $mensaje = DB::table('messages')->where('id',$id)->first();

        $mensaje = Mensaje::findOrFail($id);

        return view('mensajes.show', compact('mensaje'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $mensaje = DB::table('messages')->where('id',$id)->first();

        $mensaje = Mensaje::findOrFail($id);
        return view('mensajes.edit', compact('mensaje'));
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
        // $mensaje = DB::table('messages')->where('id',$id)->update([
        //     "nombre" => $request->input('nombre'),
        //     "email" => $request->input('email'),
        //     "mensaje" => $request->input('mensaje'),
        //     "updated_at" => Carbon::now()
        // ]);

        $mensaje = Mensaje::findOrFail($id);
        $mensaje->update($request->all());

        return redirect()->route('mensajes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $mensaje = DB::table('messages')->where('id',$id)->delete();
         
        $mensaje = Mensaje::findOrFail($id)->delete();

         return redirect()->route('mensajes.index');
    }
}
