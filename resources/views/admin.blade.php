@extends('master')
@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Admin
	@else
	Admin
	@endif
@endsection


@section('contenido')

    <h2>Agregar un producto</h2>
    <form action="/addAdminProduct" method="GET">
      
      <div class="row">
        <section class="col-lg-4 col-md-4 mb-4">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="nombreP" name="nombreP">
            <label class="mdl-textfield__label" for="nombreP">Nombre del producto</label>
          </div>
        </section>
        <section class="col-lg-8 col-md-8 mb-8">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%">
            <input class="mdl-textfield__input" type="text" id="descripcionP" name="descripcionP">
            <label class="mdl-textfield__label" for="descripcionP">Descripcion del producto</label>
          </div>
        </section>
      </div>
      
      <div class="row">
        <section class="col-lg-4 col-md-4 mb-4">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="precioP" name="precioP">
            <label class="mdl-textfield__label" for="precioP">Precio en $</label>
            <span class="mdl-textfield__error">Lo ingresado no es un numero</span>
          </div>
        </section>
        <section class="col-lg-4 col-md-4 mb-4">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <select class="mdl-textfield__input" id="categoriaP" name="categoriaP" name="categoriaP">
              <option selected disabled>Seleccione la categoria</option>  
              <option value="maceta">Maceta</option>
              <option value="bonsai">Bonsai</option>
              <option value="accesorio">Accesorio</option>
            </select>
            <label class="mdl-textfield__label">Categoria</label>
          </div>
        </section>
        <section class="col-lg-4 col-md-4 mb-4">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="linkP" name="linkP">
            <label class="mdl-textfield__label" for="linkP">Link de la foto</label>
          </div>
        </section>
      </div>
      
      <button type="submit" class="btn btn-primary">Agregar</button>
      <br>
      <br>
    </form>
    

    <h2>Gestionar los productos</h2>

        <div class="row">
          <form action="/eliminarProducto" method="POST" class="col-lg-6 col-md-6 mb-6">
            {{csrf_field()}}
            <section class="col-lg-12 col-md-12 mb-12">
              <h4>Gestión de productos</h4>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                
                <select class="mdl-textfield__input" id="categoriaP" name="borrarP">
                  <option selected disabled>Seleccionar producto</option>
                  
                  @foreach($productos as $producto)
                  
                      <option value="{{$producto->id}}">{{$producto->nombre}}. Precio: {{$producto->precio}} $</option>
                  @endforeach
                  
                </select>
                <label class="mdl-textfield__label">Productos</label>
              </div>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Eliminar
                </button>
                
            </section>
          </form>
          
          <form action="/updateProducto" method="POST" class="col-lg-6 col-md-6 mb-6">
            {{csrf_field()}}
            <section class="col-lg-12 col-md-12 mb-12">
              <h4>Actualizar precios</h4>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <select class="mdl-textfield__input" id="categoriaP" name="gestionarP">
                   <option selected disabled>Seleccionar producto</option>
                  
                  @foreach($productos as $producto)
                  
                      <option value="{{$producto->id}}">{{$producto->nombre}}. Precio: {{$producto->precio}} $</option>
                  @endforeach
                  </select>
                  <label class="mdl-textfield__label">Productos</label>
                </div>
                <div class="row">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="precioN" name="precioN">
                    <label class="mdl-textfield__label" for="precioN">Precio Nuevo</label>
                    <span class="mdl-textfield__error">Favor ingresa sólo números</span>
                  </div>
                  <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">
                    Actualizar precio
                  </button>
                </div>
            </section>
          </form>
        </div>
        
          <h2>Gestionar Ordenes</h2>
            
            <div class="card" style="">
            <div class="container">
	<table id="cart" class="table table-hover table-condensed">
    		<thead>
						<tr>
							<th style="width:55%" class="">Usuario</th>
							<th style="width:15%" class="text-center center-text">Acciones</th>
						</tr>
					</thead>
					<tbody>
			
				
			@foreach($usuarios as $key=>$usuario)
						<tr>
						  
							<td data-th="Product">
								
							
								<h5><i class="material-icons">person_pin</i>{{$usuario->email}}</h5>
									
										<div class="collapse" id="collapseExample{{$key+1}}">
										  
										<div class="row">
										  
										  <div class="col-sm">
											  <h4>Orden</h4>
											 </div>
											 
											 <div class="col-sm">
											  <h4>Monto Total</h4>
											 </div>
											 
											 <div class="col-sm">
											  <h4>Fecha</h4>
											 </div>
											 
											 <div class="col-sm">
											  <h4>Accion</h4>
											 </div>
										  
										</div>
										
										@foreach($ordenes as $key1=>$orden)
										@if($orden->user_id == $usuario->id)
										<div class="row">
											<div class="col-sm">
											  <h6>Id Orden: {{$orden->id}}</h6>
											 </div>
											<div class="col-sm">
											  
											  
									    	<h6 class="nomargin"> <h6> {{$orden->montoTotal}} $</h6></h6>
									    	
									    </div>
        								
        
                    <div class="col-sm">
									        
									        <h6>{{$orden->fecha}}</h6>
									        
									      </div>
        
        								<div class="col-sm">
        								  </br>
										    <form action="/cancelOrderAdmin" method="POST" >
										      {{csrf_field()}}
										      <input type="hidden" value="{{$orden->id}}" name="idOrden"/>
        								<button class="btn btn-danger" id="botonCancel{{$key1+1}}" type="submit">
        										  <i class="material-icons">cancel</i>
        								</button>
        								</form>
        								
        								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonCancel{{$key1+1}}">
        										Cancelar Orden
        								</div>
        								
									      </div>
									    
									    
									    </div>
									    @endif
									 @endforeach
										</div>
										
									
									
								
							</td>
							<td data-th="Acciones">
								<button class="btn" id="botonOrden{{$key+1}}" type="button" data-toggle="collapse" data-target="#collapseExample{{$key+1}}" aria-expanded="false" aria-controls="collapseExample">
										  <i class="material-icons">list</i>
								</button>
								<div class="mdl-tooltip mdl-tooltip--right" data-mdl-for="botonOrden{{$key+1}}">
										Ver Ordenes
								</div>
								
										  
							</td>
							@endforeach
						</tr>
						
					
						
					</tbody>
			
	

				</table>
</div>
</div>
    


@endsection