<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\JwtAuth;
use App\User;

class UserController extends Controller
{

    
    public function register(Request $request)
    {
        $json = $request->input('json', null);
        $params = json_decode($json);

        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $name =  (!is_null($json) && isset($params->name)) ? $params->name : null;
        $lastname =  (!is_null($json) && isset($params->lastname)) ? $params->lastname : null;
        $role = 'ROLE_USER';
        $password =  (!is_null($json) && isset($params->password)) ? $params->password : null;

        if (!is_null($email)  && !is_null($password) && !is_null($name)  ) {
           
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->lastname = $lastname;
            $user->role = $role;

            $pwd = hash('sha256', $password);
            $user->password = $pwd;

            //comprueba si el usuario ya existe
            $isset_user = User::where('email', '=', $email)->first();

            if (count($isset_user) == 0) {
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code'  => 200,
                    'message' => 'El Usuario fue creado con Exito!!'
                );
            }else{
                $data = array(
                    'status' => 'error',
                    'code'  => 400,
                    'message' => 'Usuario duplicado, intente con otro correo'
                );
            }

        }else {
            $data = array(
                'status' => 'error',
                'code'  => 400,
                'message' => 'Usuario no fue creado'
            );
        }

        return response()->json($data, 200);

        //{"name":"Luis","lastname":"Vicencio","email":"lvicencio@gmail.com","password":"123456" }
    }

    
    public function login(Request $request)
    {
        $jwtAuth = new JwtAuth();

        $json = $request->input('json', null);
        $params = json_decode($json);

        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $password = (!is_null($json) && isset($params->password)) ? $params->password : null;
        $getToken = (!is_null($json) && isset($params->gettoken)) ? $params->gettoken : null;
        //cifrar el pass
        $pwd = hash('sha256', $password);

        if (!is_null($email) && !is_null($password) && ($getToken == null || $getToken == 'false') ) {
            $signup = $jwtAuth->signup($email, $pwd);
        }elseif($getToken != null){
            $signup = $jwtAuth->signup($email, $pwd, $getToken);
        }else{
            $signup = array(
                    'status' => 'error',
                    'message' => 'Envia datos de nuevo'
            );
        }

        return response()->json($signup, 200);
    }
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
        //
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
    public function destroy($id)
    {
        //
    }
}
