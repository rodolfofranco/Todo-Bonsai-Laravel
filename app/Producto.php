<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Entidad Producto. Tabla productos con atributos: id,nombre,precio,descripcion,link,categoria
 */
class Producto extends Model
{
    
    /**
     * Variable que guarda todos los atributos de la tabla
     * 
     *@var array 
     */
    protected $fillable = ['nombre', 'precio','descripcion','link','categoria'];
    
     /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Orden.
     */
    public function ordenes()
    {
        return $this->belongsToMany('app\Orden');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Wishlist.
     */
    public function wishlists(){
        return $this->belongsToMany('app\Wishlist');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Carrito.
     */
    public function carritos(){
        return $this->belongsToMany('app\Carrito');
    }
}
