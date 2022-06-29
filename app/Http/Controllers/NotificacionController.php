<?php

namespace App\Http\Controllers;

use App\Ciudad;
use Illuminate\Http\Request;
use Auth;
use DB;

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: application/xml; charset=utf-8");

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    public function canal_negocio(Request $request){

        if($request->wantsJson()){


            if( Auth::user()->id_role === 1 ){
                $user = Auth::user()->id;
            }if( Auth::user()->id_role === 3 ){
                $user = Auth::user()->id_admin;
            }


            $canal_negocio = DB::table('negocios as N')
            ->join('usuarios as U','U.id', '=', 'N.id_usuario')
            ->select('N.canal')
            ->where('N.id_usuario', $user)
            ->get();

            return $canal_negocio;


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
