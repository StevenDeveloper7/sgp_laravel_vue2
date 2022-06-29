<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Pedido;

class PagoelectronicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }


    public function pago_electronico(Request $request)
    {



        $status = $request->data['transaction']['status'];

        if($status == "APPROVED"){

            $id_pedido = $request->data['transaction']['reference'];
            $id_pago = $request->data['transaction']['id'];

            $pedido = Pedido::find($id_pedido);

            $pedido->pago_electronico = 1;
            $pedido->id_pago= $id_pago;
            $pedido->id_estado = 1;

            $pedido->save();

         }

         if($status == "DECLINED"){

            $id_pedido = $request->data['transaction']['reference'];
            $id_pago = $request->data['transaction']['id'];

            $pedido = Pedido::find($id_pedido);

            $pedido->id_estado = 5;

            $pedido->save();

         }


         return json_encode($request->transaction);

    }


    public function pago_electronico_tarjeta(Request $request)
    {


        $status = $request->data['status'];

        if($status == "APPROVED"){

            $id_pedido = $request->data['reference'];
            $id_pago = $request->data['id'];

            $pedido = Pedido::find($id_pedido);

            $pedido->pago_electronico = 1;
            $pedido->id_pago= $id_pago;
            $pedido->id_estado = 1;

            $pedido->save();

         }

         if($status == "DECLINED"){

            $id_pedido = $request->data['reference'];
            $id_pago = $request->data['id'];

            $pedido = Pedido::find($id_pedido);

            $pedido->id_estado = 5;

            $pedido->save();

         }


         return 'ok';

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
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo_documento  $tipo_documento
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
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo_documento  $tipo_documento
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
