@extends('master')

@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Productos
	@else
	Ord
	@endif
@endsection

@section('assets')

    <link rel="stylesheet" href="/css/product.css" media="all">

@endsection

@section('contenido')

@if($pais === 'US' || $pais==='UK')
<h1 style="font-family: Raleway; text-align:center">Bonsai Products</h1>
@elseif($pais ==='VE' || $pais==='CO')
<h1 style="font-family: Raleway; text-align:center">Productos Bonsai</h1>
@else
<h1 style="font-family: Raleway; text-align:center;background-color:#E3EEFB">Productos Bonsai</h1>
@endif
<hr>
 
  
  <div class="row text-center" style="padding-left:100px; padding-top:50px; padding-bottom: 50px" id="allproducts">
      
    <?php
        foreach($productos as $producto){
    ?>    
    
    
    
            <div id="<?php echo $producto->id ?>" class="col-lg-4 col-md-6 mb-4 epale" style="heigth:200px">
              <div  class="filterDiv <?php echo $producto->categoria ?>">
              
                <a href="javascript:void(0)" class="show-modal<?php echo $producto->id ?>">
              
              <img class="card-img-top img-fluid " style="background-position:center center; background-size:cover;" src="<?php echo $producto->link ?>" alt="">
             
              <div class="descripcionProducto">
                <a href="javascript:void(0)" class="show-modal<?php echo $producto->id ?>">
                  <h4 class="producto text<?php echo $producto->id ?>"><?php echo $producto->nombre ?></h4>
                  @if($pais === 'VE')
                  <h6 class="producto price<?php echo $producto->id ?>"><?php echo $producto->precio*81000 ?> BsF.</h6>
                  @elseif($pais === 'CO')
                  <h6 class="producto price<?php echo $producto->id ?>"><?php echo $producto->precio*3000 ?> COP.</h6>
                  @elseif($pais ==='UK')
                  <h6 class="producto price<?php echo $producto->id ?>"><?php echo $producto->precio*0.75 ?> £.</h6>
                  @elseif($pais === 'US')
                  <h6 class="producto price<?php echo $producto->id ?>"><?php echo $producto->precio ?> $.</h6>
                  @else
                  <h6 class="producto price<?php echo $producto->id ?>"><?php echo $producto->precio ?> $.</h6>
                  @endif
                </a>
              </div>
              
              <hr>
              <br>
              <br>
              
              
              
              <dialog class="mdl-dialog show-dialog<?php echo $producto->id ?>">
                  <div class="mdl-dialog__content">
                     
                      <div class="row">
                      
                      <section class="foto col-lg-6 col-md-6">
                        <img class="img-fluid" src="<?php echo $producto->link ?>" alt="">  
                      </section>
                      
                      <section class="col-lg-6 col-md-6 mb-12">
                        <h4 class="producto text-center center-text"><?php echo $producto->nombre ?></h4>
                        
                        @if($pais === 'VE')
                        <h6 class="producto text-center center-text">Precio: <?php echo $producto->precio*81000 ?> BsF</h6>
                        @elseif($pais ==='CO')
                        <h6 class="producto text-center center-text">Precio: <?php echo $producto->precio*3000 ?> COP</h6>
                        @elseif($pais === 'UK')
                        <h6 class="producto text-center center-text">Precio: <?php echo $producto->precio*0.75 ?> £</h6>
                        @elseif($pais === 'US')
                        <h6 class="producto text-center center-text">Precio: <?php echo $producto->precio ?> $</h6>
                        @else
                        <h6 class="producto text-center center-text">Precio: <?php echo $producto->precio ?> $</h6>
                        @endif
                        
                        <h6 class="producto text-center center-text">Descripcion: <?php echo $producto->descripcion ?></h6>
                      
                        <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
                          
                          
                         
                          
                        
                            <hr style="height:10px">
                            @auth
                            <form style="width:100%" class="text-center center-text" action="/addProduct" method="POST">
                                
                            {{ csrf_field()}}
                            
                            <input type="hidden" name="idProducto" value="<?php echo $producto->id ?>" >
             
                            @if($pais==='VE' || $pais === 'CO')
                            <button style="width:100%; background-color:#f44336; color:white; font-weight:bold" type="submit" class="mdl-button text-center center-text">Agregar al Carro de Compras<i class="material-icons">add_shopping_cart</i></button>
                            @elseif($pais === 'US' || $pais === 'UK')
                            <button style="width:100%; background-color:#f44336; color:white; font-weight:bold" type="submit" class="mdl-button text-center center-text">Add to Shopping Cart<i class="material-icons">add_shopping_cart</i></button>
                            @else
                            <button style="width:100%; background-color:#f44336; color:white; font-weight:bold" type="submit" class="mdl-button text-center center-text">Agregar al Carro de Compras<i class="material-icons">add_shopping_cart</i></button>
                            @endif
                            </form>
                            
                            <form style="width:100%" class="text-center center-text" action="/wishlistProducto" method="POST">
                              
                              {{ csrf_field()}}
                            
                            <input type="hidden" name="idProducto" value="<?php echo $producto->id ?>" >
                              
                              <select name="wishlist" class="form-control" id="wl">
                                <option value="" disabled selected> Selecciona una wishlist</option>
                                <?php
                              foreach($wishlists as $wishlist){
                                ?> 
                                
                                <option value="<?php echo $wishlist->id ?>" > <?php echo $wishlist->nombre ?> </option>
                                
                                <?php
                                }
                                ?>
                              </select>
                              
                              @if ($pais === 'VE' || $pais === 'CO')
                              <button style="width:100% ; background-color:#E0E3E8" type="submit" class="mdl-button text-center center-text"> Agregar a la wishlist <i class="material-icons">list</i></button>
                              @elseif ($pais === 'US' || $pais === 'UK')
                              <button style="width:100% ; background-color:#E0E3E8" type="submit" class="mdl-button text-center center-text"> Add to wishlist <i class="material-icons">list</i></button>
                              @else 
                              <button style="width:100% ; background-color:#E0E3E8" type="submit" class="mdl-button text-center center-text"> Agregar a la wishlist <i class="material-icons">list</i></button>
                              @endif
                            </form>
                            
                            <form style="width:100%" class="text-center center-text" action="" method="">
                              @if ($pais === 'VE' || $pais === 'CO')
                              <button style="width:100%; background-color:#E0E3E8" type="button" class="mdl-button text-center center-text close<?php echo $producto->id ?>">Cerrar <i class="material-icons">close</i></button>
                              @elseif ($pais === 'US' || $pais === 'UK')
                              <button style="width:100%; background-color:#E0E3E8" type="button" class="mdl-button text-center center-text close<?php echo $producto->id ?>">Close <i class="material-icons">close</i></button>
                              @else 
                              <button style="width:100%; background-color:#E0E3E8" type="button" class="mdl-button text-center center-text close<?php echo $producto->id ?>">Cerrar <i class="material-icons">close</i></button>
                              @endif
                            </form>
                            @else
                            <form style="width:100%" class="text-center center-text" action="" method="">
                              <button style="width:100%; background-color:#E0E3E8" type="button" class="mdl-button text-center center-text close<?php echo $producto->id ?>">Cerrar <i class="material-icons">close</i></button>
                            </form>
                            @endauth
                        
                        </div>
                      </section>
                      </div>
                    
                  </div>
                </dialog>
                
              
              <script>
                // SE CREA LA VARIABLE DIALOG PARA TODAS LAS VECES QUE A APAREZCA LA CLASE SHOWDIALOG((product.id))//
                var dialog<?php echo $producto->id ?> = document.querySelector('.show-dialog<?php echo $producto->id ?>');
                // SE CREA LA VARIAVLE DE BOTON DE MODAL PARA TODAS LAS CLASES SHOWMODAL PARA CUANDO SE HAGA CLICK EN LA IMAGEN
                var showModalButton<?php echo $producto->id ?> = document.querySelector('.show-modal<?php echo $producto->id ?>'); 
                // SE CREA LA VARIABLE DE BOTON DE MODAL PARA TODAS LAS CLASES TEXT PARA CUANDO SE HAGA CLICK EN EL NOMBRE DEL PRODUCTO
                var showTextButton<?php echo $producto->id ?> = document.querySelector('.text<?php echo $producto->id ?>');
                // SE CREA LA VARIABLE DE BOTON DE MODEL PARA TODAS LAS CLASES PRICE PARA CUANDO SE HAGA CLICK EN EL PRECIO DEL PRODUCTO
                var showPriceButton<?php echo $producto->id ?> = document.querySelector('.price<?php echo $producto->id ?>');
                
                if (!dialog<?php echo $producto->id ?>.showModal){
                  dialogPolyfill.registerDialog(dialog<?php echo $producto->id ?>);
                }
                // FUNCION PARA CUANDO SE HAGA CLICK EN LA IMAGEN
                showModalButton<?php echo $producto->id ?>.addEventListener('click', function() {
                  dialog<?php echo $producto->id ?>.showModal();
                });
                // FUNCION PARA CUANDO SE HAGA CLICK EN EL NOMBRE
                showTextButton<?php echo $producto->id ?>.addEventListener('click', function() {
                  dialog<?php echo $producto->id ?>.showModal();
                });
                // FUNCION PARA CUANDO SE HAGA CLICK EN EL PRECIO
                showPriceButton<?php echo $producto->id ?>.addEventListener('click', function() {
                  dialog<?php echo $producto->id ?>.showModal();
                });
                // FUNCION PARA CERRAR EL DIALOG
                dialog<?php echo $producto->id ?>.querySelector('.close<?php echo $producto->id ?>').addEventListener('click', function() {
                  dialog<?php echo $producto->id ?>.close();
                });
              </script> 
            </a>
              </div>
            </div>
        
      
        <?php
        }
        ?>


    


@endsection

@section('vista')
<input type="hidden" value="producto" name="pais" />
@endsection