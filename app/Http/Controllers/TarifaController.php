<?php

namespace App\Http\Controllers;

use App\Tarifa;
use Illuminate\Http\Request;
use DB;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




    }


    public function valor_tarifa(Request $request)
    {

        $now = new \DateTime();
        $date = $now->format('d-m');
        $hour = $now->format('H:i');

        $feriados  = array(
            '01-01', //Año nuevo
            '06-01', //Reyes
            '23-03', //San josé
            '09-04', //Jueves santo
            '10-04', //Viernes santo
            '01-05', //Día del trabajo
            '25-05', //Día de la ascensión
            '15-06', //Corpues christi
            '22-06', //Sagrado corazón
            '29-06', //San pedro y san pablo
            '20-07', //Día de la independencia
            '07-08', //Batalla de boyacá
            '17-08', //Día de la asunción
            '12-10', //Día de la raza
            '02-11', //Día de todos los santos
            '16-11', //Independencia de cartagena
            '08-12', //Inmaculada concepción
            '25-12', //Navidad
        );

        if(in_array($date, $feriados)){
            $feriado = 1;
        }
        else{
            $feriado = 0;
        }

        $distance = $request->distance;

        $distance_format = explode(" ", $distance);

        $final_distance = $distance_format[0];


        $tarifas = Tarifa::get();

        $tarifa_base = $tarifas[0]->tarifa_base;
        $tarifa_minima = $tarifas[0]->tarifa_minima;
        $valor_km = $tarifas[0]->valor_km;
        $recargo_nocturno = $tarifas[0]->recargo_nocturno;
        $recargo_festivo = $tarifas[0]->recargo_festivo;

        if($final_distance <= 1) {

            $tarifa_inicial = $tarifa_minima;

        }else if($final_distance >= 1){

            $tarifa_inicial = $tarifa_base;
        }


        if($feriado == 1){

            $tarifa_festivo = $recargo_festivo;

        }else if($feriado == 0 ){

            $tarifa_festivo = 0;
        }


        if($hour <= '18:59'){

            $tarifa_nocturna = 0;

        }else if($hour >= '19:00' ){

            $tarifa_nocturna = $recargo_nocturno;
        }


        $valor_domicilio = $tarifa_inicial + $tarifa_festivo + $tarifa_nocturna + ($final_distance *  $valor_km);

        //dd($valor_domicilio);

        return $valor_domicilio;


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
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarifa $tarifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarifa $tarifa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarifa $tarifa)
    {
        //
    }
}
