<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;
use Auth;

class ClienteController extends Controller
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

                $clientes = DB::table('usuarios as U')
                    ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
                    ->join('estados as E', 'U.id_estado', '=', 'E.id')
                    ->select('U.*', 'T.nombre as tipo_documento', 'E.nombre as nombre_estado')
                    ->where('U.id_admin','=', $user)
                    ->where('U.id_estado','=',1)
                    ->where('U.id_role','=',3)
                    ->orderBy('U.id','DESC')
                    ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            //return response()->json($response);*/

            return $clientes;


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
                //'id_tipo_documento' => 'required',
                //'numero_documento' => 'required',
                'nombre_completo' => 'required',
                //'telefono' => 'required',
                //'direccion' => 'required',
            ]);

        $cliente = new Usuario();

        // $validar_documento = Usuario::where('numero_documento', '=', $request->numero_documento)->first();

        /*$validar_correo = Usuario::where('email', '=', $request->email)->first();


        if (!empty($validar_correo)) {

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'El correo ya se encuentra registrado',
                'code' => 1
            ],400);
        }*/

        if($request->wantsJson()) {

            $cliente->id_tipo_documento = $request->id_tipo_documento;
            $cliente->numero_documento = $request->numero_documento;
            $cliente->nombre_completo = $request->nombre_completo;
            $cliente->telefono = $request->telefono;
            $cliente->direccion = $request->direccion;
            $cliente->id_estado = $request->id_estado;
            $cliente->id_role = $request->id_role;
            $cliente->email= $request->email;


            if( Auth::user()->id_role === 1){
                $cliente->id_admin = Auth::user()->id;
            }if( Auth::user()->id_role === 2 || Auth::user()->id_role === 4 ){
                $cliente->id_admin = Auth::user()->id_admin;
            }


            $cliente->save();

            return response()->json([
                'status' => 'Muy bien!',
                'msg' => 'Cliente creado',
                'code' => 2
            ],201);

        }else{

            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Ocurrio un error al crear el cliente',
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

            $clientes = Usuario::findOrFail($id);

            return $clientes;

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
                'id_tipo_documento' => 'required',
                //'numero_documento' => 'required',
                'nombre_completo' => 'required',
                'telefono' => 'required',
                'direccion' => 'required',
            ]);

            Usuario::find($id)->update($request->all());

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

            $cliente = Usuario::find($id);
            $cliente->id_estado = 2;

            $cliente->save();

        }else{
            return redirect('/');
        }
    }
}
