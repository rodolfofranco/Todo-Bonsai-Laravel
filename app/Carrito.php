<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Entidad Carrito. Tabla carritos con atributos: id,nombre,correo,clave,direccion y pais
 */
class Carrito extends Model
{
    
    
    /**
     * Variable que guarda todos los atributos de la tabla
     * 
     *@var array 
     */
    protected $fillable = ['nombre', 'correo','clave','direccion','pais'];
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Carrito. 
     */
    public function productos(){
        return $this->belongsToMany('App\Producto');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación 1:1 entre Usuario y Carrito.
     */
    public function usuarios(){
        return $this->belongsTo('App\User');
    }
    
}
