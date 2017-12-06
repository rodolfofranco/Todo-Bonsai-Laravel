<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Carrito;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Controlador Wishlist que se encarga de las funcionalidades de la vista Wishlist
 */
class WishlistController extends Controller
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
     * Función que manda todas las Wishlists con sus Productos del Usuario a la vista Wishlist
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pais = Auth::user()->pais;
        $idUsuario = Auth::id();
        $wishlist = Wishlist::where('user_id',$idUsuario)->get();
        
        if(count($wishlist) < 1){
            $array = array();
        }
        else{
            
        foreach($wishlist as $wish){
            $array[] = $wish->productoWishlist()->get();
            }
        }
        
        
       
        return view('wishlist',['wishlists' => $wishlist, 'productos' => $array , 'pais' => $pais]);
    }
    
    
     /**
     * Función que le permite al Usuario crear una nueva Wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pais = Auth::user()->pais;
        //Funcion donde se crea un nuevo wishlist
        $nombreWishlist = request('nombre');

        $idUsuario = Auth::id();
    
        $wishlist = new Wishlist;
        
        
        $wishlist->nombre = $nombreWishlist;
        $wishlist->user_id = $idUsuario;
        
        $wishlist->save();
        
        
        $idUsuario = Auth::id();
        $wishlists = Wishlist::where('user_id',$idUsuario)->get();
        
        if(count($wishlists) < 1){
            $array = array();
        }
        else{
            
        foreach($wishlists as $wish){
            $array[] = $wish->productoWishlist()->get();
            }
        }
       
        
        return view('wishlist',['wishlists' => $wishlists, 'productos' => $array, 'pais' => $pais]);
        
        
    }
    
    /**
     * Función que permite agregar un Producto a la Wishlist deseada
     */
    public function addProduct(){
        
        $pais = Auth::user()->pais;
        $idWishlist = request('wishlist');
        $idProducto = request('idProducto');
       
        $wishlist = Wishlist::where('id',$idWishlist)->first();
        
        $wishlist->productoWishlist()->attach($idProducto);
        
        $wishlist->save();
       
        $productos = DB::table('productos')->get();
        
        $wishlistsUser = Wishlist::where('user_id',Auth::id())->get();
        
        return view('producto',['productos' => $productos,
        'wishlists' => $wishlistsUser,
        'pais' => $pais]);

    }
    
    /**
     * Función que permite borrar una Wishlist del sistema
     */
    public function deleteWishlist(){
        
        //Funcion que se encarga de eliminar una wishlist
        $pais = Auth::user()->pais;
        $idWishlist = request('idWishlist');
        
        $wishlist = Wishlist::find($idWishlist);
        
        $wishlist->delete();
        
        $idUsuario = Auth::id();
        $wishlists = Wishlist::where('user_id',$idUsuario)->get();
        
        if(count($wishlists) < 1){
            $array = array();
        }
        else{
            
        foreach($wishlists as $wish){
            $array[] = $wish->productoWishlist()->get();
            }
        }
        
        
        
        return view ('wishlist',['wishlists' => $wishlists, 'productos' => $array, 'pais' => $pais]);
    }
    
    /**
     * Función que permite agregar todos los Productos de una Wishlist al Carrito
     */
    public function agregarCarrito(){
        //Funcion que agrega los productos de una wishlist a un carrito
        $pais = Auth::user()->pais;
        $idWishlist = request('idWishlist');
        $wishlist = Wishlist::find($idWishlist);
        
        $productos = $wishlist->productoWishlist()->get();
        
        $carrito = Carrito::where('user_id',Auth::id())->first();
        
        foreach($productos as $producto){
            $carrito->productos()->attach($producto->id);
            $carrito->save();
        }
        
        return view('carrito',['productos' => $carrito->productos()->get(), 'pais' => $pais]);
        
        
    }
    
     /**
     * Función que elimina un Producto de la Wishlist del Usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Funcion donde se elimina un producto de la wishlist
        
        $pais = Auth::user()->pais;
        $idProducto = request(['idProducto']); 
        
        $producto = Producto::find($idProducto);
        $idUsuario = Auth::id();
        
        
       $wishlist = request('idWishlist');
        
        DB::table('producto_wishlist')
        ->where('producto_id','=', $idProducto)
        ->where('wishlist_id', '=', $wishlist)->limit(1)->delete();

        $idUsuario = Auth::id();
        $wishlists = Wishlist::where('user_id',$idUsuario)->get();
        
        if(count($wishlists) < 1){
            $array = array();
        }
        else{
            
        foreach($wishlists as $wish){
            $array[] = $wish->productoWishlist()->get();
            }
        }
        return view('wishlist',['pais'=>$pais,'wishlists' => $wishlists, 'productos' => $array]);
        
    }
}
