<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use App\Car;

class CarController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $hash = $request->header('Authorization', null);

        // $jwtAuth = new JwtAuth();
        // $checkToken = $jwtAuth->checkToken($hash);

        // if ($checkToken) {
        //     echo "Index de Cars esta AUTENIFCICADO"; die();
        // }else{
        //     echo "NO AUTORIZADO";die();
        // }

        $cars = Car::all()->load('user');
        return response()->json(array(
            'cars' => $cars,
            'status' => 'success'
            ),200);
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
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if ($checkToken) {
            //datos por POST
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array = json_decode($json, true); //<-- con el valor true, convierte el json en un array

            //usuario logeado
            $user = $jwtAuth->checkToken($hash, true);
            //validar
            //$request->merge($params_array);

            //dd($request);  , "status":"true"
            
            $validate = \Validator::make($params_array,[
                'title' => 'required|min:5',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required'
            ]);

            if($validate->fails()){
                return response()->json($validate->errors(),400);
            }
              
                
                      
            // $errors = $validate->errors();
            // if($errors){
            //     return $errors->toJson();
            // }

            //almacenar automovil
           
            $car = new Car();
            $car->user_id = $user->sub;
            $car->title = $params->title;
            $car->description = $params->description;
            $car->price = $params->price;
            $car->status = $params->status;

            $car->save();
               
            $data = array(
                'car'       => $car,
                'status'    => 'success',
                'code'      => 200,
            );

        }else{
            //error no autorizado
            $data = array(
                'message'   => 'Login Incorrecto',
                'status'    => 'error',
                'code'      => 400,
            );
            
        }

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        if (is_object($car)) {
            $car = Car::find($id)->load('user');
            return response()->json(array(
            'car' => $car,
            'status' => 'success'
            ,200));
        }else {
            return response()->json(array(
                'message' => 'No existe Automovil',
                'status' => 'error'
                ,400));
        }

        
        
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
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if ($checkToken) {
            //datos por POST
            $json = $request->input('json', null);
            $params = json_decode($json);
            $params_array = json_decode($json, true); //<-- con el valor true, convierte el json en un array

            //usuario logeado
            $user = $jwtAuth->checkToken($hash, true);
                //validar    
            $validate = \Validator::make($params_array,[
                'title' => 'required|min:5',
                'description' => 'required',
                'price' => 'required',
                'status' => 'required'
            ]);

            if($validate->fails()){
                return response()->json($validate->errors(),400);
            }
       
           //parametros que no se deben actualizar
           unset($params_array['id']);
           unset($params_array['user_id']);
           unset($params_array['created_at']);
           unset($params_array['user']);

            //editar automovil
           

            $car = Car::where('id', $id)->update($params_array);
                       
            $data = array(
                'car'       => $params,
                'status'    => 'success',
                'code'      => 200,
            );

        }else{
            //error no autorizado
            $data = array(
                'message'   => 'Login Incorrecto',
                'status'    => 'error',
                'code'      => 400,
            );
            
        }

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $hash = $request->header('Authorization', null);

        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($hash);

        if ($checkToken) {
           
            $car = Car::findOrFail($id);

           $car->delete(); 
            
            $data = array(
                'car'       => $car,
                'status'    => 'success',
                'code'      => 200,
            );

        }else{
            //error no autorizado
            $data = array(
                'message'   => 'Login Incorrecto',
                'status'    => 'error',
                'code'      => 400,
            );
            
        }

        return response()->json($data, 200);
    }
}
