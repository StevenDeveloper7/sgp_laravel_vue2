<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    public function producto_detalle(){
        return $this->hasMany(DetalleCombo::class, 'id_producto');
    }

     /**
     * Tabla asociada con el modelo
     * @var string
     */
    protected $table = "productos";

    /**
     * @var array
     */
    protected $fillable = [
        'id_categoria','id_negocio','foto', 'codigo', 'nombre', 'descripcion', 'unidad_medida', 'valor', 'stock'
    ];

    /**
     * @var boolean
     */
    public $timestamps = false;
}
