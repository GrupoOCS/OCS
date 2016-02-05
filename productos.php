<?php
	include 'abrirConexion.php';
	require_once('paginator.class.php');

	$id = $_GET['id'];
	$marcas = $_GET['marcas'];
	$precios = $_GET['precios'];
	$db = Conectar();
	$ids=substr($id,1);

	$pages= new Paginator;

	$where_marcas = "";
	if(isset($marcas)) {
		$i=1;
		$where_marcas = " and (";
		foreach ($marcas as $valor) {
			if($i==1) $where_marcas = $where_marcas."producto.marca='".$valor."'";
			else $where_marcas = $where_marcas." or producto.marca='".$valor."'";
			$i++;
		}
		$where_marcas = $where_marcas.")";
	}
	// echo $where_marcas;

	$where_precios = "";
	if (isset($precios)){
		// print_r($precios);
		$i=1;
		$where_precios = " and (";
		foreach ($precios as $valor) {
			if($i==1) $where_precios = $where_precios.$valor;
			else $where_precios = $where_precios." or ".$valor;
			$i++;
		}
		$where_precios = $where_precios.")";
	}

	if ($id[0]=="S"){ //subcategoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where producto.id_subcategoria=".$ids." ".$where_marcas." ".$where_precios." order by producto.tag desc ";
	} else if ($id[0]=="C"){ //categoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto, (select subcategoria.id as sid from subcategoria where subcategoria.idcategoria=".$ids.") as sub where producto.id_subcategoria=sub.sid ".$where_marcas." ".$where_precios." order by producto.tag desc ";
	} else { //todos o buscador
		if (isset($_GET['buscador'])){
			$query = "select bus.id, bus.nombre, bus.precio, bus.marca from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ".$where_marcas." ".$where_precios." order by producto.tag desc) as bus ";
		}else { 
			$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where 1 ".$where_marcas." ".$where_precios." order by producto.tag desc ";
		}
	}
	$res = $db->query($query);

	// echo '<div id="contenido" class="contenido_productos">';

	$pages->items_total = $res->rowCount();
    $pages->mid_range = 5; 
    $pages->paginate();

    echo '<div class="resultados">';
    echo $pages->display_total_results();
	echo '</div><div class="prod_pagina">';
	echo $pages->display_items_per_page();
	echo '</div>';

	if (isset($_GET['page'])) 
		$pagina = $_GET['page'];
	else $pagina = 1;

	$min = ($pagina - 1 ) * $pages->items_per_page;
	$max = $pages->items_per_page;

	if ($pages->items_per_page == "Todos")
		$query = $query;
	else $query = $query." limit ".$min." , ".$max;
	$res = $db->query($query);

	// echo '<br><br><br>Consulta: '.$query;

	if ($res->rowCount() == 0) echo '<div class="no_producto">No se encontrarón resultados.</div>';
	else {
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
				printf('<div class="marca_producto">%s</div>',$row[3]);
				printf ("<div class=\"precio_producto\">$%s</div>", $row[2]);
				
				if ($_SESSION['nom_usu']){
					printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$row[0].",1);\" class=\"agrega_carrito\"><img class=\"add_car\" src=\"Iconos/agregar.png\"></a>",$row[0]);
				}
            echo "</div>";
        }
    }

 //    echo '<div class="page_fin">';
	// echo $pages->display_pages();

	// echo '</di></div>';
?>
	<!-- </div> cierre contenido 	 -->

