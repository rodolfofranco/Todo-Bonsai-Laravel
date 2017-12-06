@extends('master')
@section('title')
	@if($pais === 'VE' || $pais === 'CO')
	Inicio
	@else
	Home
	@endif
@endsection

@section('assets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link rel="stylesheet" href="/css/welcome.css" media="all">
@endsection


@section('carrusel')
<div id="carouselExampleIndicators" class="carousel slide mdl-layout--large-screen-only" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="http://www.upperdelawarecouncil.org/wp-content/uploads/udc-home-rotate-2-resized-image-1366x400.jpg" alt="First slide">
       <div class="carousel-caption d-none d-md-block">
         @if($pais === 'VE' || $pais==='CO' || $pais === null)
         <h3>Bienvenido a Todo Bonsai eShop</h3>
         <p>La mejor plataforma online de ventas de Bonsai</p>
         @else
         <h3>Welcome to Todo Bonsai eShop</h3>
         <p>The best online platform for Bonsai sales</p>
         @endif
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://belmondcdn.azureedge.net/bgh/1366x400/bgh_1366x400_destination_ireland02.jpg" alt="Second slide">
       <div class="carousel-caption d-none d-md-block">
    @if($pais === 'VE' || $pais === 'CO' || $pais === null)     
    <h3>Nuestros Bonsais son de la mas alta calidad</h3>
    <p>No esperes mas y revisa nuestro catalogo</p>
    @else
    <h3>Our Bonsais are of the highest quality</h3>
    <p>What are you waiting? Come and take a look at our catalog</p>
    @endif
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="http://www.coiguequemado.cl/wp-content/uploads/2016/09/header-1366x400.jpg" alt="Third slide">
       <div class="carousel-caption d-none d-md-block">
    @if( $pais === 'VE' || $pais === 'CO' || $pais === null)     
    <h3>Conectate con la naturaleza con alguno de nuestros Bonsais</h3>
    <p>Nunca es tarde para probar algo distinto</p>
    @else
    <h3>Connect with nature with any of our Bonsais</h3>
    <p>It's never too late to try something new</p>
    @endif
  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endsection


@section('contenido')

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-screen-desktop m-auto text-primary"></i>
              </div>
              @if ( $pais === 'US' || $pais === 'UK' )
              <h3>Fully Responsive</h3>
              <p class="lead mb-0">This app will look great on any device, no matter the size!</p>
              @else
              <h3>Completamente Responsive</h3>
              <p class="lead mb-0">Esta aplicacion se podra usar en cualquier pantalla, sin importa su tamaño!</p>
              @endif
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-layers m-auto text-primary"></i>
              </div>
              @if ( $pais === 'US' || $pais === 'UK' )
              <h3>Made with Laravel</h3>
              <p class="lead mb-0">Featuring the latest build of the Laravel framework!</p>
              @else
              <h3>Hecho con Laravel</h3>
              <p class="lead mb-0">Presentando la última versión del framework Laravel!</p>
              @endif
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-check m-auto text-primary"></i>
              </div>
              @if ( $pais === 'US' || $pais === 'UK' )
              <h3>Easy to Use</h3>
              <p class="lead mb-0">Ready to use start browsing now!</p>
              @else 
              <h3>Facil de usar</h3>
              <p class="lead mb-0">Listo para utilizar empieze a navegar!</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@section('vista')
<input type="hidden" value="welcome" name="pais" />
@endsection