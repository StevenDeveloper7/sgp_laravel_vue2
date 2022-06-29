<?php

namespace App\Http\Controllers;
use App\Negocio;
use App\CategoriaNegocio;
use App\Ciudad;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Pedido;
use App\DetallePedido;




class ClientePedidosController extends Controller
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
                    ->select('N.*', 'C.nombre as nombre_categoria', 'Ci.nombre as nombre_ciudad', 'U.nombre_completo as nombre_usuario')
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

    public function pago_electronico(Request $request)
    {

            $pedido = new Pedido();

           // $pedido->object_pago = $request->object_pago;

            $pedido->id_pago = $request->id_pago;

              $pedido->save();

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

    public function obtenerProductosNegocio(Request $request)
    {
        if($request->wantsJson()){

            try{

                 $id_categoriaSelect = $request->id_categoriaSelect;

                 if ($id_categoriaSelect==0){
                    $productos = DB::table('productos as P')
                   ->select('P.*')
                   ->where('id_negocio', $request->id_negocio)
                   ->get();
                 }else{
                    $productos = DB::table('productos as P')
                   ->select('P.*')
                   ->where('P.id_categoria', '=',$id_categoriaSelect)
                   ->where('id_negocio', $request->id_negocio)
                   ->get();
                 }



            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $productos;


        }else{
            return redirect('/');
        }
    }


    public function obtenerCombosNegocio(Request $request)
    {
        if($request->wantsJson()){


            try{

                $combos = DB::table('combos as C')
                   ->select('C.*')
                  // ->join('detalle_combos as DC', 'DC.id_combo', '=', 'C.id')

                   ->where('C.id_negocio', $request->id_negocio)
                   ->get();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $combos;


        }else{
            return redirect('/');
        }
    }

    public function generarPedido (Request $request){



      if($request->wantsJson()){



            //credenciales envio sms
            $client = 10018131;
            $api = 'APkBHYM1hHa9vnHExfe7abCF41ePkU';




        try{
            $pedido = new Pedido();
            $user_id = Auth::user()->id;
            $arrayCarrito=json_decode($request->arrayCarrito);
            //guardar pedidos


              $pedido->id_usuario =$user_id;
              $pedido->id_negocio=$request->id_negocio;
              //$pedido->id_estado=4;
              $pedido->valor_total= $request->valor;
              $pedido->fecha= $request->fecha;

            if($request->pago_electronico == 0){

                $pedido->id_estado=1;
            }else{
                $pedido->id_estado=4;
            }

                $pedido->save();

              $idPedido = $pedido->id;

            foreach ($arrayCarrito as $producto) {

                if($producto[0]->id_combo=="null"){
                    DB::table('detalle_pedidos')->insert([
                        'id_pedido' => $idPedido,
                        //'numero_documento' =>$handle->unique()->numberBetween($min = 1, $max = 200),
                        'id_producto' =>$id_producto=$producto[0]->id,
                        'cantidad' => $producto[0]->cantidad,

                    ]);
                }else{

                    DB::table('detalle_pedidos')->insert([
                        'id_pedido' => $idPedido,
                        //'numero_documento' =>$handle->unique()->numberBetween($min = 1, $max = 200),
                        'id_combo' =>$producto[0]->id_combo,

                    ]);
                }



            }

            //Envio sms

            $numero_telefono = DB::table('negocios as N')
            ->select('N.telefono')
            ->where('N.id', $request->id_negocio)
            ->get();

            $cliente = DB::table('usuarios as U')
            ->select('U.nombre_completo')
            ->where('U.id', $user_id)
            ->get();

            //$hablame = new \Andreshg112\HablameSms\Client($client, $api);

            //$response = $hablame->checkBalance();

            //$phoneNumber = $numero_telefono[0]->telefono;

            //$sms = 'Tienes un nuevo pedido de' .$cliente[0]->nombre_completo.' '.'por un valor de'.' '.'$'.$request->valor .' '.', ingresa a Traelo ve!';


            //$response = $hablame->sendMessage($phoneNumber, $sms);

                    return response()->json([
                        'status' => 'Muy bien!',
                        'msg' => 'Pedido Creado',
                        'code' => 2,
                        'id_pedido' => $pedido->id,
                        //'msm' => $response
                    ],201);



        }catch(QueryException $queryException){

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el Pedido',
                'code' => 3
            ],400);
        }



    }else{
        return redirect('/');
    }
    }



    public function getCategoriasNegocios(Request $request)
    {
        if($request->wantsJson()){

            try{

                $categorias = DB::table('categoria__productos as C')
                   ->select('C.*')
                  // ->join('detalle_combos as DC', 'DC.id_combo', '=', 'C.id')
                  ->where('C.id_negocio', $request->id_negocio)
                   ->get();

            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $categorias;


        }else{
            return redirect('/');
        }
    }

}
