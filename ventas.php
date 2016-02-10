<?php 
	include('encabezado.php'); 
	require_once('paginator.class.php');

	if(isset($_GET["NP"])){
		if($_GET["NP"]=="si")
		{
			echo"<p class=\"alert alert-danger\" align=\"center\"> No tiene productos en su carrito </p>";	
			echo"<script> setTimeout(function(){  location.href = \"ventas.php\"; }, 1000); </script>";
			//header('location:ventas.php');			
		}
	}
	// Referencia paginacion
	// http://www.masquewordpress.com/paginacion-php-con-clase/
	// http://www.catchmyfame.com/2007/07/28/finally-the-simple-pagination-class/
?>
	<script type="text/javascript">
		function insertarCarrito ( idCliente,idProducto, cantidad ) {
			var xmlhttp;
			if ( window.XMLHttpRequest ) xmlhttp = new XMLHttpRequest();
			else xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = function (){
				if ( xmlhttp.readyState ==4 && xmlhttp.status==200 ) document.getElementById('carrito').innerHTML = xmlhttp.responseText;
			}
			xmlhttp.open("GET","insertCarrito.php?idc="+idCliente+"&idp="+idProducto+"&n="+cantidad, true);
			xmlhttp.send();
			javascript:location.reload();
		}

		function toggle(source) {
		  	checkboxes = document.getElementsByName('precios[]');
		  	for(var i=0, n=checkboxes.length;i<n-1;i++) {
			    checkboxes[i].checked = false;
		  	}

		  	if (checkboxes[checkboxes.length-1].checked == true){
				document.getElementById("desde").required = true;
				document.getElementById("hasta").required = true;
			}else {
				document.getElementById("desde").required = false;
				document.getElementById("hasta").required = false;
			}
		}		

		function toggle_interval(source) {
		  	checkboxes = document.getElementsByName('precios[]');
			checkboxes[checkboxes.length-1].checked = false;
		}
		function enviarForm(){
			f1 = document.getElementById('form1');

			f1.submit();
		}
	</script>

<?php
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
			if ($valor==1){
				if (strlen($_GET['desde'])>0 && strlen($_GET['hasta'])>0)
					$where_precios = $where_precios.'(producto.precio>='.$_GET['desde'].' and producto.precio<='.$_GET['hasta'].')';
				else if(is_numeric($_GET['desde']) && !is_numeric($_GET['hasta'])) 
					$where_precios = $where_precios.'(producto.precio>='.$_GET['desde'].' and producto.precio<='.$_GET['precio_maximo'].')';
				else if(!is_numeric($_GET['desde']) && is_numeric($_GET['hasta'])) 
					$where_precios = $where_precios.'(producto.precio>='.$_GET['precio_minimo'].' and producto.precio<='.$_GET['hasta'].')';
				else $where_precios = $where_precios.'1';
			}else if($i==1) $where_precios = $where_precios.$valor;
			else $where_precios = $where_precios." or ".$valor;
			$i++;
		}
		$where_precios = $where_precios.")";
	}
	// echo $where_precios;

	if ($id[0]=="S"){ //subcategoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where producto.cantidad>0 and producto.id_subcategoria=".$ids." ".$where_marcas." ".$where_precios." order by producto.tag desc ";

		$pos = $db->query("select categoria.nombre,subcategoria.nombre from categoria,subcategoria where subcategoria.idcategoria=categoria.id and subcategoria.id=".$ids);
		$query_marcas = "select marca from producto where producto.cantidad>0 and producto.id_subcategoria=".$ids." group by marca order by marca";
		$query_precios = "select min(precio), max(precio) from producto where producto.cantidad>0 and id_subcategoria=".$ids;
	} else if ($id[0]=="C"){ //categoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto, (select subcategoria.id as sid from subcategoria where subcategoria.idcategoria=".$ids.") as sub where producto.cantidad>0 and  producto.id_subcategoria=sub.sid ".$where_marcas." ".$where_precios." order by producto.tag desc ";
	
		$pos = $db->query("select nombre from categoria where id=".$ids);
		
		$query_marcas = "select marca from producto,subcategoria,categoria where producto.cantidad>0 and producto.id_subcategoria=subcategoria.id and subcategoria.idcategoria=categoria.id and categoria.id=".$ids." group by marca order by marca;";
		$query_precios = "select min(precio), max(precio) from producto,subcategoria,categoria where producto.cantidad>0 and producto.id_subcategoria=subcategoria.id and subcategoria.idcategoria=categoria.id and categoria.id=".$ids;
	} else { //todos o buscador
		if (isset($_GET['buscador'])){
			$query = "select bus.id, bus.nombre, bus.precio, bus.marca from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where producto.cantidad>0 and subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ".$where_marcas." ".$where_precios." order by producto.tag desc) as bus ";
			
			$query_marcas = "select bus.marca from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where producto.cantidad>0 and subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ) as bus group by marca order by marca";
			$query_precios = "select min(bus.precio), max(bus.precio) from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where producto.cantidad>0 and subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ) as bus";
		}else { 
			$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where producto.cantidad>0 ".$where_marcas." ".$where_precios." order by producto.tag desc ";
			
			$query_marcas = "select marca from producto where producto.cantidad>0 group by marca order by marca";
			$query_precios = "select min(precio), max(precio) from producto where producto.cantidad>0";
			// echo $query_marcas;
		}
	}
	$res = $db->query($query);
?>

	<div class="titulo_ventas_txt">
		<h4>
			<b class="filtros-txt">
			<?php
				if ($id[0]=="S") foreach ($pos-> fetchAll(PDO::FETCH_NUM) as $row ) echo $row[0].' / '.$row[1];
				else if ($id[0]=="C") foreach ($pos-> fetchAll(PDO::FETCH_NUM) as $row ) echo $row[0];
				else {
					if (isset($_GET['buscador'])){
						if ($_GET['buscador']!="")
							echo $_GET['buscador'];
						else echo 'Todos los productos';
					}
					else echo 'Todos los productos';
				}
			?>
			</b>
		</h4> 
	</div>

	<div class="filtros_busqueda">
		<h4><b class="filtros-txt">FILTROS:</b></h4>
		<?php
		echo '<form id="form1" action="'.$_SERVER['PHP_SELF'].'" method="get">';
		echo '<input type="hidden" name="buscador" value="'.$_GET['buscador'].'">'; 
		echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
		?>
			<div class="filtro_titulo"><b class="filtros-txt">Marca</b>
			<?php
				$marcas_q = $db->query($query_marcas);
				foreach ($marcas_q-> fetchAll(PDO::FETCH_NUM) as $row )
					if (in_array($row[0], $marcas))
						echo '<div class="filtro"><div class="marca">'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="marcas[]" value="'.$row[0].'" onChange="enviarForm()" Checked></div></div>';
					else echo '<div class="filtro"><div class="marca">'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="marcas[]" value="'.$row[0].'" onChange="enviarForm()"></div></div>';
			?>
			</div>

			<div class="filtro_titulo_precio"><b class="filtros-txt">Precio</b>
			<?php
				$precios_q = $db->query($query_precios);
				foreach ($precios_q-> fetchAll(PDO::FETCH_NUM) as $row ){
					if ($row[0]!=NULL && $row[1]!=NULL) {
						if ($row[0]==$row[1])
							if (in_array('(producto.precio='.$row[0].')', $precios))
								echo '<div class="filtro"><div class="marca"> $'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle_interval(this)" value="(producto.precio='.$row[0].')" onChange="enviarForm()" checked></div></div>';
							else echo '<div class="filtro"><div class="marca"> $'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle_interval(this)" value="(producto.precio='.$row[0].')" onChange="enviarForm()"></div></div>';
						else {

							if ($row[1]-$row[0]<=100) $num=1;
							else if ($row[1]-$row[0]<=1000) $num=2;
							else if ($row[1]-$row[0]<=5000) $num=3;
							else if ($row[1]-$row[0]<=15000) $num=4;
							else $num=5;
							
							$interval = round( ($row[1] - $row[0]) / $num );
							for ($i=0; $i<$num; $i++){
								$i_inicial = $row[0]+($interval*$i);
								$i_final = $row[0]+($interval*($i+1)) ;
								if (in_array('(producto.precio>='.$i_inicial.' and producto.precio<='.$i_final.')', $precios))
									echo '<div class="filtro"><div class="marca"> $'.$i_inicial.' - $'.$i_final.'</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle_interval(this)" value="(producto.precio>='.$i_inicial.' and producto.precio<='.$i_final.')" onChange="enviarForm()" Checked></div></div>';
								else echo '<div class="filtro"><div class="marca"> $'.$i_inicial.' - $'.$i_final.'</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle_interval(this)" value="(producto.precio>='.$i_inicial.' and producto.precio<='.$i_final.')" onChange="enviarForm()"></div></div>';
							}
						}
					}

				if (in_array('1', $precios)){
					echo '<div class="filtro_precio_input"><div class="marca">
						Desde:<br>';

					if (is_numeric($_GET['desde']) && is_numeric($_GET['hasta'])){
						echo '<input type="number" class="input_precio" name="desde" id="desde" step="any" value="'.$_GET['desde'].'" onChange="enviarForm()"> <br>';
						echo 'Hasta:<br>';
						echo '<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="'.$_GET['hasta'].'" onChange="enviarForm()" > <br>';
					}else if(is_numeric($_GET['desde']) && is_numeric($_GET['hasta'])==false) {
						echo '<input type="number" class="input_precio" name="desde" id="desde" step="any" value="'.$_GET['desde'].'" onChange="enviarForm()"> <br>';
						echo 'Hasta:<br>';
						echo '<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="'.$_GET['precio_maximo'].'" onChange="enviarForm()" > <br>';
					}else if(is_numeric($_GET['desde'])==false && is_numeric($_GET['hasta'])) {
						echo '<input type="number" class="input_precio" name="desde" id="desde" step="any" value="'.$_GET['precio_minimo'].'" onChange="enviarForm()"> <br>';
						echo 'Hasta:<br>';
						echo '<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="'.$_GET['hasta'].'" onChange="enviarForm()" > <br>';
					}else {
						echo '<input type="number" class="input_precio" name="desde" id="desde" step="any" value="'.$_GET['precio_minimo'].'" onChange="enviarForm()"> <br>';
						echo 'Hasta:<br>';
						echo '<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="'.$_GET['precio_maximo'].'" onChange="enviarForm()" > <br>';
					}
					
					echo '</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle(this)" value="1" onChange="enviarForm()" Checked></div></div>';
				}else{
					echo '<div class="filtro_precio_input"><div class="marca">
						Desde:<br>
							<input type="number" class="input_precio" name="desde" id="desde" step="any" value="'.$row[0].'" disabled> <br>
						Hasta:<br>
							<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="'.$row[1].'" disabled> <br>';
					echo '</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle(this)" value="1" onChange="enviarForm()"></div></div>';
				}
				echo '<input type="hidden" name="precio_maximo" value="'.$row[1].'">';
				echo '<input type="hidden" name="precio_minimo" value="'.$row[0].'">';
			}
			?>
			</div>
			<!-- <input type="submit" value="Buscar"/>  -->
		</form>
	</div>

<?php

	echo '<div id="contenido" class="contenido_productos">';

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
				
				$resc = "select producto.cantidad as cantidad_producto,carrito.cantidad as cantidad_carrito FROM producto,carrito WHERE producto.id=".$row[0]." and carrito.id_producto=".$row[0];
				$max_resc = $db->query($resc);
				$max = 1;
				if($max_resc->rowCount() > 0){			
					foreach ($max_resc->fetchAll(PDO::FETCH_ASSOC) as $value) {
						$max=$value["cantidad_producto"]-$value["cantidad_carrito"];
					}
				}

				if ($_SESSION['nom_usu'] and $max > 0){
					printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$row[0].",1);\" class=\"agrega_carrito\"><img class=\"add_car\" src=\"Iconos/agregar.png\"></a>",$row[0]);
				}
            echo "</div>";
        }
    }

    echo '<div class="page_fin">';
	echo $pages->display_pages();

	echo '</di></div>';
?>
	</div> <!-- cierre contenido  -->	

<?php include('pie_pagina.php'); ?>

