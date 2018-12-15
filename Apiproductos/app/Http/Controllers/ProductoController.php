<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;


class ProductoController extends Controller
{

    public function agregarproducto(Request $request) 
    {
        
        $producto = new Producto;
        $producto->nombre = $request->Input('nombre');
        $producto->descripcion = $request->Input('descripcion');
        $producto->cod_Producto = $request->Input('cod_Producto');
        $producto->cantidad =   $request->Input('cantidad');
        $producto->precio   =   $request->Input('precio');
        $producto->photo    =   $request->Input('photo');
        $producto->save();
        $response = array('response'=>'Agregado Producto','success'=>true,'status'=>200);
        return $response;

    }

    public function getproductos()
    {
        $productos = Producto::orderBy('id','desc')->get();
        return response()->json($productos);
    }

    public function getproducto($id)
    {
        $producto = Producto::where('id',$id)->get();
        return response()->json($producto);
    }

    public function updateproducto(Request $request)
    {

        
        //buscar producto
        $id = $request->Input('id');

        Producto::where('id','=',$id)->update(array(
            'nombre' => $request->Input('nombre'),
            'descripcion' => $request->Input('descripcion'),
            'cod_Producto' => $request->Input('cod_Producto'),
            'cantidad'	=> $request->Input('cantidad'),
            'precio' => $request->Input('precio'),
            'photo' => $request->Input('photo')
        ));

        $response  = array('response'=> 'Producto Actualizado', 'success'=>true, 'status' => 201);
        return $response;

    }

    public function deleteproducto($id)
    {
        Producto::where('id', $id)->delete();
        $response = array('response' => 'Producto Borrado', 'success'=> true, 'status' => 202);
        return $response;
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
