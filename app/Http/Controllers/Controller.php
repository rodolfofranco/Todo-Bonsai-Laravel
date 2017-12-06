<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Wishlist;
use App\Carrito;
use App\Orden;
use App\User;
use Illuminate\Support\Facades\View;

/**
 * 
 * Controlador encargado de las funcionalidades principales de la App
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    /**
     *Función que envía el valor del país del usuario ingresado para la internacionalización 
     * 
     */
    public function index(){
        $user = Auth::user();
        if($user == null){
            $pais = null;
        }
        else{
        $pais = $user->pais;
        }
        
        return view('welcome',['pais'=>$pais]);
    }
    
    /**
     * Función que toma todos los productos y wishlists de la base de datos, y es enviada a la visa de Productos
     * 
     */
    public function allProducts(){
        
        $productos = DB::table('productos')->get();
        
        $idUsuario = Auth::id();

        $wishlists = Wishlist::where('user_id',$idUsuario)->get();
        
        $user = Auth::user();
        if($user == null){
            $pais = null;
        }else{
        $pais = Auth::user()->pais;
        }
        
        return view('producto', 
        ['productos' => $productos ,
          'wishlists' => $wishlists ,
          'pais' => $pais]);
    }
    
    /**
     * Función que se encarga de la internacionalización de la App
     */
    public function changePais(){
        
        
        $vista =request('pais');
        $pais = request('selPais');
        $idUsuario = Auth::id();
        $usuario = User::find($idUsuario);
        $usuario->pais = $pais;
        $usuario->save();
        
        if($vista == 'producto'){
            
            $productos = DB::table('productos')->get();
            $wishlists = Wishlist::where('user_id',Auth::id())->get();
            
            return view('producto', 
            ['productos' => $productos ,
            'wishlists' => $wishlists,
            'pais' => $pais]);
            
        }
        else if($vista == 'welcome'){
            return view('welcome',['pais' => $pais]);
        }
        else if($vista == 'carrito'){
        $carrito = Carrito::where('user_id',Auth::id())->first();
        // Hay que devolver los productos que hay en el carrito
        
        $productos = $carrito->productos()->get();
        return view('carrito',['productos' => $productos,'pais' => $pais]);
        }
        else if($vista == 'wishlist'){
            
               
                $wishlist = Wishlist::where('user_id',Auth::id())->get();
                
                if(count($wishlist) < 1){
                    $array = array();
                }
                else{
                    
                foreach($wishlist as $wish){
                    $array[] = $wish->productoWishlist()->get();
                    }
                }
                
                
               
                return view('wishlist',['wishlists' => $wishlist, 'productos' => $array,'pais' => $pais]);
        }
        else if($vista == 'order'){
        $orders = Orden::where('user_id',Auth::id())->get();
        
       if(count($orders) < 1){
            $array = array();
        }
        else{
            
        foreach($orders as $order){
            $array[] = $order->productoOrden()->get();
            }
        }
        
        return view('order', ['orders' => $orders, 'productos' => $array,'pais' => $pais]);
        }
        else if($vista == 'register'){
            return view('register');
        }
        else if($vista == 'login'){
            return view('login');
        }
        else{
            //Admin
        }
        
        
    }
    
    /**
     * Función que se encarga de intercambiar de la base de datos MySQL a PostgreSQL
     */
    public function changeDatabase(){
        
        $database = request('db');
        
        if($database == "mysql"){
        DB::setDefaultConnection('mysql');
        $pais = Auth::user()->pais;
        }
        else{
        DB::setDefaultConnection('pgsql');  
        $pais=null;
        }
        
        
        
        return view ('welcome',['pais' => $pais]);
    }
    
    
}
