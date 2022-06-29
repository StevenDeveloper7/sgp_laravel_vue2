<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\EstadoPedido;
use App\DetallePedido;
use App\Usuario;
use App\Combo;
use App\Producto;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class PedidoClienteController extends Controller
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

                $pedidos = DB::table('pedidos as P')
                    ->join('estado_pedidos as E', 'P.id_estado', '=', 'E.id')
                    ->join('usuarios as U', 'P.id_usuario', '=', 'U.id')
                    ->join('negocios as N', 'P.id_negocio', '=', 'N.id')
                    ->join('detalle_pedidos as D', 'P.id', '=', 'D.id_pedido')
                    ->join('productos as Pr', 'D.id_producto', '=', 'Pr.id')
                    ->distinct()
                    ->where('P.id_usuario', '=', Auth::user()->id)
                    ->where('P.id_estado','!=','4')
                    ->where('P.id_estado','!=','5')
                    ->select('P.*','N.nombre_completo as nombre_negocio', 'N.direccion as direccion_negocio', 'N.telefono as telefono_negocio',
                    'E.nombre as nombre_estado', 'U.nombre_completo as nombre_cliente','N.foto as foto','U.foto as foto_usuario')
                    ->orderBy('P.id','DESC')
                    ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            //return response()->json($response);*/

            return $pedidos;


        }else{
            return redirect('/');
        }
    }


    public function create()
    {
        //
    }


    public function show()
    {
        //
    }


    public function edit(Request $request, $id)
    {
        if($request->wantsJson()){

            $pedidos = Pedido::findOrFail($id);

            return $pedidos;

        }else{
            return redirect('/');
        }
    }


    public function update(Request $request, $id)
    {
        if($request->wantsJson()){


            $pedido =Pedido::find($id);
            $pedido->id_estado = $request->id_estado;
            $pedido->tiempo_entrega = $request->tiempo_entrega;


            $pedido->save();

        }else{
            return redirect('/');
        }
    }


    public function destroy(Request $request, $id)
    {

        if($request->wantsJson()){

            $pedido = Pedido::find($id);
            $pedido->delete();
        }else{
            return redirect('/');
        }
    }

    public function select_estado_pedido(Request $request)
    {
        if($request->wantsJson()){

            $estados = EstadoPedido::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['estados' => $estados];

        }else{
            return redirect('/');
        }
    }

    public function search_detalle_pedido(Request $request,$id)
    {

        if($request->wantsJson()){


            $detalle = DB::table('detalle_pedidos as D')
            ->join('productos as P', 'D.id_producto', '=', 'P.id')
            ->select( 'D.*', 'P.nombre as nombre_producto', 'P.valor as valor_producto',)
            ->where('id_pedido',$id)

            ->orderBy('id', 'asc')->get();


            return $detalle;

        }else{
            return redirect('/');
        }
    }

    public function datos_cliente(Request $request,$id)
    {

        if($request->wantsJson()){


            $usuarios = Usuario::where('id',$id)->get();

            return $usuarios;

        }else{
            return redirect('/');
        }
    }

    public function datos_pedido(Request $request,$id)
    {

        if($request->wantsJson()){


            $pedidos = DB::table('pedidos as P')
            ->select('P.*')
            ->where('id',$id)
            ->orderBy('P.id','DESC')
            ->get();

            return $pedidos;

        }else{
            return redirect('/');
        }
    }

    public function datos_combo(Request $request,$id)
    {

        if($request->wantsJson()){


            $combos = DB::table('detalle_pedidos as D')
            ->join('combos as C', 'D.id_combo', '=', 'C.id')
            ->select( 'D.*', 'C.nombre as nombre_combo', 'C.valor as valor_combo', 'C.descripcion as descripcion_combo')
            ->where('id_pedido',$id)

            ->orderBy('id', 'asc')->get();


            return $combos;

        }else{
            return redirect('/');
        }
    }



}
