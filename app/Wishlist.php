<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Entidad Wishlist. Tabla wishlists con atributos: id, nombre
 */
class Wishlist extends Model
{
    //
     /**
     * Variable que guarda todos los atributos de la tabla
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'user_id'
    ];
    
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación 1:N entre Usuario y Wishlist.
     */
    public function usuarioWishlist(){
        return $this->belongsTo('App\User');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación N:M entre Productos y Wishlist.
     */
    public function productoWishlist(){
        return $this->belongsToMany('App\Producto');
    }
}
