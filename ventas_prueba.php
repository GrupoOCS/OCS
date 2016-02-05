<?php 
	include('encabezado.php'); 
	require_once('paginator.class.php');
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

		function verProductos(){
			// var datos= {
			// 	"id" : id,
			// 	"marcas" : marcas,
			// 	"precios" : precios
			// };
			$.ajax({
				data: null,
			  	url:   'productos.php',
			    type:  'post',
			    success:  function (response) {
				   	$("#contenido").html(response);
				}
			});
			return false;
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
			if($i==1) $where_precios = $where_precios.$valor;
			else $where_precios = $where_precios." or ".$valor;
			$i++;
		}
		$where_precios = $where_precios.")";
	}

	if ($id[0]=="S"){ //subcategoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where producto.id_subcategoria=".$ids." ".$where_marcas." ".$where_precios." order by producto.tag desc ";

		$pos = $db->query("select categoria.nombre,subcategoria.nombre from categoria,subcategoria where subcategoria.idcategoria=categoria.id and subcategoria.id=".$ids);
		$query_marcas = "select marca from producto where producto.id_subcategoria=".$ids." group by marca order by marca";
		$query_precios = "select min(precio), max(precio) from producto where id_subcategoria=".$ids;
	} else if ($id[0]=="C"){ //categoria
		$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto, (select subcategoria.id as sid from subcategoria where subcategoria.idcategoria=".$ids.") as sub where producto.id_subcategoria=sub.sid ".$where_marcas." ".$where_precios." order by producto.tag desc ";
	
		$pos = $db->query("select nombre from categoria where id=".$ids);
		
		$query_marcas = "select marca from producto,subcategoria,categoria where producto.id_subcategoria=subcategoria.id and subcategoria.idcategoria=categoria.id and categoria.id=".$ids." group by marca order by marca;";
		$query_precios = "select min(precio), max(precio) from producto,subcategoria,categoria where producto.id_subcategoria=subcategoria.id and subcategoria.idcategoria=categoria.id and categoria.id=".$ids;
	} else { //todos o buscador
		if (isset($_GET['buscador'])){
			$query = "select bus.id, bus.nombre, bus.precio, bus.marca from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ".$where_marcas." ".$where_precios." order by producto.tag desc) as bus ";
			
			$query_marcas = "select bus.marca from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ) as bus group by marca order by marca";
			$query_precios = "select min(bus.precio), max(bus.precio) from (select producto.id as id, producto.precio as precio, producto.nombre, producto.descripcion, producto.marca, subcategoria.nombre as sub, categoria.nombre as cat from producto, subcategoria, categoria where subcategoria.id=producto.id_subcategoria and categoria.id=subcategoria.idcategoria and (producto.nombre like '%".$_GET['buscador']."%' or producto.descripcion like '%".$_GET['buscador']."%' or producto.marca like '%".$_GET['buscador']."%' or subcategoria.nombre like '%".$_GET['buscador']."%' or categoria.nombre like '%".$_GET['buscador']."%') ) as bus";
		}else { 
			$query = "select producto.id, producto.nombre, producto.precio, producto.marca from producto where 1 ".$where_marcas." ".$where_precios." order by producto.tag desc ";
			
			$query_marcas = "select marca from producto group by marca order by marca";
			$query_precios = "select min(precio), max(precio) from producto";
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
					if (isset($_GET['buscador'])) echo $_GET['buscador'];
					else echo 'Todos los productos';
				}
			?>
			</b>
		</h4> 
	</div>

	<div class="filtros_busqueda">
		<h4><b class="filtros-txt">FILTROS:</b></h4>
		<?php
		echo '<form id="form1" act
		ion="'.$_SERVER['PHP_SELF'].'" method="get">';
		echo '<input type="hidden" name="buscador" value="'.$_GET['buscador'].'">'; 
		echo '<input type="hidden" name="id" value="'.$_GET['id'].'">'; ?>
			<div class="filtro_titulo"><b class="filtros-txt">Marca</b>
			<?php
				$marcas_q = $db->query($query_marcas);
				foreach ($marcas_q-> fetchAll(PDO::FETCH_NUM) as $row )
					if (in_array($row[0], $marcas))
						echo '<div class="filtro"><div class="marca">'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="marcas[]" value="'.$row[0].'" onChange="verProductos();" Checked></div></div>';
					else echo '<div class="filtro"><div class="marca">'.$row[0].'</div><div class="marca_check"><input type="checkbox" name="marcas[]" value="'.$row[0].'" onChange="verProductos();"></div></div>';
			?>
			</div>

			<div class="filtro_titulo_precio"><b class="filtros-txt">Precio</b>
			<?php
				$precios_q = $db->query($query_precios);
				foreach ($precios_q-> fetchAll(PDO::FETCH_NUM) as $row )
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

				echo '<div class="filtro_precio_input"><div class="marca">
					Desde:<br>
						<input type="number" class="input_precio" name="desde" id="desde" step="any" value="desde" onChange="enviarForm()"> <br>
					Hasta:<br>
						<input type="number" class="input_precio" name="hasta" id="hasta" step="any" value="hasta" onChange="enviarForm()"> <br>
					</div><div class="marca_check"><input type="checkbox" name="precios[]" onClick="toggle(this)" value="1" ></div></div>';
			?>
			</div>
			<!-- <input type="submit" value="Buscar"/>  -->
		</form>
	</div>

	
	<div id="contenido" class="contenido_productos">
		Contenido
	<div class="page_fin">
	<?php echo $pages->display_pages(); ?>
	</di>

	</div>

<?php include('pie_pagina.php'); ?>
