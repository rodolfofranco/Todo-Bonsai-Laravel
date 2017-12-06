<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Entidad User. Tabla users con atributos: id,name,email,password,remember_token,direccion,pais.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Variable que guarda todos los atributos de la tabla
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','direccion','pais'
    ];

    /**
     * Atributos que no se ven en las tablas por motivos de seguridad
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación 1:N entre Usuario y Orden.
     */
        public function usuarioOrden(){
        return $this->hasMany('app\Orden');
    }
    
    /**
     * Función que relaciona dos entidades para Eloquent.Relación 1:1 entre Usuarios y Carrito.
     */
    public function usuarioCarrito(){
        return $this->hasOne('app\Carrito');
    }
}
