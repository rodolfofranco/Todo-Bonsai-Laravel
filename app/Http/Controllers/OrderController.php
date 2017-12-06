<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use App\Producto;
use App\Carrito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Controlador Orden que se encarga de las funcionalidades de la vista Order
 */
class OrderController extends Controller
{
    /**
     * Función que crea una nueva instancia del controlador
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Función que encarga de mandar todas las Ordenes y Productos de cada Orden desde la base de datos a la vista.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pais = Auth::user()->pais;
        $orders = Orden::where('user_id',Auth::id())->get();
        
       if(count($orders) < 1){
            $array = array();
        }
        else{
            
        foreach($orders as $order){
            $array[] = $order->productoOrden()->get();
            }
        }
        
        return view('order', ['orders' => $orders, 'productos' => $array, 'pais' => $pais]);
        
    }
    
    /**
     * Función que permite generar una nueva Orden en el sistema para cualquier Usuario
     */
    public function createOrder(){
        
        $pais = Auth::user()->pais;
        //Primero se crea y se le asigna los datos a la orden
        $orden = new Orden;
        
        $direccion = request('direccionEnvio');
        $fecha = request('fecha');
        $montoTotal = request('montoTotal');
        $tipoPago = request('tipoPago');
        if($tipoPago == 'paypal'){
            $numeroTarjeta = 'paypal';
        }
        else{
            $numeroTarjeta = request('numeroTarjeta');
        }
        $usuarioId = Auth::id();
        
        $orden->direccion = $direccion;
        $orden->fecha = $fecha;
        $orden->montoTotal = $montoTotal;
        $orden->numeroTarjeta = $numeroTarjeta;
        $orden->tipoPago = $tipoPago;
        $orden->user_id = $usuarioId;
        
        $orden->save();
        
        //Luego se deben de guardar los productos de la orden
        
        $carrito = Carrito::where('user_id', Auth::id())->first();
        $productos = $carrito->productos()->get();
        
        foreach($productos as $producto){
            $orden->productoOrden()->attach($producto->id);
            $orden->save();
        }
        
        // Por ultimo se vacia el carrito
        foreach($productos as $producto){
            $carrito->productos()->detach($producto->id);
            $carrito->save();
        }
        
         $orders = Orden::where('user_id',Auth::id())->get();
        
       if(count($orders) < 1){
            $array = array();
        }
        else{
            
        foreach($orders as $order){
            $array[] = $order->productoOrden()->get();
            }
        }

        
        return view('order',['orders' => $orders, 'productos' => $array, 'pais' => $pais]);
        
        
        
    }
    
    /**
     * Función que permite cancelar una Orden del Usuario
     */ 
    public function cancelOrder(){
        
        $idOrden = request('idOrden');
        $orden = Orden::find($idOrden)->delete();
        $orders = Orden::where('user_id', Auth::id())->get();
        $pais = Auth::user()->pais;
        
        if(count($orders) < 1){
            $array = array();
        }
        else{
            
        foreach($orders as $order){
            $array[] = $order->productoOrden()->get();
            }
        }
        
        return view('order', ['orders' => $orders , 'productos' => $array , 'pais' => $pais]);
        
        
    }
    
    
    
}
