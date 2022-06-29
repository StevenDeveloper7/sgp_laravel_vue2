<?php

namespace App\Http\Controllers;

use App\Categoria_Producto;
use App\Negocio;
use Illuminate\Http\Request;
use DB;
use App\Usuario;
use Auth;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class CategoriaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->wantsJson()){

            try{


            $categorias = DB::table('categoria__productos')
            ->select('categoria__productos.*','N.nombre_completo as nombre_negocio')
            ->join('negocios as N', 'N.id', '=', 'categoria__productos.id_negocio')
            ->join('usuarios as U', 'U.id', '=', 'N.id_usuario')
            ->where('N.id_usuario', '=', Auth::user()->id)
            ->orderBy('id', 'desc')->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $categorias;


        }else{
            return redirect('/');
        }
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
        if($request->wantsJson()){

            $this->validate($request, [
                'nombre' => 'required',
            ]);


        
        $negocio = Negocio::where('id_usuario', '=', Auth::user()->id)->first();

        $id_negocio = $negocio->id;

        if ($request) {
            $categoria = new Categoria_Producto();

            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->id_negocio = $id_negocio;
            $categoria->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Categoria Creada',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear la Categoria',
                'code' => 3
            ],400);
        }


        }else{
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria_Producto  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Laboratorio  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->wantsJson()){

            $categorias = Categoria_Producto::findOrFail($id);

            return $categorias;

        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria_Producto  $laboratorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->wantsJson()){

            $this->validate($request, [
                'nombre' => 'required'
            ]);

            $categoria = Categoria_producto::find($id);

            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;

            $categoria->save();

        }else{
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria_Producto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->wantsJson()){

            $categoria = Categoria_Producto::find($id);
            $categoria->delete();


        }else{
            return redirect('/');
        }
    }

    public function select_categoria(Request $request)
    {
        if($request->wantsJson()){



            $categorias = DB::table('categoria__productos')
            ->select('categoria__productos.*','N.nombre_completo as nombre_negocio')
            ->join('negocios as N', 'N.id', '=', 'categoria__productos.id_negocio')
            ->join('usuarios as U', 'U.id', '=', 'N.id_usuario')
            ->where('N.id_usuario', '=', Auth::user()->id)
            ->orderBy('id', 'desc')->get();



            return ['categorias' => $categorias];

        }else{
            return redirect('/');
        }
    }
}
