<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Carrito;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Controlador Carrito o ShoppingCart que se encarga de las funcionalidades de la vista Carrito
 */
class ShoppingCartController extends Controller
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
     * Función que se encarga de mandar todos los Productos del Carrito al que el Usuario le fue asignado
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pais = Auth::user()->pais;
        $idUsuario = Auth::id();
        $carrito = Carrito::where('user_id',$idUsuario)->first();
        // Hay que devolver los productos que hay en el carrito
        
        $productos = $carrito->productos()->get();
        return view('carrito',['productos' => $productos,'pais' => $pais]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Función que agrega un Producto al Carrito del Usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Funcion donde se agrega un producto a el carrito
        
        $pais = Auth::user()->pais;
        $idProducto = request(['idProducto']);
        
        $producto = Producto::find($idProducto);
        $idUsuario = Auth::id();
        
        
        $carrito = Carrito::where('user_id',$idUsuario)->first();
        
        $carrito->productos()->attach($idProducto);
        
        $carrito->save();
       
        $wishlists = Wishlist::where('user_id',$idUsuario)->get();
        $productos = DB::table('productos')->get();
        
        return view('producto',['productos' => $productos,'wishlists' => $wishlists,'pais'=>$pais]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Función que elimina un Producto del Carrito del Usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //Funcion donde se elimina un producto del carrito
        
        $pais = Auth::user()->pais;
        $idProducto = request(['idProducto']);
        
        $producto = Producto::find($idProducto);
        $idUsuario = Auth::id();
        
        
        $carrito = Carrito::where('user_id',$idUsuario)->first();
        
        DB::table('carrito_producto')
        ->where('producto_id','=', $idProducto)
        ->where('carrito_id', '=', $carrito->id)->limit(1)->delete();

        // $carrito->productos()->detach($idProducto);
        
        // $carrito->save();
       
        $productos = $carrito->productos()->get();
        return view('carrito',['productos' => $productos,'pais'=>$pais]);
        
    }
    
    /**
     * Función que permite vaciar el Carrito del Usuario
     */
    public function emptyCart() {
     
     $pais = Auth::user()->pais;
     $usuarioId = Auth::id();
     $carrito = Carrito::where('user_id',$usuarioId)->first();
     
     $productos = $carrito->productos()->get();
     
     foreach($productos as $producto){
         $carrito->productos()->detach($producto->id);
         $carrito->save();
     }
     
     return view ('carrito',['productos' => $carrito->productos()->get(),'pais' => $pais]);
        
    }
}
