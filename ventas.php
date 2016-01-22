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


	require_once('paginator.class.php');

	$id = $_GET['id'];
	$db = Conectar();
	$ids=substr($id,1);

	echo "<div class=\"contenido\">";
	$filtro = "";

	if ($id[0]=="S"){ //subcategoria
		$query = "select producto.id, producto.nombre, producto.precio from producto where producto.id_subcategoria=".$ids." order by producto.tag desc ";
	} else if ($id[0]=="C"){ //categoria
		$query = "select producto.id, producto.nombre, producto.precio from producto, (select subcategoria.id as sid from subcategoria where subcategoria.idcategoria=".$ids.") as sub where producto.id_subcategoria=sub.sid order by producto.tag desc ";
	} else { //todos o buscador
		if (isset($_GET['buscador'])){
			$filtro = $_GET['buscador'];
			echo '<p>Mostrando resultados de '.$filtro.'.</p>';
			// $query = "select producto.id, producto.nombre, producto.precio from producto where producto.nombre like '%".$_GET['buscador']."%' order by producto.tag desc";

			$query = "select bus.id, bus.nombre, bus.precio from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') order by producto.tag desc) as bus ";
		}else $query = "select producto.id, producto.nombre, producto.precio from producto order by producto.tag desc ";
	}
	$res = $db->query($query);	

	
	$pages= new Paginator;
    $pages->items_total = $res->rowCount(); // cambiamos X por el total
    $pages->mid_range = 7;
    $pages->paginate();

    echo '<div class="resultados">';
    echo $pages->display_total_results();
	echo '</div><div class="prod_pagina">';
	echo $pages->display_items_per_page();
	echo '</div><div class="page">';
	echo $pages->display_pages();
	echo '</div>';

	// echo $pages->display_jump_menu();

	if (isset($_GET['page'])) 
		$pagina = $_GET['page'];
	else $pagina = 1;

	$min = ($pagina - 1 ) * $pages->items_per_page;
	$max = $pages->items_per_page;

	if ($pages->items_per_page == "All")
		$query = $query;
	else $query = $query." limit ".$min." , ".$max;
	$res = $db->query($query);

	// echo '<br><br><br>Consulta: '.$query;

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

    echo '<div class="page_fin">';
	echo $pages->display_pages();
	// echo '</div><div class="page">';
	// echo $pages->display_jump_menu();
	// echo $pages->display_items_per_page();

	echo '</di></div>';
?>
	</div> <!-- cierre contenido  -->

<?php include('pie_pagina.php'); ?>

