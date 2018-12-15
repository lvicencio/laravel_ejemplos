<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UsuariosController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth' , ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         $user = [
             'name'   => $request->nombre,
             'email'    => $request->email,
             'password' => Hash::make($request->nombre),
         ];
          
        $save = User::insert($user);

        if ($save) {
            # code...
            return redirect('usuarios');
        } else {
            # code...
            return redirect()->back()->withInput(); 
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
       // dd($usuario);
        return view('show')->with(compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('create')->with(compact('usuario'));
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
       // dd($request->all());

        if ($request->has('password')) {
            $password = $request->password;
            $user = [
                'name'   => $request->nombre,
                'email'    => $request->email,
                'password' => $password,
            ];
        }
       else{
        $user = [
            'name'   => $request->nombre,
            'email'    => $request->email,
            
        ];
        
       }
         
       $update = User::find($id)->update($user);

       if ($update) {
           # code...
           return redirect('usuarios');
       } else {
           # code...
           return redirect()->back()->withInput(); 
       }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            # code...
            $user->destroy($id);
            $msg= "Usuario Eliminado con Exito";
        } else {
            # code...
            $msg= "Usuario No se pudo Eliminar, intente de nuevo"; 
        }
        return redirect()->back()->withSuccess($msg);
    }
}
