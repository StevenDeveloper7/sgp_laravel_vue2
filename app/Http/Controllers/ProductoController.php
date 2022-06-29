<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use DB;
use App\Usuario;
use App\Negocio;
use Auth;
use Intervention\Image\Facades\Image as Image;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class ProductoController extends Controller
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

                $productos = DB::table('productos as P')
                    ->join('categoria__productos as C', 'P.id_categoria', '=', 'C.id')
                    ->join('negocios as N', 'N.id', '=', 'P.id_negocio')
                    ->where('N.id_usuario', '=', Auth::user()->id)
                    ->select('P.*', 'C.nombre as nombre_categoria','N.nombre_completo as nombre_negocio')
                    ->orderBy('P.id','DESC')
                    ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            //return response()->json($response);*/

            return $productos;


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

            if($request->get('foto'))
            {
               $foto = $request->get('foto');
               $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
               Image::make($request->get('foto'))->save(public_path('fotos-productos/').$name);


             }
             $negocio = Negocio::where('id_usuario', '=', Auth::user()->id)->first();

             $id_negocio = $negocio->id;

        if ($request) {

            /*$negocio = DB::table('negocios')
            ->select('negocios.*')
            ->where('id_usuario', '=', Auth::user()->id)
            ->get();*/
            $producto = new Producto();

            $producto->codigo = $request->codigo;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->id_negocio = $id_negocio;
            $producto->valor = $request->valor;
            $producto->id_categoria = $request->id_categoria;
            $producto->stock = $request->stock;

            if($request->foto == null){
                $producto->foto = 'sin-imagen.jpeg';
            }else{
                $producto->foto = $name;
            }



            $producto->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Producto Creado',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el producto',
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

            $productos = Producto::findOrFail($id);

            return $productos;

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



            $producto =Producto::find($id);
            $producto->codigo = $request->codigo;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->valor = $request->valor;
            $producto->id_categoria = $request->id_categoria;
            $producto->stock = $request->stock;
            if($request->foto == !null){

                $foto = $request->get('foto');
                    $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
                    Image::make($request->get('foto'))->save(public_path('fotos/').$name);

                    $producto->foto = $name;
                }

            $producto->save();

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

            $producto = Producto::find($id);
            $producto->delete();
        }else{
            return redirect('/');
        }
    }
}
