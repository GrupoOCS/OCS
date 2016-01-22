<?php include('encabezado.php'); ?>
	
	<script type="text/javascript">
		function insertarCarrito ( idCliente,idProducto, cantidad ) {
			var xmlhttp;
			if ( window.XMLHttpRequest ){
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function (){
				if ( xmlhttp.readyState ==4 && xmlhttp.status==200 ){
					document.getElementById('carrito').innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","insertCarrito.php?idc="+idCliente+"&idp="+idProducto+"&n="+cantidad, true);
			xmlhttp.send();

			javascript:location.reload();
		}
	</script>

	<!--.............................TERMINA NAVEGACIÓN...............................-->
<?php	
	$id = $_GET['id'];
	$db = Conectar();
	$ids=substr($id,1);

	echo "<div class=\"contenido\">";
	$filtro = "";

	if ($id[0]=="S"){ //subcategoria
		$query = "select producto.id, producto.nombre, producto.precio from producto where producto.id_subcategoria=".$ids." order by producto.tag desc;";
	} else if ($id[0]=="C"){ //categoria
		$query = "select producto.id, producto.nombre, producto.precio from producto, (select subcategoria.id as sid from subcategoria where subcategoria.idcategoria=".$ids.") as sub where producto.id_subcategoria=sub.sid order by producto.tag desc;";
	} else { //todos o buscador
		if (isset($_GET['buscador'])){
			$filtro = $_GET['buscador'];
			echo '<p>Mostrando resultados de '.$filtro.'.</p>';
			$query = "select producto.id, producto.nombre, producto.precio from producto where producto.nombre like '%".$_GET['buscador']."%' order by producto.tag desc";
		}else $query = "select producto.id, producto.nombre, producto.precio from producto order by producto.tag desc";
	}
	$res = $db->query($query);

	if ($res->rowCount() == 0){
		echo '<p>No se encontrarón resultados.</p>';
	}else {
		foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
			$prodimg = $db->query( "select imagen.nombre from imagen where imagen.id_producto=".$row[0]." limit 1;" );
			echo "<div class=\"producto\">";
				foreach ($prodimg-> fetchAll(PDO::FETCH_NUM) as $r) {
					printf ("<a href=\"DescripcionProducto.php?id=%s\"><img href=\"#\" class=\"producto\" src=\"%s\"></a>", $row[0], $r[0]);
				}
				$c = substr($row[1], 0, 45);
				if (strlen($row[1]) > 45)
					$c = $c."...";
				printf ("<div class=\"nombre_producto\">%s</div>", $c);
				printf ("<div class=\"precio_producto\">$%s</div>", $row[2]);
				
				if ($_SESSION['nom_usu']){
					printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$row[0].",1);\" class=\"agrega_carrito\"><img class=\"add_car\" src=\"Iconos/agregar.png\"></a>",$row[0]);
				}
            echo "</div>";
        }
    }
?>
	<!-- <div class="contenido">
		<div class="producto">
			<img class="producto" src="Productos/9comp.jpg">
			<div class="nombre_producto">Wireless TP-link</div>
			<div class="precio_producto">$550.00</div>
			<a href="#	" class="agrega_carrito"><img class="add_car" src="Iconos/agregar.png"></a>
		</div> -->


	<!-- <div class="pagina-cion">
		<section class="paginacion">
			<ul>
				<li class="previous-off">«Previous</li>
				<li><a href="?page=1" class="active">1</a></li>
				<li><a href="?page=2">2</a></li>
				<li><a href="?page=3">3</a></li>
				<li><a href="?page=4">4</a></li>
				<li><a href="?page=5">5</a></li>
				<li class="next">Next »</li>
			</ul>
		</section>
	</div> -->
	




	<!-- <div class="pagina-cion">	
		<ul id="pagination-digg">
			<li class="previous-off">«</li>
			<li class="active">1</li>
			<li><a href="?page=2">2</a></li>
			<li><a href="?page=3">3</a></li>
			<li><a href="?page=4">4</a></li>
			<li><a href="?page=5">5</a></li>
			<li><a href="?page=6">6</a></li>
			<li><a href="?page=7">7</a></li>
			<li class="next"><a href="?page=8">»</a></li>
		</ul>
	</div> -->

	</div> <!-- cierre contenido  -->

<?php include('pie_pagina.php'); ?>

