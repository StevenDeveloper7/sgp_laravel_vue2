<?php

namespace App\Http\Controllers;


use App\Negocio;
use App\CategoriaNegocio;
use App\Ciudad;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\FileUpload;
use Intervention\Image\Facades\Image as Image;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class NegocioController extends Controller
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
                    ->where('N.id_usuario', '=', Auth::user()->id)
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

    public function validar_negocio(Request $request)
    {
        if($request->wantsJson()){


            $user = Auth::user()->id;

            $negocio = DB::table('negocios as N')
                            ->select('N.*')
                            ->where('id_usuario', $user)
                            ->first();

            if(!empty($negocio) ){

                return 1;

            }else{

                return 0;
            }

        }else{
            return redirect('/');
        }

    }


    public function position(Request $request, $id)
    {
        $position = DB::table('negocios as N')
                            ->select('N.lat', 'N.long')
                            ->where('N.id', $id)
                            ->get();

        return $position;
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
        //return $request->all();

        if($request->wantsJson()){


            if($request->get('foto'))
            {
               $foto = $request->get('foto');
               $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
               Image::make($request->get('foto'))->save(public_path('fotos-negocios/').$name);


             }


             $user = Auth::user()->id;
             $negocio = new Negocio();

             $validar_nit = Negocio::where('nit', '=', $request->nit)->first();



            if (empty($validar_nit)) {

            $negocio->nit = $request->nit;
            $negocio->nombre_completo = $request->nombre;
            $negocio->telefono = $request->telefono;
            $negocio->descripcion = $request->descripcion;
            $negocio->id_usuario = $user;
            $negocio->id_ciudad = $request->id_ciudad;
            $negocio->id_categoria = $request->id_categoria;
            $negocio->direccion = $request->direccion;
            $negocio->long = $request->long;
            $negocio->lat = $request->lat;
            $negocio->canal = $user.$negocio->id;
            $negocio->hora_apertura = $request->hora_apertura;
            $negocio->hora_cierre = $request->hora_cierre;


            if($request->foto == null){
                $negocio->foto = 'logo-traelo-ve.png';
            }else{
                $negocio->foto = $name;
            }




            $negocio->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Negocio Creado',
                'code' => 1
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el Negocio',
                'code' => 2
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

            $negocios = Negocio::findOrFail($id);

            return $negocios;

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

            //$validar_nit = Negocio::where('nit', '=', $request->nit)->first();

            if( empty($request->hora_apertura) || empty($request->hora_cierre) ){

                return response()->json([
                    'status' => 'Ocurrio un error!',
                    'msg' => 'la hora de apertura y cierre no deben ser vacias',
                    'code' => 3
                ],400);
            }

            $user = Auth::user()->id;


            $negocio = Negocio::find($id);

            $negocio->nit = $request->nit;
            $negocio->nombre_completo = $request->nombre;
            $negocio->telefono = $request->telefono;
            $negocio->descripcion = $request->descripcion;
            $negocio->id_usuario = $user;
            $negocio->id_ciudad = $request->id_ciudad;
            $negocio->id_categoria = $request->id_categoria;
            $negocio->direccion = $request->direccion;
            $negocio->long = $request->long;
            $negocio->lat = $request->lat;
            $negocio->hora_apertura = $request->hora_apertura;
            $negocio->hora_cierre = $request->hora_cierre;
            $negocio->check_key_wompi = $request->check_key_wompi;
            $negocio->key_wompi = $request->key_wompi;

            if($request->foto == !null){

                $foto = $request->get('foto');
                    $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
                    Image::make($request->get('foto'))->save(public_path('fotos-negocios/').$name);

                    $negocio->foto = $name;
                }

            $negocio->save();


                return response()->json([
                    'status' => 'Muy bien!',
                    'msg' => 'Negocio Actualizado',
                    'code' => 1
                ],201);

        }else{
            return redirect('/');
        }
    }


    public function destroy(Request $request, $id)
    {

        if($request->wantsJson()){

            $negocio = negocio::find($id);
            $negocio->delete();
        }else{
            return redirect('/');
        }
    }

    public function select_categoria(Request $request)
    {
        if($request->wantsJson()){

            $categorias = CategoriaNegocio::select('id', 'nombre', 'descripcion', 'marcador')
            ->orderBy('id', 'asc')->get();

            return ['categorias' => $categorias];

        }else{
            return redirect('/');
        }
    }

    public function select_ciudad(Request $request)
    {
        if($request->wantsJson()){

            $ciudades = Ciudad::select('id', 'nombre')
            ->orderBy('id', 'asc')->get();

            return ['ciudades' => $ciudades];

        }else{
            return redirect('/');
        }
    }
}
