<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCombo extends Model
{

    public function id_combo(){
        return $this->belongsTo(Combo::class, 'id');
    }

    public function id_producto(){
        return $this->belongsTo(Combo::class, 'id');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "detalle_combos";

    /**
     * @var array
     */
    protected $fillable = [
        'id_combo','id_producto'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;

}
