<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "configuracions";

    /**
     * @var array
     */
    protected $fillable = [
        'comision_lente', 'comision_montura'
    ];
}
