<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet"  href="/css/app.css">
	<title>Blog de Prueba</title>
</head>
<body>
	<header>
<?php function menuActivo ($url)
	{
		return request()->is($url) ? 'active' : '' ;
	}	

?>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">

			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{{-- <a class="navbar-brand" href="#">Title</a> --}}
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">

				<li class="{{ menuActivo('/') ? 'active' : '' }}"><a  href="{{ route('home') }}  ">Inicio</a></li>
		
				<li class="{{ menuActivo('mensajes/create') ? 'active' : '' }}"> <a  href="{{  route('mensajes.create') }} ">Contacto</a></li>

				@if(auth()->check())
					<li class="{{ menuActivo('mensajes') ? 'active' : '' }}"><a  href="{{ route('mensajes.index')  }}" >Mensajes</a></li>
					
					@if(auth()->user()->hasRoles(['admin']))
					{{-- @if(auth()->user()->role === 'admin') --}}
						<li class="{{ menuActivo('usuarios') ? 'active' : '' }}"><a  href="{{ route('usuarios.index')  }}" >Usuarios</a></li>
					@endif
				@endif
		
			</ul>
			
			<ul class="nav navbar-nav navbar-right">

				@if(auth()->guest())
					<li class="{{ menuActivo('login') ? 'active' : '' }}"><a  href="/login">Login</a>
					</li>
				@else
					
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ auth()->user()->name }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/logout">Cerrar Sesión</a></li>
						<li><a href="/usuarios/{{ auth()->id() }}/edit">Mi Cuenta</a></li>
					</ul>
				</li>
				@endif
				
				
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

		


	</header>
  
 <div class="container">

 	@yield('contenido')

 </div>

	
<br>
  
 <div class="container">
	<footer>Proyecto Educativo {{ date('Y') }}</footer>
</div>

<script src="/js/all.js"></script>
</body>
</html>