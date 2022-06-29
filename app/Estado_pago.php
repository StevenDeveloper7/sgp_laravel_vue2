<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_pago extends Model
{
    public function estado_pago(){
        return $this->hasMany(SolicitudVenta::class, 'id_estado_pago');
    }
     /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "estado_pagos";

    /**
     * @var array
     */
    protected $fillable = [
        'nombre','descripcion'
    ];
}
