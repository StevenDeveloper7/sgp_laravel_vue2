<?php

namespace App\Http\Controllers;

use App\Combo;
use App\DetalleCombo;
use App\Negocio;
use App\Categoria_Producto;
use App\Producto;
use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\Facades\Image as Image;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->wantsJson()){

        $user = Auth::user()->id;

       /* $user = Auth::user()->id;

        $combos = Combo::with(['combo_detalle' => function($q)
        {
                $q->join('productos as P', 'P.id', '=', 'id_producto');

        }])
        ->leftjoin('negocios as N', 'id_negocio', '=', 'N.id')
        ->leftjoin('usuarios as U', 'N.id_usuario', '=', 'U.id')
        ->select('Combos.*', 'N.nombre_completo as nombre_negocio')
        ->where('U.id', $user)
        ->where('Combos.id_estado', 1)
        ->get();

        return $combos;*/

        $combos = DB::table('combos as C')
        //->join('detalle_combos as Dc', 'C.id', '=', 'Dc.id_combo')
        //->join('productos as P', 'Dc.id_producto', '=', 'P.id')
        ->join('negocios as N', 'C.id_negocio', '=', 'N.id')
        ->join('usuarios as U', 'N.id_usuario', '=', 'U.id')
        ->select('C.*', 'N.nombre_completo as nombre_negocio')
        ->where('U.id', $user)
        ->where('C.id_estado', 1)
        ->get();

        return $combos;


        }else{
            return redirect('/');
        }

    }


    public function select_negocio(Request $request)
    {
        if($request->wantsJson()){

            $user = Auth::user()->id;

            $negocios = Negocio::select('id', 'nombre_completo')
            ->where('id_usuario', $user)
            ->orderBy('id', 'asc')->get();

            return ['negocios' => $negocios];
        }else{
            return redirect('/');
        }
    }

    public function select_categoria_producto(Request $request)
    {

        if($request->wantsJson()){

            $user = Auth::user()->id;

            $negocio = Negocio::select('id')
            ->where('id_usuario', $user)
            ->orderBy('id', 'asc')->get();


            $cat_productos = Categoria_Producto::select('id', 'nombre')
            ->where('id_negocio', $negocio[0]->id)
            ->orderBy('id', 'asc')->get();

            return $cat_productos;

        }else{
            return redirect('/');
        }
    }

    public function select_producto(Request $request,$id_cat_producto)
    {

        if($request->wantsJson()){

            $user = Auth::user()->id;

            $negocio = Negocio::select('id')
            ->where('id_usuario', $user)
            ->orderBy('id', 'asc')->get();


            $productos = Producto::select('id', 'nombre', 'foto', 'descripcion')
            ->where('id_negocio',$negocio[0]->id)
            ->where('id_categoria',$id_cat_producto)
            ->orderBy('id', 'asc')->get();


            return $productos;

        }else{
            return redirect('/');
        }
    }

    public function search_detalle_combo(Request $request,$id)
    {

        if($request->wantsJson()){


            $detalle_combo = DB::table('detalle_combos as Dc')
            ->join('productos as P', 'Dc.id_producto', '=', 'P.id')
            ->select('P.id', 'P.nombre', 'P.descripcion', 'P.foto', 'Dc.id as id_detalle_combo')
            ->where('id_combo',$id)

            ->orderBy('id', 'asc')->get();


            return $detalle_combo;

        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {




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

            if($request->get('foto'))
            {
               $foto = $request->get('foto');
               $name = time().'.' . explode('/', explode(':', substr($foto, 0, strpos($foto, ';')))[1])[1];
               Image::make($request->get('foto'))->save(public_path('fotos-productos/').$name);


             }

             $user = Auth::user()->id;

            $negocio = Negocio::select('id')
            ->where('id_usuario', $user)
            ->orderBy('id', 'asc')->get();


            $combo = new Combo();

            $combo->id_negocio = $negocio[0]->id;
            $combo->nombre = $request->nombre;
            $combo->valor = $request->valor;
            $combo->descripcion = $request->descripcion;
            $combo->id_estado = 1;

            if($request->foto == null){
                $combo->foto = 'sin-imagen.jpeg';
            }else{
                $combo->foto = $name;
            }



            $combo->save();



            foreach ($request->arraycombo as  $combo_productos=> $valor)
            {

                DetalleCombo::create(['id_combo' => $combo->id,'id_producto' => $valor['id']]);

            }



        }else{
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
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
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //dd(request()->all());

        if($request->wantsJson()){

        $combo = Combo::find($id);


        $combo->nombre = $request->nombre;
        $combo->valor = $request->valor;
        $combo->descripcion = $request->descripcion;
        $combo->id_estado = 1;

        $combo->save();

        foreach ($request->arraycombo as  $combo_productos=> $valor)
            {
                if(!array_key_exists("id_detalle_combo", $valor))
                    DetalleCombo::create(['id_combo' => $combo->id,'id_producto' => $valor['id']]);
            }

        }else{
            return redirect('/');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->wantsJson()){

            $combo = Combo::find($id);
            $combo->id_estado = 2;

            $combo->save();

        }else{
            return redirect('/');
        }
    }

    public function delete_detalle_combo(Request $request, $id)
    {
        if($request->wantsJson()){

            $detalle_combo = DetalleCombo::find($id);

            $detalle_combo->delete();

        }else{
            return redirect('/');
        }
    }
}
