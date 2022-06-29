<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolicitudVenta;
use App\Usuario;
use App\Laboratorio;
use App\Comision;
use App\Estado_venta;
use App\Estado_pago;
use DB;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Auth;

class SolicitudVentaController extends Controller
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

                if( Auth::user()->id_role === 1){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 2 || Auth::user()->id_role === 4 ){
                    $user = Auth::user()->id_admin;
                }

                    $ventas = DB::table('solicitud_ventas as V')
                    ->join('usuarios as U', 'V.id_cliente', '=', 'U.id')
                    ->join('usuarios as UV', 'V.id_vendedor', '=', 'UV.id')
                    ->join('estados as E', 'V.id_estado', '=', 'E.id')
                    ->join('estado_ventas as Ev', 'V.id_estado_venta', '=', 'Ev.id')
                    ->join('estado_pagos as Ep', 'V.id_estado_pago', '=', 'Ep.id')
                    ->join('estado_pagos as Epb', 'V.id_estado_pago_bisel', '=', 'Epb.id')
                    ->leftjoin('laboratorios as L', 'V.id_laboratorio', '=', 'L.id')
                    ->join('laboratorios as LB', 'V.id_laboratorio_bisel', '=', 'LB.id')
                    ->select('V.*', 'U.nombre_completo as nombre_cliente', 'UV.nombre_completo as nombre_vendedor',
                     'Ev.nombre as nombre_estado', 'LB.nombre as nombre_laboratorio_bisel', 'L.nombre as nombre_laboratorio', 'U.numero_documento as numero_documento',
                     'Ep.nombre as estado_pago',
                     'Epb.nombre as estado_pago_bisel',

                     )
                    ->where('V.id_estado','=',1)
                    ->where('UV.id_admin','=', $user )
                    ->orderBy('V.id','DESC')
                    ->get();


            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $ventas;


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
    public function select_cliente(Request $request)
    {
        if($request->wantsJson()){

            if( Auth::user()->id_role === 1){
                $user = Auth::user()->id;
            }if( Auth::user()->id_role === 2 || Auth::user()->id_role === 4 ){
                $user = Auth::user()->id_admin;
            }

            $clientes = Usuario::select('id', 'nombre_completo', 'id_role')
            ->where('usuarios.id_role','=',3)
            ->where('usuarios.id_estado','=',1)
            ->where('usuarios.id_admin','=',$user)
            ->orderBy('id', 'asc')->get();

            return $clientes;
        }else{
            return redirect('/');
        }
    }
    public function select_vendedor(Request $request)
    {
        if($request->wantsJson()){

            if( Auth::user()->id_role === 1){
                $user = Auth::user()->id;
            }if( Auth::user()->id_role === 2 || Auth::user()->id_role === 4 ){
                $user = Auth::user()->id_admin;
            }

            $vendedores = Usuario::select('id', 'nombre_completo', 'id_role')
            ->where('usuarios.id_role','!=',3)
            ->where('usuarios.id_estado','=',1)
            ->where('usuarios.id_admin','=',$user)
            ->orderBy('id', 'asc')->get();

            return ['vendedores' => $vendedores];
        }else{
            return redirect('/');
        }
    }
    public function select_laboratorio(Request $request)
    {
        if($request->wantsJson()){

            if( Auth::user()->id_role === 1){
                $user = Auth::user()->id;
            }if( Auth::user()->id_role === 2 || Auth::user()->id_role === 4 ){
                $user = Auth::user()->id_admin;
            }

            $laboratorios = Laboratorio::select('id', 'nombre')
            ->where('laboratorios.id_estado','=',1)
            ->where('laboratorios.id_admin','=',$user)
            ->orderBy('id', 'asc')->get();

            return ['laboratorios' => $laboratorios];
        }else{
            return redirect('/');
        }
    }

    public function select_estado(Request $request)
    {
        if($request->wantsJson()){

            $estados = Estado_venta::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['estados' => $estados];
        }else{
            return redirect('/');
        }
    }

    public function select_estado_pago(Request $request)
    {
        if($request->wantsJson()){

            $estados_pago = Estado_pago::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['estados_pago' => $estados_pago];
        }else{
            return redirect('/');
        }
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



        $venta = new SolicitudVenta();



        if ($request) {

            $date = new DateTime();

            $venta->fecha = $date;
            $venta->id_cliente = $request->id_cliente;
            $venta->casillero = $request->casillero;
            $venta->gaveta = $request->gaveta;
            $venta->od_esf = $request->od_esf;
            $venta->od_cyl = $request->od_cyl;
            $venta->od_eje = $request->od_eje;
            $venta->od_add = $request->od_add;
            $venta->od_dp = $request->od_dp;
            $venta->od_af = $request->od_af;
            $venta->oi_esf = $request->oi_esf;
            $venta->oi_cyl = $request->oi_cyl;
            $venta->oi_eje = $request->oi_eje;
            $venta->oi_add = $request->oi_add;
            $venta->oi_dp = $request->oi_dp;
            $venta->oi_af = $request->oi_af;
            $venta->medidas_especiales = $request->medidas_especiales;
            $venta->tipo_lente = $request->tipo_lente;
            $venta->valor_lente = $request->valor_lente;
            $venta->valor_biselado = $request->valor_biselado;
            $venta->comision_lente = $request->comision_lente;
            $venta->filtros_adicionales = $request->filtros_adicionales;
            $venta->id_laboratorio = $request->id_laboratorio;
            $venta->id_laboratorio_bisel = $request->id_laboratorio_bisel;
            $venta->montura = $request->montura;
            $venta->color = $request->color;
            $venta->valor_montura = $request->valor_montura;
            $venta->comision_montura = $request->comision_montura;
            $venta->id_vendedor = $request->id_vendedor;
            $venta->id_estado = $request->id_estado;
            $venta->id_estado_venta = $request->id_estado_venta;
            $venta->id_estado_pago_bisel = $request->id_estado_pago_bisel;
            $venta->observaciones = $request->observaciones;

            if( $request->id_laboratorio === null ){

                $venta->id_estado_pago = 3;

            }else{

                $venta->id_estado_pago = $request->id_estado_pago;

            }

            $venta->save();

            try{

                $user = Auth::user()->id;

                $configuracion = DB::table('configuracions')
                ->select('comision_lente','comision_montura')
                ->where('id_admin', $user)
                ->get();

            }catch(QueryException $queryException){
                return $queryException->getMessage();
            }

            if(empty($request->id_laboratorio_bisel) || $request->id_laboratorio_bisel == null ){

                return response()->json([
                    'status' => 'Ocurrio un error!',
                    'msg' => 'Ocurrio un error al crear la venta el campo laboratorio biselado no puede ser vacio',
                    'code' => 4
                ],400);
            }

            if(empty($request->id_cliente) || $request->id_cliente == null ){

                return response()->json([
                    'status' => 'Ocurrio un error!',
                    'msg' => 'Ocurrio un error al crear la venta el campo cliente no puede ser vacio',
                    'code' => 5
                ],400);
            }

            if(empty($request->id_vendedor) || $request->id_vendedor == null ){

                return response()->json([
                    'status' => 'Ocurrio un error!',
                    'msg' => 'Ocurrio un error al crear la venta el campo vendedor no puede ser vacio',
                    'code' => 6
                ],400);
            }

            if($configuracion[0]->comision_lente !== 0 ){

                if (($request->comision_lente) == 1) {
                    $comision_lente = ($request->valor_lente) * ($configuracion[0]->comision_lente/100);

                    $comision = new Comision();
                    $comision->id_solicitud_venta = $venta->id;
                    $comision->valor_comision = $comision_lente;
                    $comision->tipo_comision = "lente";
                    $comision->save();
                }
            }

            if($configuracion[0]->comision_montura !== 0 ){

            if (($request->comision_montura) == 1) {
                $comision_montura = $configuracion[0]->comision_montura;

                $comision = new Comision();
                $comision->id_solicitud_venta = $venta->id;
                $comision->valor_comision = $comision_montura;
                $comision->tipo_comision = "montura";
                $comision->save();
            }
            }



            return response()->json([
                'status' => 'Operacion Concretada!',
                'msg' => 'Venta Realizada satisfactoriamente',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al realizar la Venta',
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
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->wantsJson()){

            $ventas = SolicitudVenta::findOrFail($id);

            return $ventas;

        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->wantsJson()){

            $this->validate($request, [
                'id_cliente' => 'required',
                //'id_laboratorio' => 'required',
                'id_vendedor' => 'required',
            ]);


                $venta = SolicitudVenta::find($id);

                $venta->fecha = $request->fecha;
                $venta->id_cliente = $request->id_cliente;
                $venta->casillero = $request->casillero;
                $venta->gaveta = $request->gaveta;
                $venta->od_esf = $request->od_esf;
                $venta->od_cyl = $request->od_cyl;
                $venta->od_eje = $request->od_eje;
                $venta->od_add = $request->od_add;
                $venta->od_dp = $request->od_dp;
                $venta->od_af = $request->od_af;
                $venta->oi_esf = $request->oi_esf;
                $venta->oi_cyl = $request->oi_cyl;
                $venta->oi_eje = $request->oi_eje;
                $venta->oi_add = $request->oi_add;
                $venta->oi_dp = $request->oi_dp;
                $venta->oi_af = $request->oi_af;
                $venta->medidas_especiales = $request->medidas_especiales;
                $venta->tipo_lente = $request->tipo_lente;
                $venta->valor_lente = $request->valor_lente;
                $venta->valor_biselado = $request->valor_biselado;
                $venta->comision_lente = $request->comision_lente;
                $venta->filtros_adicionales = $request->filtros_adicionales;
                $venta->id_laboratorio = $request->id_laboratorio;
                $venta->id_laboratorio_bisel = $request->id_laboratorio_bisel;
                $venta->montura = $request->montura;
                $venta->color = $request->color;
                $venta->valor_montura = $request->valor_montura;
                $venta->comision_montura = $request->comision_montura;
                $venta->id_vendedor = $request->id_vendedor;
                $venta->id_estado = $request->id_estado;
                $venta->id_estado_venta = $request->id_estado_venta;
                $venta->observaciones = $request->observaciones;
                $venta->id_estado_pago = $request->id_estado_pago;
                $venta->id_estado_pago_bisel = $request->id_estado_pago_bisel;

                if(empty($request->id_laboratorio_bisel) || $request->id_laboratorio_bisel == null ){

                    return response()->json([
                        'status' => 'Ocurrio un error!',
                        'msg' => 'Ocurrio un error al crear la venta el campo laboratorio biselado no puede ser vacio',
                        'code' => 4
                    ],400);
                }

                if(empty($request->id_cliente) || $request->id_cliente == null ){

                    return response()->json([
                        'status' => 'Ocurrio un error!',
                        'msg' => 'Ocurrio un error al crear la venta el campo cliente no puede ser vacio',
                        'code' => 5
                    ],400);
                }

                if(empty($request->id_vendedor) || $request->id_vendedor == null ){

                    return response()->json([
                        'status' => 'Ocurrio un error!',
                        'msg' => 'Ocurrio un error al crear la venta el campo vendedor no puede ser vacio',
                        'code' => 6
                    ],400);
                }

                if($request->id_estado_venta == 2){

                    $cliente = Usuario::where('id', '=', $request->id_cliente)->first();

                        if($cliente->email !== null){

                            $data = [
                                'fecha' => $request->fecha,
                                'tipo_lente' => $request->tipo_lente,
                                'cliente' => $cliente->nombre_completo,
                            ];

                            try{

                                $subject = "Notificación Lentes y Monturas";
                                $for = $cliente->email;
                                Mail::send('emails.mail',$data, function($msj) use($subject,$for){
                                $msj->from("sya.tecnova@gmail.com");
                                $msj->subject($subject);
                                $msj->to($for);
                                });

                            }catch(\Exception $e){
                                dd($e);
                            }

                        }


                }

                $venta->save();

                return;

            }else{
                return redirect('/');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comision  $comision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if($request->wantsJson()){

            $venta = SolicitudVenta::find($id);
            $venta->id_estado = 2;

            $venta->save();

        }else{
            return redirect('/');
        }
    }
}
