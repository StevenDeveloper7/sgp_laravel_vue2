<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{

    public function id_estado(){
        return $this->belongsTo(Estado::class, 'id');
    }

    public function id_negocio(){
        return $this->belongsTo(Negocio::class, 'id');
    }

    public function combo_detalle(){
        return $this->hasMany(DetalleCombo::class, 'id_combo');
    }

    /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "combos";

    /**
     * @var array
     */
    protected $fillable = [
        'id_negocio','foto', 'nombre', 'valor', 'descripcion', 'id_estado'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
