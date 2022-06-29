<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{

    public function combos(){
        return $this->hasMany(Combo::class, 'id_negocio');
    }

    public function id_usuario(){
        return $this->belongsTo(Usuario::class, 'id');
    }

     /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "negocios";

    /**
     * @var array
     */
    protected $fillable = [
        'nit','nombre_completo', 'telefono', 'direccion', 'id_ciudad', 'id_usuario', 'id_categoria', 'long', 'lat'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
