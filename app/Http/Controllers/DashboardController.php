<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Producto;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class DashboardController extends Controller
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

    public function total_negocios(Request $request)
    {
        if($request->wantsJson()){


            $user = Auth::user()->id;

            $total_clientes = DB::table('negocios')
            ->select('id')
            ->where('id_usuario', $user)

            ->count();

            return $total_clientes;

        }else{
            return redirect('/');
        }
    }

    public function total_productos(Request $request)
    {
        if($request->wantsJson()){


            $user = Auth::user()->id;

            $total_productos = DB::table('productos as P')
            ->join('negocios as N', 'N.id', '=', 'P.id_negocio')
            ->join('usuarios as U', 'U.id', '=', 'N.id_usuario')
            ->select('id')
            ->where('U.id', $user)

            ->count();

            return $total_productos;

        }else{
            return redirect('/');
        }
    }

    public function total_vendedores(Request $request)
    {
        if($request->wantsJson()){

            $user = Auth::user()->id;

            $total_vendedores= DB::table('usuarios')
            ->select('id')
            ->where('id_admin', $user)
            ->where('id_role',3)
            ->count();

            return $total_vendedores;

        }else{
            return redirect('/');
        }
    }

    public function total_categorias(Request $request)
    {
        if($request->wantsJson()){

            $user = Auth::user()->id;

            $total_categorias= DB::table('categoria__productos as C')
            ->join('negocios as N', 'N.id', '=', 'C.id_negocio')
            ->join('usuarios as U', 'U.id', '=', 'N.id_usuario')
            ->select('id')
            ->where('U.id', $user)
            ->count();

            return $total_categorias;

        }else{
            return redirect('/');
        }
    }

    public function total_comisiones(Request $request)
    {
        if($request->wantsJson()){

            if( Auth::user()->id_role === 1 ){
                $user = Auth::user()->id;
            }if( Auth::user()->id_role === 4 ){
                $user = Auth::user()->id_admin;
            }

            $total_comisiones = DB::table('comisions as C')
            ->join('solicitud_ventas as S', 'C.id_solicitud_venta', '=', 'S.id')
            ->join('usuarios as U', 'S.id_vendedor', '=', 'U.id')
            ->where('U.id_admin', $user)
            ->sum('valor_comision');


            return $total_comisiones;

        }else{
            return redirect('/');
        }
    }

    public function ventas_anuales(Request $request)
    {

        if($request->wantsJson()){
            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                $ventas_anuales = DB::table('solicitud_ventas as S')
                ->join('usuarios as U', 'S.id_vendedor', '=', 'U.id')
                ->select(
                    DB::raw('sum(S.valor_montura + S.valor_lente) as total'),
                    DB::raw("DATE_FORMAT(S.fecha,'%Y') as year")
                    )
                ->where('S.id_estado_venta',3)
                ->where('U.id_admin', $user)
                ->groupBy('year')
                ->get();


                }catch(QueryException $queryException){
                    return $queryException->getMessage();
                }


                return response()->json($ventas_anuales);
        }else{
            return redirect('/');
        }

    }

    public function ventas_mensuales(Request $request)
    {

        if($request->wantsJson()){
            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                $fecha_actual = Carbon::now()->format('Y');

                $ventas_vendedor = DB::table('solicitud_ventas as Sv')
                    ->join('usuarios as U', 'Sv.id_vendedor', '=', 'U.id')
                    ->select(
                        DB::raw('sum(Sv.valor_montura + Sv.valor_lente) as total'),
                        DB::raw("DATE_FORMAT(Sv.fecha,'%M') as month")
                        )
                    ->whereYear('Sv.fecha','=', date($fecha_actual))
                    ->where('U.id_admin', $user)
                    ->groupBy('month')
                    ->get();


                }catch(QueryException $queryException){
                    return $queryException->getMessage();
                }


                return response()->json($ventas_vendedor);
        }else{
            return redirect('/');
        }

    }


    public function productos_random(Request $request)
    {
        $ciudad_usuario = Auth::user()->id_ciudad;

        $productos = Producto::orderByRaw('rand()')
            ->join('negocios as N', 'N.id', '=' , 'id_negocio')
            ->select('productos.id_negocio', 'productos.foto as foto_producto', 'productos.nombre', 'productos.valor', 'N.nombre_completo as nombre_negocio')
            ->where('N.id_ciudad', $ciudad_usuario)
            ->take(10)->get();

            return $productos;

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
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        //
    }
}
