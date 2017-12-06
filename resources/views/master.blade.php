<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Todo Bonsai</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!---->
    <link rel="icon" type="image/jpg" href="https://i.pinimg.com/originals/61/22/71/612271e1f5df88f419fc69c29f9feda9.jpg">
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500" rel="stylesheet" type="text/css">
    <!---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
    <script
          src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous">
    </script>
    
    <link rel="stylesheet" href="/css/home.css" media="all">
    @yield('assets')

</head>

<!--Menu Superior-->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            
    <header class="mdl-layout__header" style="background-color: #00c853">
                <div class="mdl-layout__header-row">
                
  
                <!-- Title -->
                <img  height="45" width="45" src="https://seeklogo.com/images/B/bonsai-logo-3CFD7B0AC3-seeklogo.com.png">
                <span style="left: 20px" class="mdl-layout-title">Todo Bonsai eShop</span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                @if($pais === 'VE' || $pais === 'CO')
                <a class="mdl-navigation__link" href="/"> <i class="material-icons">home</i> Inicio</a>
                <a class="mdl-navigation__link" href="/product"> <i class="material-icons">view_module</i> Productos</a>
                @elseif($pais ==='UK' || $pais === 'US')
                <a class="mdl-navigation__link" href="/"> <i class="material-icons">home</i> Home</a>
                <a class="mdl-navigation__link" href="/product"> <i class="material-icons">view_module</i> Products</a>
                @else
                 <a class="mdl-navigation__link" href="/"> <i class="material-icons">home</i> Inicio</a>
                <a class="mdl-navigation__link" href="/product"> <i class="material-icons">view_module</i> Productos</a>
                @endif
                @if (Route::has('login'))
                
                    @auth
                    
                    @if(Auth::user()->email !== 'admin@admin.com')
                        @if($pais==='VE' || $pais ==='CO')
                         <a class="mdl-navigation__link" href="/getWishlist"> <i class="material-icons">view_list</i> Lista de Deseos</a>
                         <a class="mdl-navigation__link" href="/shoppingCart"> <i class="material-icons">shopping_cart</i>Carro de Compras</a>
                         <a class="mdl-navigation__link" href="/orders"> <i class="material-icons">local_shipping</i> Ordenes</a>
                         <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="material-icons">exit_to_app</i> 
                                                Logout
                                            </a>
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                        @else
                        <a class="mdl-navigation__link" href="/getWishlist"> <i class="material-icons">view_list</i> Wishlist</a>
                         <a class="mdl-navigation__link" href="/shoppingCart"> <i class="material-icons">shopping_cart</i>Shopping Cart</a>
                         <a class="mdl-navigation__link" href="/orders"> <i class="material-icons">local_shipping</i> Orders</a>
                         <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="material-icons">exit_to_app</i> 
                                                Logout
                                            </a>
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                        @endif
                    @else 
                     <a class="mdl-navigation__link" href="/admin"> <i class="material-icons">local_shipping</i> Administrar App</a>
                     <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="material-icons">exit_to_app</i> 
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                
                    @endif              
                                        
                    @else
                        @if($pais === 'US' || $pais ==='UK')
                                <a class="mdl-navigation__link" href="{{ route('login') }}"><i class="material-icons">people</i> Login</a>
                                <a class="mdl-navigation__link" href="{{ route('register') }}"><i class="material-icons">person_add</i>Register</a>
                        @else 
                                <a class="mdl-navigation__link" href="{{ route('login') }}"><i class="material-icons">people</i> Iniciar Sesion</a>
                                <a class="mdl-navigation__link" href="{{ route('register') }}"><i class="material-icons">person_add</i>Registrarse</a>
                        @endif
                    @endauth
                
                @endif

                </nav>
                
                <div aria-expanded="false" role="button" tabindex="0" class="mdl-layout__drawer-button mdl-layout--small-screen-only" style="color:black"><i class="material-icons"></i></div>
                
                
    </header>
    
    
    
<!--Menu Lateral-->
    <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Menu</span>
            <nav class="mdl-navigation">
           @if($pais === 'VE' || $pais === 'CO')
                <a class="mdl-navigation__link" href="/"> <i class="material-icons">home</i> Inicio</a>
                <a class="mdl-navigation__link" href="/product"> <i class="material-icons">view_module</i> Productos</a>
                @else
                <a class="mdl-navigation__link" href="/"> <i class="material-icons">home</i> Home</a>
                <a class="mdl-navigation__link" href="/product"> <i class="material-icons">view_module</i> Products</a>
                @endif
                @if (Route::has('login'))
                
                    @auth
                    
                    @if(Auth::user()->email !== 'admin@admin.com')
                        @if($pais==='VE' || $pais ==='CO')
                         <a class="mdl-navigation__link" href="/getWishlist"> <i class="material-icons">view_list</i> Lista de Deseos</a>
                         <a class="mdl-navigation__link" href="/shoppingCart"> <i class="material-icons">shopping_cart</i>Carro de Compras</a>
                         <a class="mdl-navigation__link" href="/orders"> <i class="material-icons">local_shipping</i> Ordenes</a>
                         <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="material-icons">exit_to_app</i> 
                                                Logout
                                            </a>
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                        @else
                        <a class="mdl-navigation__link" href="/getWishlist"> <i class="material-icons">view_list</i> Wishlist</a>
                         <a class="mdl-navigation__link" href="/shoppingCart"> <i class="material-icons">shopping_cart</i>Shopping Cart</a>
                         <a class="mdl-navigation__link" href="/orders"> <i class="material-icons">local_shipping</i> Orders</a>
                         <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                <i class="material-icons">exit_to_app</i> 
                                                Logout
                                            </a>
    
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                        @endif
                    @else 
                     <a class="mdl-navigation__link" href="/admin"> <i class="material-icons">local_shipping</i> Administrar App</a>
                     <a class="mdl-navigation__link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="material-icons">exit_to_app</i> 
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                
                    @endif              
                                        
                    @else
                        @if($pais === 'US' || $pais ==='UK')
                                <a class="mdl-navigation__link" href="{{ route('login') }}"><i class="material-icons">people</i> Login</a>
                                <a class="mdl-navigation__link" href="{{ route('register') }}"><i class="material-icons">person_add</i>Register</a>
                        @else 
                                <a class="mdl-navigation__link" href="{{ route('login') }}"><i class="material-icons">people</i> Iniciar Sesion</a>
                                <a class="mdl-navigation__link" href="{{ route('register') }}"><i class="material-icons">person_add</i>Registrarse</a>
                        @endif
                    @endauth
                
                @endif
            </nav>
    </div>
    
    
    <main class="mdl-layout__content" style="background-color: #E3EEFB">
        
        <div class="page-content">
            
            @yield('carrusel')
            
            <!--Contenido de la Pagina-->
            <article class="container">
                
                @yield('contenido')
                
            </article>
            
        </div>
         
         
         <footer class="mdl-mini-footer" style="
box-shadow: 0px 500px 0px 500px #424242;
  bottom: 0;
  right:0;
  left:0;
  padding:1rem;
  background-color: #424242">
        <div class="mdl-mini-footer__left-section">
          <div class="mdl-logo">Todo Bonsai C.A</div>
          <ul class="mdl-mini-footer__link-list">
            <li><a href="#">Help</a></li>
            <li><a href="#">Privacy & Terms</a></li>
            
            @auth
              <form action="/changePais" method="GET" id="formPais">
                @yield('vista')
                
                  <button name="selPais" value="CO" class="btn" style="background: transparent"><img src="http://proyecto-laravel-rodolfofranco.c9users.io/img/colombia.svg" style="width:30px;height:30px"/></button>
                  <button name="selPais" value="UK" class="btn" style="background: transparent"><img src="http://proyecto-laravel-rodolfofranco.c9users.io/img/united-kingdom.svg" style="width:30px;height:30px"/></button>
                  <button name="selPais" value="US" class="btn" style="background: transparent"><img src="http://proyecto-laravel-rodolfofranco.c9users.io/img/united-states.svg" style="width:30px;height:30px"/></button>
                  <button name="selPais" value="VE" class="btn" style="background: transparent"><img src="http://proyecto-laravel-rodolfofranco.c9users.io/img/venezuela.svg" style="width:30px;height:30px"/></button>

            </form>
            @endauth
            

          </ul>
        </div>
      </footer>
         
    </main>
    
    </div>