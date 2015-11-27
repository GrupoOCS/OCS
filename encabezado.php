
<html>
	<head>
		<title>Estilos del proyecto</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
	    	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- Bootstrap necesario para carrusel only -->
	    	<link rel="stylesheet" type="text/css" href="css/carousel.css">
	    	<link rel="stylesheet" type="text/css" href="estilo.css"> <!-- Hoja de estilos -->
		<!--<link rel="stylesheet" type="text/css" href="bootstrap.css"> -->
			<meta charset="utf-8"> <!-- no problem con palabras acentuadas -->
	</head>
	<body>

		<!-- INCIAR SESION | REGISTRARSE  O    NOMBRE DE USUARIO -->
		<header>
			<?php 
								//printf($_SERVER["REQUEST_URI"]);
							if ($_SERVER["REQUEST_URI"] == "/ocs/Registrarse.php" ) 

							ECHO'<a class="enlace" href="inicioSesion.php">Iniciar Sesión</a>  ';
							else if($_SERVER["REQUEST_URI"] == "/ocs/inicioSesion.php")
							ECHO'<a class="enlace" href="Registrarse.php">Registrarse</a> ';
							else
							ECHO'<a class="enlace" href="inicioSesion.php">Iniciar Sesión</a> | <a class="enlace" href="Registrarse.php">Registrarse</a> ';

							?>
			  
		</header> 
	<!--..........................INICIA NAVEGACIÓN....................................... -->
	
		<div class="navg">

			<!-- LOGO OCS ONLINE COMPUTER SHOP -->
			<a href="index.php"><div class="logo">OCS<img class="logo-icon" src="Iconos/etiqueta.png">
				<br><span class='log'>Online Computer Shop</span>
			</div></a>
			<!-- .......................................................... -->

			<!-- FORMULARIO PARA EL BUSCADOR -->
			<div class="busqueda">
				<form>
					<div class="b_buscar">
						<input type="submit" class="btn-buscar" value="Buscar"> 
					</div>
					<div class="tx_buscar">
						<input type="text" class="form-control" name="buscador" placeholder="Buscar..." >
					</div>
					
				</form>
			</div>
			<!-- .......................................................... -->
			<!-- MENÚ PRINCIPAL DE NAVEGACIÓN -->
			<div class="menu">
				<ul class="nav">
					<li>

							<?php 
								//printf($_SERVER["REQUEST_URI"]);
							if ($_SERVER["REQUEST_URI"] == "/ocs/ventas.php" ||
							 $_SERVER["REQUEST_URI"] == "/ocs/almacenamiento.php" || 
							  $_SERVER["REQUEST_URI"] == "/ocs/accesorios.php" ||
							   $_SERVER["REQUEST_URI"] == "/ocs/desktop.php" ||
							    $_SERVER["REQUEST_URI"] == "/ocs/laptop.php" ||
							   	 $_SERVER["REQUEST_URI"] == "/ocs/impresoras.php" ) 

							ECHO'<a class="principal-active" href="ventas.php">Productos  </a> ';
							else
								ECHO'<a class="principal" href="ventas.php">Productos  </a> ';

							?>
						
							<ul>
								<li><a  href="almacenamiento.php"><br>Almacenamiento</a></li>	
								<li><a  href="accesorios.php"><br>Accesorios </a></li>	
								<li><a  href=""><br>Computadoras </a>
									<ul>
										<li><a href="desktop.php"><br>Escritorio</a> </li>
										<li><a href="laptop.php"><br>Portátiles</a></li>
									</ul>
									</li>	
								<li><a  href="impresoras.php"><br>Impresoras </a></li>	
							</ul>
					</li>
					
				

					<li>
						<?php 
								//printf($_SERVER["REQUEST_URI"]);
							if ($_SERVER["REQUEST_URI"] == "/ocs/carrito.php" ) 

							ECHO'<a class="principal-active" href="carrito.php"> 
								<img class="enlace icono" src="Iconos/CAR.png">
							</a>  ';
							else
								ECHO'<a class="principal" href="carrito.php"> 
								<img class="enlace icono" src="Iconos/CAR.png">
							</a>  ';

							?>
							 
					</li>	
				</ul>
			</div> 
		</div>


					
		<!-- .......................................................................-->




		<!-- CIERRE DE HTML EN EL PIE DE PAGINA -->