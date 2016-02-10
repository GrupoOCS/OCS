<?php
	session_start();
	error_reporting(0);
	include 'abrirConexion.php';
?>
<html lang="es">
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
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			
			$(document).ready(function() {
				// $('.carrusel1').css('margin-top',22+'px');s
				$('a.sube').css('border-left-width', 0+'px');
				$('a.subes').css('border-left-width', 0+'px');
				$('a.sube').css('height',20 +'px');
				$('a.baja').css('height',20 +'px');
				$('a.subes').css('height',20 +'px');
				$('a.bajas').css('height',20 +'px');
				$('a.sube').css('background-color','#34495e');
				$('a.baja').css('background-color','#34495e');
				$('a.subes').css('background-color','#34495e');
				$('a.bajas').css('background-color','#34495e');
				// $('.sube').css('display','none');
				// $('.baja').css('display','none');

				// Categorias
				var inicialContenido=$('.bloque-categorias').html();
				var marginTop;
				var ban=1;
				function carrusel(){
					marginTop=$('.bloque-categorias').css('margin-top');

					marginTop=marginTop.split('p');
					if (ban) marginTop[0]=marginTop[0] - 1;

					if((($('.bloque-categorias').children().size() - 4) * 30) < Math.abs(marginTop[0])){
						ban=0;
					}
					else ban=1;
					$('.bloque-categorias').css('margin-top',marginTop[0] +'px');
				}
				var stop;	
				$('.sube').mouseout(function(){
					clearInterval(stop);
				});
				$('.sube').mouseover(function(){
					stop=setInterval(function mover() {carruselbaja();},20);
				});
				var ban1;
				function carruselbaja(){
					marginTop=$('.bloque-categorias').css('margin-top');

					marginTop=marginTop.split('px');
					if(ban1) marginTop[0]=parseInt(marginTop[0]) + 1;

					if(marginTop[0] > 0){
						ban1=0;
					}
					else ban1=1;
					$('.bloque-categorias').css('margin-top',marginTop[0] +'px');
				}
				$('.baja').mouseout(function(){
					clearInterval(stop);
				});
				$('.baja').mouseover(function(){
					stop=setInterval(function mover() {carrusel();},20);
				});


				// Sub categorias
				var inicialContenidos=$('.bloque-subcategorias').html();
				var marginTops;
				var bans=1;
				function carrusels(){
					marginTops=$('.bloque-subcategorias').css('margin-top');

					marginTops=marginTops.split('p');
					if (bans) marginTops[0]=marginTops[0] - 1;

					if((($('.bloque-subcategorias').children().size() - 4) * 10) < Math.abs(marginTops[0])){
						bans=0;
					}
					else bans=1;
					$('.bloque-subcategorias').css('margin-top',marginTops[0] +'px');
				}
				// $('.carrusel2').mouseout(function(){
				// 	$('.bloque-subcategorias').css('margin-top',0+'px');	
				// });

				// $('.carrusel2').mouseout(function(){
				// 	$('.bloque-subcategorias').css('margin-top',0+'px');	
				// });
				
				var stops;	
				$('.subes').mouseout(function(){
					clearInterval(stops);
				});
				$('.subes').mouseover(function(){
					stops=setInterval(function mover() {carruselsbaja();},20);
				});
				var ban1s=1;
				function carruselsbaja(){
					marginTops=$('.bloque-subcategorias').css('margin-top');

					marginTops=marginTops.split('px');
					if(ban1s) marginTops[0]=parseInt(marginTops[0]) + 1;

					if(marginTops[0] > 0){
						ban1s=0;
					}
					else ban1s=1;
					$('.bloque-subcategorias').css('margin-top',marginTops[0] +'px');
				}
				$('.bajas').mouseout(function(){
					clearInterval(stops);
				});
				$('.bajas').mouseover(function(){
					stops=setInterval(function mover() {carrusels();},20);
				});

			});
		</script>

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
						|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php?"
						|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php"
						|| $_SERVER["REQUEST_URI"] == "/OCS/pago.php"
						|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php?"){
					echo '<div class="menu">
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
							if ($_SERVER["REQUEST_URI"] == "/OCS/carrito.php"){
							echo'<li>
									<a class="principal ina" > Formas de Pago</a>
								</li> ';}
								if ($_SERVER["REQUEST_URI"] == "/OCS/direccion.php"
									|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php?"){
							echo'<li>
									<a class="principal ina" > Formas de Pago</a>
								</li> ';}
							
						}


						if ($_SERVER["REQUEST_URI"] == "/OCS/direccion.php"
							|| $_SERVER["REQUEST_URI"] == "/OCS/direccion.php?"){
							echo'
							<li>
								<a class="principal-active" href="#"> Datos de Envío </a>
							</li>';
						}else{
							if ($_SERVER["REQUEST_URI"] == "/OCS/carrito.php"){
							 echo'<li>
								<a class="principal ina"> Datos de Envío </a>
							</li> ';}
							if ($_SERVER["REQUEST_URI"] == "/OCS/pago.php"){
							 echo'<li>
								<a class="principal" href="direccion.php"> Datos de Envío </a>
							</li> ';}
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

						echo '<li>';
						if ($_SERVER["REQUEST_URI"] == "/OCS/ventas.php") 
							echo '<a class="principal-active" href="ventas.php?id=All">Productos</a> ';
						else echo '<a class="principal" href="ventas.php?id=All">Productos</a> ';


						$res = $db->query( "select *from categoria order by nombre;" );

						if ($res->rowCount() > 5){
							echo '<div><ul><a class="sube"><center><img src="img/sube.png"></center></a></ul></div>';
							echo '<div><ul><a class="baja"><center><img src="img/baja.png"></center></a></ul></div>';
						} else {
							echo '<div><ul><a class="sube"></a></ul></div>';
							// echo '<div onload="ajustamenu();"></div>'; 
						}
						   

						// }
							// else{
							// echo '<div><ul><a class="sube"><center></center></a></ul></div>';
							// echo '<div><ul><a class="baja"><center></center></a></ul></div>';
						// }

						echo '<div class="carrusel1"><ul class="bloque-categorias">';
						
		                foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
		                
		                    printf ("<li><a  href=\"ventas.php?id=C".$row[0]."\"><br>%s</a>",$row[1]);

		                    $res1 = $db->query("select subcategoria.id, subcategoria.nombre from subcategoria where subcategoria.idcategoria=".$row[0]." order by subcategoria.nombre;");

		                    if ($res1->rowCount() > 1){
		                    	echo '<div><ul><a class="subes"><center><img src="img/sube.png"></center></a></ul></div>';
								echo '<div><ul><a class="bajas"><center><img src="img/baja.png"></center></a></ul></div>';
		                    }
		                    echo '<div class="carrusel2"><ul class="bloque-subcategorias">';
		                    foreach ($res1-> fetchAll(PDO::FETCH_NUM) as $row1 ){
		                      		printf ("<li><a href=\"ventas.php?id=S".$row1[0]."\"><br>%s</a> </li>",$row1[1]);
		                      	$j++;
		                  	}
		                    echo "</ul></div></li>";
		                }
		                echo '</ul></div>';

					echo '</li>';


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
					
					
					}?>
				</ul>
			</div> 

			<!--Buscador-->
			<div class="busqueda">
				<form action="ventas.php">
					<div class="tx_buscar">
					<?php
						if (isset($_GET['buscador']))
						echo '<input type="text" class="form-control" name="buscador" placeholder="Buscar..." value="'.$_GET['buscador'].'">';
						else echo '<input type="text" class="form-control" name="buscador" placeholder="Buscar...">';
					?>

					</div>
  					<div class="b_buscar">
						<input type="submit" class="btn-buscar" value="Buscar"> 
					</div>
				</form>
			</div>
			
		</div>