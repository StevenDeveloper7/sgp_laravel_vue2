<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Carbon\Carbon;
use App\Usuario;
use App\Producto;
use App\Categoria_Producto;
use App\Combo;
use App\Negocio;
use App\DetalleCombo;
use Auth;


class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prueba()
    {

      /*  $producto='perros calientes';

        $producto_formateado_espacio = explode(" ", $producto);

        $max = sizeof($producto_formateado_espacio);

        $producto_formateado = '';

        for($i=0; $i<$max; $i++){


            $producto_formateado .= ' '.rtrim($producto_formateado_espacio[$i], "s");


        }*/



       /* $negocios = DB::table('negocios as N')
        ->join('categoria_negocios as C', 'N.id_categoria', '=', 'C.id')
        ->join('ciudads as Ci', 'N.id_ciudad', '=', 'Ci.id')
        ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
        ->leftjoin('productos as P', 'N.id', '=', 'P.id_negocio')
        ->leftjoin('categoria__productos as Cp', 'N.id', '=', 'Cp.id_negocio')
        ->distinct()
        ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario', 'C.marcador' )
        //->where('P.nombre','LIKE', '%'.$producto_formateado.'%')
        //->orwhere('Cp.nombre','LIKE', '%'.$producto_formateado.'%')
        //->orwhere('C.nombre','LIKE', '%'.$producto_formateado.'%')
        //->orderBy('N.id','DESC')
        ->get();

        //return $negocios;

        $cliente = DB::table('Usuarios as U')
            ->select('U.telefono', 'U.nombre_completo')
            ->where('U.id', 6)
            ->get();

         return $cliente[0]->telefono;*/


         $validar_usuario = Usuario::where('email', '=', 'antony_manyoma@hotmail.com')->first();

         return $validar_usuario->id_estado;





    }

    public function reporte_clientes(Request $request)
    {
        if($request->wantsJson()){

            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

            $clientes = DB::table('usuarios as U')
            ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
            //->join('estados as E', 'U.id_estado', '=', 'E.id')
            ->select('U.*', 'T.nombre as tipo_documento')
            ->where('U.id_role','=',3)
            ->where('U.id_admin','=', $user)
            ->orderBy('U.id','ASC')
            ->get();

            $configuracion = DB::table('configuracions as C')
            ->join('usuarios as U', 'U.id', '=', 'C.id_admin')
            ->select('C.*')
            ->where('C.id_admin','=', $user)
            ->first();


            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            $pdf = PDF::loadView('reportes.clientes',compact('clientes','configuracion'));
            return $pdf->download('document.pdf');

        }else{
            return redirect('/');
        }

    }

    public function reporte_ventas(Request $request, $start, $end, $id)
    {


        if( $start !== null || $end !== null ){

            if($id == 0 ){

       $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                $ventas = DB::table('solicitud_ventas as Sv')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                ->join('estado_ventas as Ev', 'Ev.id', '=', 'Sv.id_estado_venta')
                ->join('laboratorios as Lb', 'Lb.id', '=', 'Sv.id_laboratorio_bisel')
                ->join('estado_pagos as Ep', 'Sv.id_estado_pago', '=', 'Ep.id')
                ->join('estado_pagos as Epb', 'Sv.id_estado_pago_bisel', '=', 'Epb.id')
                ->leftjoin('laboratorios as L', 'Sv.id_laboratorio', '=', 'L.id')
                ->select('Sv.*',
                         'V.nombre_completo as nombre_vendedor',
                         'C.nombre_completo as nombre_cliente',
                         'Ev.nombre as estado_venta',
                         'Ep.nombre as estado_pago',
                         'Epb.nombre as estado_pago_bisel',
                         'L.nombre as laboratorio',
                         'Lb.nombre as laboratorio_bisel'

                         )

                ->where('Sv.id_estado', 1)
                ->where('V.id_admin','=', $user)
                ->whereBetween('Sv.fecha', [$desde,$hasta])

                ->get();

                $configuracion = DB::table('configuracions as C')
                ->join('usuarios as U', 'U.id', '=', 'C.id_admin')
                ->select('C.*')
                ->where('C.id_admin','=', $user)
                ->first();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.ventas',compact('ventas','desde','hasta','configuracion'));
            return $pdf->download('document.pdf');

        }else{


            $array_fecha_desde = explode(" ", $start);

            if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
            if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
            if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
            if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
            if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
            if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
            if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
            if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
            if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
            if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
            if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
            if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

            $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


            $array_fecha_hasta = explode(" ", $end);

            if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
            if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
            if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
            if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
            if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
            if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
            if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
            if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
            if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
            if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
            if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
            if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

            $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


                try{

                    if( Auth::user()->id_role === 1 ){
                        $user = Auth::user()->id;
                    }if( Auth::user()->id_role === 4 ){
                        $user = Auth::user()->id_admin;
                    }

                    $ventas = DB::table('solicitud_ventas as Sv')
                    ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                    ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                    ->join('estado_ventas as Ev', 'Ev.id', '=', 'Sv.id_estado_venta')
                    ->join('laboratorios as Lb', 'Lb.id', '=', 'Sv.id_laboratorio_bisel')
                    ->join('estado_pagos as Ep', 'Sv.id_estado_pago', '=', 'Ep.id')
                    ->join('estado_pagos as Epb', 'Sv.id_estado_pago_bisel', '=', 'Epb.id')
                    ->leftjoin('laboratorios as L', 'Sv.id_laboratorio', '=', 'L.id')
                    ->select('Sv.*',
                             'V.nombre_completo as nombre_vendedor',
                             'C.nombre_completo as nombre_cliente',
                             'Ev.nombre as estado_venta',
                             'L.nombre as laboratorio',
                             'Lb.nombre as laboratorio_bisel',
                             'Ep.nombre as estado_pago',
                             'Epb.nombre as estado_pago_bisel',

                             )


                    ->where('Sv.id_estado', 1)
                    ->where('V.id_admin','=', $user)
                    ->whereBetween('Sv.fecha', [$desde,$hasta])
                    ->where(function($q) use ($id) {
                        $q->where('Sv.id_laboratorio', $id)
                          ->orWhere('Sv.id_laboratorio_bisel', $id);
                    })

                    ->orderBy('Sv.id','ASC')
                    ->get();

                    $laboratorio = DB::table('laboratorios as L')
                    ->select('L.*')
                    ->where('L.id','=', $id)
                    ->first();

                    $total_valor_lente = DB::table('solicitud_ventas as Sv')
                    ->join('laboratorios as L','L.id', '=', 'Sv.id_laboratorio')
                    ->where('L.id','=', $id )
                    ->where('L.id_admin','=', $user)
                    ->whereBetween('Sv.fecha', [$desde,$hasta])
                    ->sum('Sv.valor_lente');

                    $total_valor_biselado = DB::table('solicitud_ventas as Sv')
                    ->join('laboratorios as Lb','Lb.id', '=', 'Sv.id_laboratorio_bisel')
                    ->where('Lb.id_admin','=', $user)
                    ->where('Lb.id','=', $id )
                    ->whereBetween('Sv.fecha', [$desde,$hasta])
                    ->sum('Sv.valor_biselado');

                    $configuracion = DB::table('configuracions as C')
                    ->join('usuarios as U', 'U.id', '=', 'C.id_admin')
                    ->select('C.*')
                    ->where('C.id_admin','=', $user)
                    ->first();



                }catch(QueryException $queryException){

                    return $queryException->getMessage();
                }


                $pdf = PDF::loadView('reportes.ventas_laboratorio',compact('ventas','desde','hasta','laboratorio','total_valor_lente','total_valor_biselado','id','configuracion'));
                return $pdf->download('document.pdf');


        }

        }else{
            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Por favor seleccciona un rango de fechas',
                'code' => 1
            ],400);
        }

    }

    public function reporte_comisiones(Request $request, $start, $end, $documento)
    {

        if( $start !== null || $end !== null){

        if($documento == 0 ){


        $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                $comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->select('Co.*',
                         'V.nombre_completo as nombre_vendedor',
                         'Sv.fecha',

                         )

                ->where('V.id_admin','=', $user)
                ->whereBetween('Sv.fecha', [$desde,$hasta])

                ->get();

                $total_comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->where('V.id_admin','=', $user)
                ->sum('Co.valor_comision');

                $configuracion = DB::table('configuracions as C')
                ->join('usuarios as U', 'U.id', '=', 'C.id_admin')
                ->select('C.*')
                ->where('C.id_admin','=', $user)
                ->first();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.comisiones',compact('comisiones','desde','hasta', 'total_comisiones', 'configuracion'));
            return $pdf->download('document.pdf');

        }else{


            $array_fecha_desde = explode(" ", $start);

        if ($array_fecha_desde[1]=="Jan") $array_fecha_desde[1]="01";
        if ($array_fecha_desde[1]=="Feb") $array_fecha_desde[1]="02";
        if ($array_fecha_desde[1]=="Mar") $array_fecha_desde[1]="03";
        if ($array_fecha_desde[1]=="Apr") $array_fecha_desde[1]="04";
        if ($array_fecha_desde[1]=="May") $array_fecha_desde[1]="05";
        if ($array_fecha_desde[1]=="Jun") $array_fecha_desde[1]="06";
        if ($array_fecha_desde[1]=="Jul") $array_fecha_desde[1]="07";
        if ($array_fecha_desde[1]=="Aug") $array_fecha_desde[1]="08";
        if ($array_fecha_desde[1]=="Sep") $array_fecha_desde[1]="09";
        if ($array_fecha_desde[1]=="Oct") $array_fecha_desde[1]="10";
        if ($array_fecha_desde[1]=="Nov") $array_fecha_desde[1]="11";
        if ($array_fecha_desde[1]=="Dec") $array_fecha_desde[1]="12";

        $desde = $array_fecha_desde[3].'-'.$array_fecha_desde[1].'-'.$array_fecha_desde[2];


        $array_fecha_hasta = explode(" ", $end);

        if ($array_fecha_hasta[1]=="Jan") $array_fecha_hasta[1]="01";
        if ($array_fecha_hasta[1]=="Feb") $array_fecha_hasta[1]="02";
        if ($array_fecha_hasta[1]=="Mar") $array_fecha_hasta[1]="03";
        if ($array_fecha_hasta[1]=="Apr") $array_fecha_hasta[1]="04";
        if ($array_fecha_hasta[1]=="May") $array_fecha_hasta[1]="05";
        if ($array_fecha_hasta[1]=="Jun") $array_fecha_hasta[1]="06";
        if ($array_fecha_hasta[1]=="Jul") $array_fecha_hasta[1]="07";
        if ($array_fecha_hasta[1]=="Aug") $array_fecha_hasta[1]="08";
        if ($array_fecha_hasta[1]=="Sep") $array_fecha_hasta[1]="09";
        if ($array_fecha_hasta[1]=="Oct") $array_fecha_hasta[1]="10";
        if ($array_fecha_hasta[1]=="Nov") $array_fecha_hasta[1]="11";
        if ($array_fecha_hasta[1]=="Dec") $array_fecha_hasta[1]="12";

        $hasta = $array_fecha_hasta[3].'-'.$array_fecha_hasta[1].'-'.$array_fecha_hasta[2];


            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                $comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->join('usuarios as C','C.id', '=', 'Sv.id_cliente')
                ->select('Co.*',
                         'V.*',
                         'C.nombre_completo as nombre_cliente',
                         'Sv.fecha',
                         'Sv.id as numero_venta'

                         )

                ->where('V.id_admin','=', $user)
                ->whereBetween('Sv.fecha', [$desde,$hasta])
                ->where('V.numero_documento', $documento)
                ->get();

                $vendedor = DB::table('usuarios as U')
                ->select('U.*')
                ->where('U.numero_documento','=', $documento)
                ->first();


                $total_comisiones = DB::table('comisions as Co')
                ->join('solicitud_ventas as Sv','Sv.id', '=', 'Co.id_solicitud_venta')
                ->join('usuarios as V','V.id', '=', 'Sv.id_vendedor')
                ->where('V.numero_documento','=', $documento )
                ->sum('Co.valor_comision');

                $configuracion = DB::table('configuracions as C')
                ->join('usuarios as U', 'U.id', '=', 'C.id_admin')
                ->select('C.*')
                ->where('C.id_admin','=', $user)
                ->first();



            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }


            $pdf = PDF::loadView('reportes.comisiones_vendedor',compact('comisiones','vendedor','total_comisiones','desde','hasta', 'configuracion'));
            return $pdf->download('document.pdf');
        }

    }else{

        return response()->json([
            'status' => 'Ocurrio un error!',
            'msg' => 'Por favor seleccciona un rango de fechas',
            'code' => 1
        ],400);
    }



    }
    public function reporte_laboratorios(Request $request, $start, $end, $id){

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
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
