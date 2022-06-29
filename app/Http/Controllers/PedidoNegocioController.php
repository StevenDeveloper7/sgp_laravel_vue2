<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\EstadoPedido;
use App\DetallePedido;
use App\DetalleCombo;
use App\Usuario;
use App\Combo;
use App\Producto;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class PedidoNegocioController extends Controller
{

    public function index(Request $request)
    {
        if($request->wantsJson()){

            try{

                if( Auth::user()->id_role === 1 ){
                    $user = Auth::user()->id;
                }if( Auth::user()->id_role === 3 ){
                    $user = Auth::user()->id_admin;
                }

                $pedidos = DB::table('pedidos as P')
                    ->join('estado_pedidos as E', 'P.id_estado', '=', 'E.id')
                    ->join('usuarios as U', 'P.id_usuario', '=', 'U.id')
                    ->join('negocios as N', 'P.id_negocio', '=', 'N.id')
                    ->join('usuarios as Ad', 'N.id_usuario', '=', 'Ad.id')
                    ->select('P.*', 'E.nombre as nombre_estado', 'U.nombre_completo as nombre_cliente','U.foto as foto_cliente','N.nombre_completo as nombre_negocio','N.foto as foto_negocio')
                    ->where('Ad.id', $user)
                    ->where('P.id_estado','!=','4')
                    ->where('P.id_estado','!=','5')
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

            //credenciales envio sms
            $client = 10018131;
            $api = 'APkBHYM1hHa9vnHExfe7abCF41ePkU';
            $hablame = new \Andreshg112\HablameSms\Client($client, $api);


            $pedido =Pedido::find($id);
            $pedido->id_estado = $request->id_estado;


                    if($request->id_estado == 2){

            $cliente = Usuario::where('id', '=', $request->id_usuario)->first();

                if($cliente->email !== null){

                    $data = [
                        'fecha' => $request->fecha,
                        'valor_total' => $request->valor_total,
                        'cliente' => $cliente->nombre_completo,
                    ];

                    try{

                        $subject = "Notificación de Pedido Aceptado en Traelo-Ve";
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


            $pedido->tiempo_entrega = $request->tiempo_entrega;
            $pedido->save();


            if ($request->id_estado == 2) {

            //Envio sms

            $cliente = DB::table('usuarios as U')
            ->select('U.telefono', 'U.nombre_completo')
            ->where('U.id', $pedido->id_usuario)
            ->get();

            $negocio = DB::table('negocios as N')
            ->select('N.nombre_completo')
            ->where('N.id', $pedido->id_negocio)
            ->get();


            $response = $hablame->checkBalance();

            $phoneNumber = $cliente[0]->telefono;

            $sms = 'Sr(a)'.' '.$cliente[0]->nombre_completo.' su pedido en'.' '.$negocio[0]->nombre_completo.' '.'por un valor de'.' '.'$'.$pedido->valor_total.' '.'fue aceptado'.' '.', si quieres puedes acceder al chat de traelo ve! para ultimar detalles';


            $response = $hablame->sendMessage($phoneNumber, $sms);

            }

            if ($request->id_estado == 3) {

                $detalles = DetallePedido::where('id_pedido',$id)->get();

                 foreach ($detalles as $detalle ) {

                    $id_producto=$detalle->id_producto;
                    $id_combo=$detalle->id_combo;

                    if($id_combo){
                        //traer todos los ids de los productos que contiene este combo
                        $detalleCombo = DetalleCombo::where('id_combo',$id_combo)->get();
                        foreach ($detalleCombo as $detalle ) {
                            $producto = Producto::where('id',$detalle->id_producto)->get();
                            $stock = $producto[0]->stock;
                            $newStock = $stock -1;

                            DB::table('productos')
                           ->where('id', $producto[0]->id)
                           ->update(['stock' => $newStock]);
                        }


                    }else{
                     $producto = Producto::where('id',$detalle->id_producto)->get();
                     $stock = $producto[0]->stock;
                     $newStock = $stock - $detalle->cantidad;

                     DB::table('productos')
                    ->where('id', $producto[0]->id)
                    ->update(['stock' => $newStock]);


                    }

                     //Envio sms

                    $cliente = DB::table('usuarios as U')
                    ->select('U.telefono', 'U.nombre_completo')
                    ->where('U.id', $pedido->id_usuario)
                    ->get();

                    $negocio = DB::table('negocios as N')
                    ->select('N.nombre_completo')
                    ->where('N.id', $pedido->id_negocio)
                    ->get();


                    $response = $hablame->checkBalance();

                    $phoneNumber = $cliente[0]->telefono;

                    $sms = 'Sr(a)'.' '.$cliente[0]->nombre_completo.' su pedido en'.' '.$negocio[0]->nombre_completo.' '.'por un valor de'.' '.'$'.$pedido->valor_total.' '.'fue despachado'.' '.', tiempo apróximado de entrega'.' '.$request->tiempo_entrega;


                    $response = $hablame->sendMessage($phoneNumber, $sms);


                 }

                 return "ok";

            }

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
