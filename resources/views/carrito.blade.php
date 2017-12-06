@extends('master')
@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Carro de Compras
	@else
	Shopping Cart
	@endif
@endsection

@section('assets')
	
	<link rel="stylesheet" href="/css/carrito.css" media="all"> 
	
@endsection

@section('contenido')
@if($pais === 'VE' || $pais === 'CO')
<h1>Carro de Compras</h1>
@else
<h1>Shopping Cart</h1>

@endif
<hr>
<div class="card" style="">
<div class="container">
	<table id="cart" class="table table-hover table-condensed">

    			<thead>
						<tr>
							@if($pais === 'VE' || $pais === 'CO')
							<th style="width:60%" class="">Producto</th>
							<th style="width:20%" class="">Precio</th>
							<th style="width:20%" class="text-center center-text">Acciones</th>
							@else
							<th style="width:60%" class="">Product</th>
							<th style="width:20%" class="">Price</th>
							<th style="width:20%" class="text-center center-text">Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@php ($total=0)
						<?php
        				foreach($productos as $producto){
    					?>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><img src="<?php echo $producto->link ?>" alt="..." class="img-responsive" width="100px" height="100px"/></div>
									<div class="col-sm-9">
										<h4 class="nomargin"> <?php echo $producto->nombre ?></h4>
									
										<p><?php echo $producto->descripcion ?></p>
									</div>
								</div>
							</td>
							
							@if($pais === 'VE')
							<td data-th="Price"> <?php echo $producto->precio*81000 ?> BsF</td>
							@elseif($pais === 'CO')
							<td data-th="Price"> <?php echo $producto->precio*3000 ?> COP</td>
							@elseif($pais === 'UK')
							<td data-th="Price"> <?php echo $producto->precio*0.75 ?> £</td>
							@else
							<td data-th="Price"> <?php echo $producto->precio ?> $</td>
							@endif
							
							<form action="/removeProduct" method="POST">
								{{ csrf_field()}}
								<input type="hidden" name="idProducto" value="<?php echo $producto->id ?>" >
								<td class="actions text-center center-text"  data-th="">
									<button id="delete<?php echo $producto->id ?>" class="btn " style="background-color: #f44336;color:white; width:50%"type="submit"><i class="material-icons">delete</i></button>
									@if($pais === 'VE' || $pais === 'CO')
									<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="delete<?php echo $producto->id ?>">
										Borrar
									</div>
									@else
									<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="delete<?php echo $producto->id ?>">
										Delete
									</div>
									@endif
								</td>
							</form>
						</tr>
						@php ($total = $total + $producto->precio)
						<?php
        			}
        			?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="" class="">
								<form action="/emptyCart" method="POST">
								{{ csrf_field()}}
								@if( $total == 0)
								
									@if($pais === 'VE' || $pais === 'CO')
									<button disabled id="empty" class="btn " style="background-color: #d50000;color:white; width:30%" type="submit">Vaciar </button>
									@else
									<button disabled id="empty" class="btn " style="background-color: #d50000;color:white; width:30%" type="submit">Empty </button>
									@endif
								
								@else
									@if($pais==='VE' || $pais ==='CO')
									<button id="empty" class="btn " style="background-color: #d50000;color:white; width:30%" type="submit">Vaciar </button>
									@else 
									<button id="empty" class="btn " style="background-color: #d50000;color:white; width:30%" type="submit">Empty </button>
									@endif
								@endif
								
								@if($pais === 'VE' || $pais === 'CO')
								<div class="mdl-tooltip mdl-tooltip--bottom" data-mdl-for="empty">
										Vaciar Carrito
									</div>
								@else 
								<div class="mdl-tooltip mdl-tooltip--bottom" data-mdl-for="empty">
										Empty Cart
									</div>
								@endif
									
									
								</form>
							</td>
							@if($pais === 'VE')
							<td class=""><strong> Total</strong> <?php echo $total*81000 ?>.00 BsF</td>
							@elseif($pais==='CO')
							<td class=""><strong> Total</strong> <?php echo $total*3000 ?>.00 COP</td>
							@elseif($pais==='UK')
							<td class=""><strong> Total</strong> <?php echo $total*0.75 ?> £</td>
							@else
							<td class=""><strong> Total</strong> <?php echo $total ?>.00 $</td>
							@endif
							
							<td>
								@if( $total == 0)
								<button disabled onclick="getFecha()"id="show-dialog-pago" class="btn " style="background-color: #00c853;color:white; width:100%" type="button">Checkout > </button>
								@else
								<button onclick="getFecha()"id="show-dialog-pago" class="btn " style="background-color: #00c853;color:white; width:100%" type="button">Checkout > </button>
								@endif
							</td>
						</tr>
					</tfoot>
				</table>
				<script>
					function getFecha(){
						let n =  new Date();
						let y = n.getFullYear();
						let m = n.getMonth() + 1;
						let d = n.getDate();
						document.getElementById("fecha").value = m + "/" + d + "/" + y;
					}
				</script>
				<dialog class="mdl-dialog dialog-pago">
						@if($pais==='VE' || $pais ==='CO')
					    <h4 class="mdl-dialog__title">Sesión de Pago</h4>
					    @else 
					    <h4 class="mdl-dialog__title">Payment Session</h4>
					    @endif
					    
					    <div class="mdl-dialog__content">
					      <form id="pagar" action="/newOrder" method="POST">
					      	{{ csrf_field()}}
					      	<div class="row">
					      		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
								    <input class="mdl-textfield__input" type="text" id="direccionEnvio" name="direccionEnvio">
								    @if($pais === 'VE' || $pais ==='CO')
								    <label class="mdl-textfield__label" for="direccionEnvio">Dirección de Envío</label>
								    @else 
								    <label class="mdl-textfield__label" for="direccionEnvio">Shipping Address</label>
								    @endif
								</div>
					      	</div>
					      	<div class="row">
								<div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="numeroTarjeta" name="numeroTarjeta" maxlength="16" minlength="16" data-inputmask="'mask': '9999 9999 9999 9999'">
								    @if($pais === 'VE' || $pais === 'CO')
								    <label class="mdl-textfield__label" for="numeroTarjeta">Número de Tarjeta</label>
								    <span class="mdl-textfield__error">Ingresa solo números, deben ser 16 digitos</span>
								    @else
								    <label class="mdl-textfield__label" for="numeroTarjeta">Card Number</label>
								    <span class="mdl-textfield__error">Type only numbers, length must be of 16 digits</span>
								    @endif
								</div>
								<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								    <input class="mdl-textfield__input" type="password" pattern="-?[0-9]*(\.[0-9]+)?" id="cvc" name="cvc" maxlength="3" minlength="3">
								    <label class="mdl-textfield__label" for="cvc">CVC</label>
								    @if($pais === 'VE' || $pais ==='CO')
								    <span class="mdl-textfield__error">Ingresa el CVC, debe ser de 3 digitos</span>
								    @else
								    <span class="mdl-textfield__error">Type the CVC, length must be of 3 digits</span>
								    @endif
								</div>
								<div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1 ">
								</div>
								
					
								<div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 drop-bottom" required>
								    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1" id="checkdebito">
									  <input type="radio" id="option-1" class="mdl-radio__button" name="tipoPago" value="debito">
									  @if($pais === 'VE' || $pais ==='CO')
									  <span class="mdl-radio__label">Débito           <i class="fa fa-credit-card" style="font-size:24px">      <i class="fa fa-google-wallet" style="font-size:24px"></i></i></span>
									  @else 
									  <span class="mdl-radio__label">Debit           <i class="fa fa-credit-card" style="font-size:24px">      <i class="fa fa-google-wallet" style="font-size:24px"></i></i></span>
									  @endif
									</label>
									<br>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2" id="checkcredito">
									  <input type="radio" id="option-2" class="mdl-radio__button" name="tipoPago" value="credito">
									  @if($pais === 'VE' || $pais === 'CO')
									  <span class="mdl-radio__label">Crédito <i class="fa fa-cc-visa" style="font-size:24px"></i>      <i class="fa fa-cc-mastercard" style="font-size:24px"></i>      <i class="fa fa-cc-amex" style="font-size:24px"></i></span>
									  @else
									  <span class="mdl-radio__label">Credit <i class="fa fa-cc-visa" style="font-size:24px"></i>      <i class="fa fa-cc-mastercard" style="font-size:24px"></i>      <i class="fa fa-cc-amex" style="font-size:24px"></i></span>
									  @endif
									</label>
									<br>
									<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect"  for="option-3" id="paypal">
									  <input type="radio" id="option-3" class="mdl-radio__button" name="tipoPago" value="paypal">
									  <span class="mdl-radio__label">Paypal   <i class="fa fa-cc-paypal" style="font-size:24px"></i></span>
									</label>
								</div>
					      	</div>
					      	<div class="row">
					      		@if($pais === 'VE')
					      		<h4>Monto Total:  <?php echo $total*81000 ?>.00 BsF</h4>
					      		@elseif($pais === 'CO')
					      		<h4>Monto Total:  <?php echo $total*3000 ?>.00 COP</h4>
					      		@elseif($pais === 'UK')
					      		<h4>Total Payment:  <?php echo $total*0.75 ?> £</h4>
					      		@else 
					      		<h4>Total Payment:  <?php echo $total ?> $</h4>
					      		@endif
					      		
					      		<input type="hidden" name="montoTotal" value="<?php echo $total ?>" >
					      		<input id="fecha" type="hidden" name="fecha" value="">
					      	</div>
					      	
					      </form>
					    </div>
					    <div class="mdl-dialog__actions">
					    	@if($pais === 'VE' || $pais === 'CO')
					      <button id="show-dialog-pago" class="btn " style="background-color: #00c853;color:white; width:100%" onclick="checkForm()">PAGAR</button>
					      	@else 
					 	  <button id="show-dialog-pago" class="btn " style="background-color: #00c853;color:white; width:100%" onclick="checkForm()">PAY</button>
					      	@endif 
					      <br>
					      <br>
					      <br>
					      @if($pais ==='VE' || $pais === 'CO')
					      <button type="button" class="mdl-button close" >Cancelar</button>
					      @else 
					      <button type="button" class="mdl-button close" >Cancel</button>
					      @endif
					    </div>
					  </dialog>
					  <script>
					  function checkForm(){
					  	
					  		var direccion = document.getElementById("direccionEnvio").value;
					  		var tarjeta = document.getElementById("numeroTarjeta").value;
					  		var cvc = document.getElementById("cvc").value;
					  		var tipo = $('input[type=radio][name=tipoPago]:checked').val();
					  		
					  		
					  		if(tipo == "paypal"){
					  			if(direccion == ""){
					  				alert('Remember to fill all inputs to pay');
					  			}
					  			else{
					  				document.getElementById("pagar").submit();
					  			}
					  		}
					  		else if(tipo == "credito") {
					  			if(direccion == "" || tarjeta == "" || cvc == ""){
					  				alert('Remember to fill all inputs to pay');
					  			}
					  			else{
					  				document.getElementById("pagar").submit();
					  			}
					  		}
					  		else if(tipo =="debito") {
					  			if(direccion == "" || tarjeta == ""){
					  				alert('Remember to fill all inputs to pay');
					  			}
					  			else{
					  				document.getElementById("pagar").submit();
					  			}
					  		}
					  		else{
					  			alert('Remember to fill all inputs to pay');
					  		}
					  	
					  	}
					    var dialogPago = document.querySelector('.dialog-pago');
					    var botonPago = document.querySelector('#show-dialog-pago');
					    if (! dialogPago.showModal) {
					      dialogPolyfill.registerDialog(dialogPago);
					    }
					    botonPago.addEventListener('click', function() {
					      dialogPago.showModal();
					    });
					    dialogPago.querySelector('.close').addEventListener('click', function() {
					      dialogPago.close();
					    });
					    
					    $('#checkcredito').click(function(){
					    	$('#cvc').prop('disabled', false);
					    	$('#numeroTarjeta').prop('disabled', false);
					   });
					   $('#checkdebito').click(function(){
					    	$('#cvc').prop('disabled', true);
					    	$('#numeroTarjeta').prop('disabled', false);
					   });
					   $('#paypal').click(function(){
					    	$('#cvc').prop('disabled', true);
					    	$('#numeroTarjeta').prop('disabled', true);  
					   });
					    
					  </script>
				</div>
				</div>
				
				
		
@endsection

@section('vista')
<input type="hidden" value="carrito" name="pais" />
@endsection