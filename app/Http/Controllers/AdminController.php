<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orden;
use App\Producto;
use App\Carrito;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Controlador Admin encargado de las funcionalidades de la vista Admin
 */
class AdminController extends Controller
{
    /**
     * Función que crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Función que se encarga de mandar los Productos, Usuarios y Ordenes de cada uno de ellos a la vista Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();
        if($user == null){
            $pais = null;
        }
        else{
        $pais = $user->pais;
        }
        
        $usuarios = DB::table('users')->get();
        $ordenes = DB::table('ordens')->get();
        
        $productos = DB::table('productos')->get();
        return view('admin',['pais' => $pais,'productos' => $productos,'usuarios' => $usuarios,'ordenes' => $ordenes]);
        
    }
    
    /**
     * Función que le permite al Admin agregar un nuevo Producto a la base de datos.
     */
    function addAdminProduct()
    {
        
        
        $user = Auth::user();
        if($user == null){
            $pais = null;
        }
        else{
        $pais = $user->pais;
        }
        
        $nombre = request('nombreP');
        $descripcion = request('descripcionP');
        $precio = request('precioP');
        $categoria = request('categoriaP');
        $link = request('linkP');
        
        dump($nombre);
        dump($descripcion);
        dump($precio);
        dump($categoria);
        $nuevoProducto = new Producto;
        $nuevoProducto->timestamps = false;
        $nuevoProducto->nombre = $nombre;
        $nuevoProducto->precio = $precio;
        $nuevoProducto->descripcion = $descripcion;
        $nuevoProducto->link = $link;
        $nuevoProducto->categoria = $categoria;
        
        
        $nuevoProducto->save();
        
        $productos = DB::table('productos')->get();
        $usuarios = DB::table('users')->get();
        $ordenes = DB::table('ordens')->get();
        
        return view('admin',['ordenes' => $ordenes,'usuarios' => $usuarios,'pais' => $pais,'productos' => $productos]);
        
        
    }
    
    /**
     * Función que le permite al Admin eliminar un Producto de su preferencia de la base de datos
     */
    public function eliminarProduct(){
        
        $idProducto = request('borrarP');
        $producto = Producto::find($idProducto)->delete();
        $pais = Auth::user()->pais;
        $productos = DB::table('productos')->get();
        
        
       $usuarios = DB::table('users')->get();
        $ordenes = DB::table('ordens')->get();
        
        return view('admin',['ordenes' => $ordenes,'usuarios' => $usuarios,'pais' => $pais,'productos' => $productos]);
    }
    
    
    /**
     * Función que le permite al Admin cambiar el precio de un Producto de su preferencia de la base de datos
     */
    public function updateProduct(){
        
        $idProducto = request('gestionarP');
        $producto = Producto::find($idProducto);
        $precioNuevo = request('precioN');
        $producto->precio = $precioNuevo;
        $producto->timestamps = false;
        $producto->save();
        $pais = Auth::user()->pais;
        $productos = DB::table('productos')->get();
        
        return view('admin',['pais' => $pais,'productos' => $productos]);
    }
    
    
    /**
     * Función que le permite al Admin eliminar una Orden de cualquier Usuario de su preferencia
     */ 
    public function cancelOrder(){
        
        $idOrden = request('idOrden');
        $orden = Orden::find($idOrden)->delete();
        $pais = Auth::user()->pais;
        
        $ordenes = DB::table('ordens')->get();
        $usuarios = DB::table('users')->get();
        $productos = DB::table('productos')->get();
        
        return view('admin', ['pais' => $pais, 'usuarios' => $usuarios , 'productos' =>$productos , 'ordenes' => $ordenes]);
        
    }
    
}