@extends('master')
@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Ordenes
	@else
	Orders
	@endif
@endsection
@section('contenido')

@if($pais==='US' || $pais==='UK')
<h1>Orders</h1>
@else 
<h1>Ordenes</h1>
@endif

<div class="card" style="">
<div class="container">
	<table id="cart" class="table table-hover table-condensed">
    		<thead>
						<tr>
							@if($pais==='VE' || $pais==='CO')
							<th style="width:55%" class=""># Orden</th>
							<th style="width:15%" class="">Fecha</th>
							<th style="width:15%" class="">Monto Total</th>
							<th style="width:15%" class="text-center center-text">Acciones</th>
							@else
							<th style="width:55%" class=""># Order</th>
							<th style="width:15%" class="">Date</th>
							<th style="width:15%" class="">Total Payment</th>
							<th style="width:15%" class="text-center center-text">Actions</th>
							@endif
						</tr>
					</thead>
					<tbody>
			
					@foreach($orders as $key=>$order)
			
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-3 hidden-xs"><h3 class="nomargin">{{$key+1}}</h3>	</div>
									<div class="col-sm-9">
										
											<div class="collapse" id="collapseExample{{$key+1}}">
											
												@foreach($productos as $key1=>$producto)
												@foreach($producto as $product)
												
												@if($key === $key1)
												<div class="row" style="padding-top:15px">
								<div class="col-sm-3 hidden-xs"><img src="{{$product->link}}" alt="..." class="img-responsive" width="50px" height="50px"/></div>
									<div class="col-sm-9">
										<h6 class="nomargin">{{$product->nombre}} <p> {{$product->descripcion}} 
										
										@if($pais==='US')
										<h5>{{$product->precio}} $</h5>
										@elseif($pais==='UK')
										<h5>{{$product->precio*0.75}} £</h5>
										@elseif($pais==='VE')
										<h5>{{$product->precio*81000}} BsF</h5>
										@else
										<h5>{{$product->precio*3000}} COP</h5>
										@endif
										
										</p></h6>
										
									</div>
								</div>
											  @endif
												@endforeach
												@endforeach
											</div>
										</div>
										
									</div>
									
								</div>
							</td>
							<td> <p>{{$order->fecha}}</p></td>
							@if($pais==='VE')
							<td data-th="Price"><h4>{{$order->montoTotal*81000}}.00 BsF</h4></td>
							@elseif($pais==='CO')
							<td data-th="Price"><h4>{{$order->montoTotal*3000}}.00 COP</h4></td>
							@elseif($pais==='UK')
							<td data-th="Price"><h4>{{$order->montoTotal*0.75}} £</h4></td>
							@else 
							<td data-th="Price"><h4>{{$order->montoTotal}} $</h4></td>
							@endif
						
							
								</td>
							<td data-th="Acciones">
								<button class="btn" id="botonOrden{{$key+1}}" type="button" data-toggle="collapse" data-target="#collapseExample{{$key+1}}" aria-expanded="false" aria-controls="collapseExample">
										  <i class="material-icons">list</i>
								</button>
								
								@if($pais==='VE' || $pais==='CO')
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonOrden{{$key+1}}">
										Ver Orden
								</div>
								@else 
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonOrden{{$key+1}}">
										View Order
								</div>
								@endif
								
								<br>
								<br>
								<form action="/cancelOrder" method="POST" >
									{{csrf_field()}}
									<input type="hidden" value="{{$order->id}}" name="idOrden"/>
								<button class="btn btn-danger" id="botonCancel" type="submit">
										  <i class="material-icons">cancel</i>
								</button>
								</form>
								
								@if($pais==='VE'||$pais==='CO')
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonCancel">
										Cancelar Orden
								</div>
								@else 
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonCancel">
										Cancel Order
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
<input type="hidden" value="order" name="pais" />
@endsection