<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Entidad Orden. Tabla ordens con atributos: id,direccion,fecha,montoTotal,numeroTarjeta,tipoPago
 */
class Orden extends Model
{
    //
    /**
     * Variable que guarda todos los atributos de la tabla
     * 
     *@var array 
     */
    protected $fillable = ['direccion', 'fecha','montoTotal','numeroTarjeta','tipoPago'];


    /**
     * Función que relaciona dos entidades para Eloquent.Relación 1:N entre Usuario y Orden.
     */
    public function usuarioOrden(){
        return $this->belongsTo('App\Usuario');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Orden.
     */
    public function productoOrden(){
        return $this->belongsToMany('App\Producto');
    }
    
}

