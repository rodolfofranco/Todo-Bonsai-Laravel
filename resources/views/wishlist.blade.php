@extends('master')
@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Lista de Deseos
	@else
	Wishlist
	@endif
@endsection

@section('contenido')

@if($pais === 'US' || $pais ==='UK')
<h1>Wishlist</h1>
@else
<h1>Lista de Deseos</h1>
@endif

			<form style="width:50% ; margin: auto; padding: 10px" class="text-center center-text" action="/addWishlist" method="POST">
            
            					<input type="text" class="form-control" name="nombre"/>
            					{{ csrf_field()}}
            					<br>
            					@if($pais === 'VE' || $pais === 'CO')
                              	<button style="width:100%; background-color:#00c853" type="submit" class="mdl-button text-center center-text"> Crear Wishlist <i class="material-icons">list</i></button>
                              	@else 
                              	<button style="width:100%; background-color:#00c853" type="submit" class="mdl-button text-center center-text"> Create Wishlist <i class="material-icons">list</i></button>
                              	@endif
                     
            </form>
            
            <br>
            <br>
   
       
	<div class="card" style="">
<div class="container">
	<table id="cart" class="table table-hover table-condensed">
    		<thead>
						<tr>
							@if($pais === 'VE' || $pais === 'CO')
							<th style="width:30%" class="">Lista</th>
							<th style="width:50%" class="">Productos</th>
							<th style="width:20%" class="text-center center-text">Acciones</th>
							@else
							<th style="width:30%" class="">List</th>
							<th style="width:50%" class="">Products</th>
							<th style="width:20%" class="text-center center-text">Actions</th>
							@endif
						</tr>
			</thead>
			
					<tbody>
			
							
    						 @foreach($wishlists as $key=>$wishlist)
   							 
			
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><h5 class="nomargin"> {{$wishlist->nombre}} </h5>	</div>
									
										
								</div>
									
							
							</td>
							
							<td> 
							<div class="collapse" id="collapseExample{{$key+1}}">
												
									 				@foreach($productos as $key1=>$producto)
									 				@foreach($producto as $key2=>$product)
												
													@if($key === $key1)
												   	<div class="row" style="padding-top:15px">
													<div class="col-sm-3 hidden-xs">
														<img src="{{$product->link}}" alt="..." class="img-responsive" width="50px" height="50px"/>
													</div>
													<div class="col-sm-9">
														<h6 class="nomargin"> {{$product->nombre}}<p>{{$product->descripcion}}
													
														@if($pais ==='VE')
														<h5> {{ $product->precio*81000 }} BsF</h5>
														@elseif($pais ==='CO')
														<h5> {{ $product->precio*3000 }} COP</h5>
														@elseif($pais==='UK')
														<h5> {{ $product->precio*0.75 }} £</h5>
														@else 
														<h5> {{ $product->precio }} $</h5>
														@endif
				
														</p></h6>
														
														<div class="col-sm-9">
															<form action="/deleteProductW" method="POST" >
															{{ csrf_field()}}
															<button class="btn btn-danger" id="deleteP{{$key2+1}}" type="submit">
																	  <i class="material-icons">cancel</i>
															</button>
															<input type="hidden" name="idWishlist" value="{{$wishlist->id}}"/>
															<input type="hidden" name="idProducto" value="{{$product->id}}"/>
															</form>
																@if($pais==='VE' || $pais ==='CO')
															<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="deleteP{{$key2+1}}">
																	Borrar Producto
															</div>
															@else 
															<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="deleteP{{$key2+1}}">
																	Delete Product
															</div>
															@endif
															<br>
															
														</div>
													
													</div>
													
													</div>
													@endif
													
																										
													@endforeach
													@endforeach
											</div>
							</td>
							
								
								
							

							
							<td data-th="Acciones">
								<button class="btn" id="botonWishlist{{$key+1}}" type="button" data-toggle="collapse" data-target="#collapseExample{{$key+1}}" aria-expanded="false" aria-controls="collapseExample">
										  <i class="material-icons">list</i>
								</button>
								@if($pais ==='VE' || $pais === 'CO')
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonWishlist{{$key+1}}">
										Ver Lista
								</div>
								@else
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonWishlist{{$key+1}}">
										View List
								</div>
								@endif
								<br>
								<br>
								<form action="/deleteWishlist" method="POST" >
								{{ csrf_field()}}
								<button class="btn btn-danger" id="delete{{$key+1}}" type="submit">
										  <i class="material-icons">cancel</i>
								</button>
								<input type="hidden" name="idWishlist" value="<?php echo $wishlist->id?>"/>
								</form>
								
								@if($pais==='VE' || $pais ==='CO')
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="delete{{$key+1}}">
										Borrar Lista
								</div>
								@else 
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="delete{{$key+1}}">
										Delete List
								</div>
								@endif
								<br>
							
								<form action="/wishlistCarrito" method="POST" >
								{{ csrf_field()}}
								<button class="btn btn-default" style="background-color: #00c853 " id="add{{$key+1}}" type="submit">
										  <i class="material-icons">add_shopping_cart</i>
								</button>
								<input type="hidden" name="idWishlist" value="<?php echo $wishlist->id?>"/>
								</form>
								
								@if($pais==='VE'||$pais==='CO')
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="add{{$key+1}}">
										Agregar Lista
								</div>
								@else 
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="add{{$key+1}}">
										Add List
								</div>
								@endif
									
									
									  
							</td>
							
						</tr>
					
						@endforeach
						
					</tbody>
			
	

				</table>
</div>
</div>
	
@endsection

@section('vista')
<input type="hidden" value="wishlist" name="pais" />
@endsection