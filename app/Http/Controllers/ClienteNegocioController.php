<?php

namespace App\Http\Controllers;
use App\Negocio;
use App\CategoriaNegocio;
use App\Ciudad;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class ClienteNegocioController extends Controller
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



                $negocios = DB::table('negocios as N')
                ->join('categoria_negocios as C', 'N.id_categoria', '=', 'C.id')
                ->join('ciudads as Ci', 'N.id_ciudad', '=', 'Ci.id')
                ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
                //->join('categoria_negocios as Ca', 'N.id_categoria', '=', 'Ca.id')
                ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario', 'C.marcador')
                ->orderBy('N.id','DESC')
                ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            //return response()->json($response);*/

            return $negocios;


        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search_negocio_producto(Request $request, $producto)
    {

        if($request->wantsJson()){



            $producto_formateado = rtrim($producto, "s");

                $negocios = DB::table('negocios as N')
                ->join('categoria_negocios as C', 'N.id_categoria', '=', 'C.id')
                ->join('ciudads as Ci', 'N.id_ciudad', '=', 'Ci.id')
                ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
                ->leftjoin('productos as P', 'N.id', '=', 'P.id_negocio')
                ->leftjoin('categoria__productos as Cp', 'N.id', '=', 'Cp.id_negocio')
                ->distinct()
                ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario', 'C.marcador' )
                ->where('N.nombre_completo','LIKE', '%'.$producto_formateado.'%')
                ->orwhere('P.nombre','LIKE', '%'.$producto_formateado.'%')
                ->orwhere('Cp.nombre','LIKE', '%'.$producto_formateado.'%')
                ->orwhere('C.nombre','LIKE', '%'.$producto_formateado.'%')
                ->orderBy('N.id','DESC')
                ->get();

                $validar_consulta = sizeof($negocios);

                if( $validar_consulta >= 1 ){


                    return $negocios;

                }else{

                    return response()->json([
                        'status' => 'Error!',
                        'msg' => 'Error al buscar negocios, no se encontraron coincidencias',
                        'code' => 2
                    ],400);


                }




                } else{
                    return redirect('/');
                }


    }



    public function search_negocio_categoria(Request $request, $id)
    {

        if($request->wantsJson()){

            if($id==0){
                $negocios = DB::table('negocios as N')
                ->join('categoria_negocios as C', 'N.id_categoria', '=', 'C.id')
                ->join('ciudads as Ci', 'N.id_ciudad', '=', 'Ci.id')
                ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
                ->leftjoin('productos as P', 'N.id', '=', 'P.id_negocio')
                ->leftjoin('categoria__productos as Cp', 'N.id', '=', 'Cp.id_negocio')
                ->distinct()
                ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario', 'C.marcador' )
                ->orderBy('N.id','DESC')
                ->get();

                return $negocios;

            }else{
                $negocios = DB::table('negocios as N')
                ->join('categoria_negocios as C', 'N.id_categoria', '=', 'C.id')
                ->join('ciudads as Ci', 'N.id_ciudad', '=', 'Ci.id')
                ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
                ->leftjoin('productos as P', 'N.id', '=', 'P.id_negocio')
                ->leftjoin('categoria__productos as Cp', 'N.id', '=', 'Cp.id_negocio')
                ->distinct()
                ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario', 'C.marcador' )
                ->where('N.id_categoria',$id)
                ->orderBy('N.id','DESC')
                ->get();

                return $negocios;
            }




                } else{
                    return redirect('/');
                }


    }

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
