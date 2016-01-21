<?php
	session_start();
	error_reporting(0);
	include 'abrirConexion.php';
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>OCS</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
			<link rel="stylesheet" type="text/css" href="estilo.css"> <!-- Hoja de estilos -->
			
			<link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Carusel -->
	    	
	    	<link rel="stylesheet" type="text/css" href="style_carrito.css">
		<!--<link rel="stylesheet" type="text/css" href="bootstrap.css"> 
 			<link href="css_carrito/bootstrap.min.css" rel="stylesheet"> -->
  			<script src="css_carrito/jquery.min.js" type="text/javascript"></script>
  			<script src="css_carrito/bootstrap.min.js" type="text/javascript"></script>
			<meta charset="utf-8"> <!-- no problem con palabras acentuadas -->
	</head>
	<body>

		<header>
			<?php 
				if ($_SESSION['nom_usu']) echo '<span class="usuario">'.$_SESSION['nom_usu'].' | </span><a class="enlace" href="funPHP/cerrarSesion.php">Cerrar Sesión</a>  ';
				else echo '<a class="enlace" href="inicioSesion.php">Iniciar Sesión</a> | <a class="enlace" href="Registrarse.php">Registrarse</a> ';
			?>
			  
		</header> 
	
		<div class="navg">
			<!--Logo-->
			<a href="index.php"><div class="logo">OCS<img class="logo-icon" src="Iconos/etiqueta.png">
				<br><span class='log'>Online Computer Shop</span>
			</div></a>
			
			<!-- MENÚ PRINCIPAL DE NAVEGACIÓN -->
			<?php if ($_SERVER["REQUEST_URI"] == "/OCS/carrito.php"
						|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php"
						|| $_SERVER["REQUEST_URI"] == "/OCS/pago.php"){
				ECHO'<div class="menu">
				<ul class="nav">';
								//printf($_SERVER["REQUEST_URI"]);
						$db = Conectar();

						if ($_SERVER["REQUEST_URI"] == "/OCS/pago.php"){
							echo'
								<li>
									<a class="principal-active" href="#"> Formas de Pago </a>
								</li> 
							 ';
						}else{
							echo'<li>
									<a class="principal" href="pago.php"> Formas de Pago</a>
								</li> ';
						}


						if ($_SERVER["REQUEST_URI"] == "/OCS/direccion.php"){
							echo'
							<li>
								<a class="principal-active" href="#"> Datos de Envío </a>
							</li>';
						}else{
							 echo'<li>
								<a class="principal" href="direccion.php"> Datos de Envío </a>
							</li> ';
						}

						echo '<li> '; 
						if ($_SERVER["REQUEST_URI"] == "/OCS/carrito.php"){
							echo '<a class="principal-active" href="#"> 
								<img class="enlace icono" src="Iconos/CAR.png">';
								$car = $db->query("select sum(cantidad) from carrito where id_cliente=".$_SESSION['id_usu'].";");
								if ($car->rowCount() > 0){
									foreach ($car-> fetchAll(PDO::FETCH_NUM) as $row ){
						 				printf ("%s</a>",$row[0]);
									}
								}
						}else{
							echo '<a class="principal" href="carrito.php"> 
								<img class="enlace icono" src="Iconos/CAR.png">';
								$car = $db->query("select sum(cantidad) from carrito where id_cliente=".$_SESSION['id_usu'].";");
								if ($car->rowCount() > 0){
									foreach ($car-> fetchAll(PDO::FETCH_NUM) as $row ){
						 				printf ("%s</a>",$row[0]);
									}
								}
						}
						echo '</li>';
				
				}else{
					echo '<div class="menu">
						<ul class="nav">';

						$db = Conectar();

						echo '<li> '; 						
								//printf($_SERVER["REQUEST_URI"]);
								if ($_SESSION['nom_usu']){
									ECHO'<a class="principal" href="carrito.php">
									<img class="enlace icono" src="Iconos/CAR.png">';
									
									$car = $db->query("select sum(cantidad) from carrito where id_cliente=".$_SESSION['id_usu'].";");
									if ($car->rowCount() > 0){
										foreach ($car-> fetchAll(PDO::FETCH_NUM) as $row ){
							 				printf ("%s</a>",$row[0]);
										}
									}
								}
					
						echo '</li>'; 

						echo '<li>';
						if ($_SERVER["REQUEST_URI"] == "/OCS/ventas.php") 
							echo '<a class="principal-active" href="ventas.php?id=All">Productos</a> ';
						else echo '<a class="principal" href="ventas.php?id=All">Productos</a> ';

						echo '<ul>';
						$res = $db->query( "select *from categoria;" );
		                foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
		                    printf ("<li><a  href=\"ventas.php?id=C".$row[0]."\"><br>%s</a>",$row[1]);

		                    $res1 = $db->query("select subcategoria.id, subcategoria.nombre from subcategoria where subcategoria.idcategoria=".$row[0].";");
		                    echo '<ul>';
		                    foreach ($res1-> fetchAll(PDO::FETCH_NUM) as $row1 ){
		                      	printf ("<li><a href=\"ventas.php?id=S".$row1[0]."\"><br>%s</a> </li>",$row1[1]);
		                  	}

		                    echo "</ul></li>";
		                }
		                echo '</ul>';

					echo '</li>';
					
					
					}?>
				</ul>
			</div> 

			<!--Buscador-->
			<div class="busqueda">
				<form action="ventas.php">
					<div class="tx_buscar">
						<input type="text" class="form-control" name="buscador" placeholder="Buscar...">
					</div>
  					<div class="b_buscar">
						<input type="submit" class="btn-buscar" value="Buscar"> 
					</div>
				</form>
			</div>
			
		</div>