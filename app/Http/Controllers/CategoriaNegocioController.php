<?php

namespace App\Http\Controllers;

use App\CategoriaNegocio;
use App\Negocio;
use Illuminate\Http\Request;
use DB;
use App\Usuario;
use Auth;

class CategoriaNegocioController extends Controller
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


            $categorias = DB::table('categoria_negocios as C')
            ->select('C.*')
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

        $categoria = new CategoriaNegocio();

        //traer id_negocio
        //$negocio = Negocio::where('id_usuario', '=', Auth::user()->id);

        /* $negocio = DB::table('negocios')
        ->select('negocios.*')
        ->where('id_usuario', '=', Auth::user()->id)
        ->get();
        $negocio[0]->id
        */

        if ($request) {

            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->marcador = $request->marcador;
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

            $categorias = CategoriaNegocio::findOrFail($id);

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

            $categoria = CategoriaNegocio::find($id);

            $categoria->nombre = $request->nombre;
            $categoria->descripcion = $request->descripcion;
            $categoria->marcador = $request->marcador;

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

            $categoria = CategoriaNegocio::find($id);
            $categoria->delete();


        }else{
            return redirect('/');
        }
    }


}
