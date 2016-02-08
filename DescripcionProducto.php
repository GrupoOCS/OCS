<?php 

	
	include('encabezado.php'); 

	?>
	<script type="text/javascript">
	var cantidadGlobal=0;
		function insertarCarrito ( idCliente,idProducto, cantidad ) {
			var xmlhttp;
			if ( window.XMLHttpRequest ){
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function (){
				if ( xmlhttp.readyState ==4 && xmlhttp.status==200 ){
					//document.getElementById('carrito').innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","insertCarrito.php?idc="+idCliente+"&idp="+idProducto+"&n="+cantidad, true);
			xmlhttp.send();

			var agregado=document.getElementById('anuncio');
			agregado.innerHTML = "<p class=\"alert alert-success\"> Se ha(n) agregado "+cantidad+" producto(s) </p>";

			
			setTimeout(function(){javascript:location.reload();},500);
		}
	</script>

<?php

	$id = $_GET['id'];
	$db = Conectar();

	$query = "select producto.id, producto.nombre, producto.descripcion, producto.precio, producto.marca, subcategoria.nombre, subcategoria.id from producto, subcategoria where producto.id=".$id." and subcategoria.id=producto.id_subcategoria;";
	$res = $db->query($query);

	if ($_SESSION['nom_usu']){
		$res2 = "select producto.cantidad as cantidad_producto,carrito.cantidad as cantidad_carrito FROM producto,carrito WHERE producto.id=".$id." and carrito.id_cliente=".$_SESSION['id_usu']." and carrito.id_producto=".$id;
		$max_res2 = $db->query($res2);
		if($max_res2->rowCount() > 0){			
			foreach ($max_res2->fetchAll(PDO::FETCH_ASSOC) as $value) {
				$max=$value["cantidad_producto"]-$value["cantidad_carrito"];
			}
		}else{	
			$res3 = "select cantidad FROM producto WHERE producto.id=".$id;
			$max_res3 = $db->query($res3);
			foreach ($max_res3->fetchAll(PDO::FETCH_ASSOC) as $value) {
				$max=$value["cantidad"];
			}
		}
	}

	
	echo '<div class="contenido">';

		foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
			echo '<div class="desc-imagen">'; 
				// Carusel de imagenes
			?>
			
			
			<div class="btn-group-vertical" role="group" aria-label="...">
			  </div>
			    <div class="row">
			      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			          <!-- Indicators -->
			        <ol class="carousel-indicators">
			          <?php
			          	$query = "select imagen.nombre from imagen where imagen.id_producto=".$_GET['id'].";";
			          	$resimg = $db->query( $query );
			            $n=$resimg->rowCount();
			            // for ($i=0; $i<$n; $i++){
			            $i=0;
			            foreach ($resimg-> fetchAll(PDO::FETCH_NUM) as $r ){
			              if ($i==0) printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"0\"  class=\"active\"><img  src=\"%s\" /></li>",$r[0]);
			              else printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"%s\"><img  src=\"%s\" /></li>", $i, $r[0]);
			              $i++;
			            }
			          ?>
			        </ol>

			        <!-- Wrapper for slides -->
			        <div class="carousel-inner" role="listbox">
			        <?php			          
			          $i=1;
			          $resimg = $db->query( $query );
			          foreach ($resimg-> fetchAll(PDO::FETCH_NUM) as $r ){
			              if ($i==1){
			              	print('<div class="item active">');
			                printf('<center><img  src="%s" /></center></div>', $r[0]);
			              } else {
			                print('<div class="item">');
			                printf('<center><img  src="%s"/></center></div>',$r[0]);
			              }
			              $i=$i+1;
			          }
			        ?>

			        </div>

			        <!-- Controls -->
			        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			        <span class="sr-only">Prev</span>
			        </a>
			        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			        <span class="sr-only">Next</span>
			        </a>
			    </div>
			</div>	

			<?php
				// echo '<img style="width:100%; height:100%;" src="'.$row[1].'">';
			echo '</div>';
			echo'<div id="anuncio"></div>';
			echo '<div class="desc-texto">';
			echo'	<h3><center>'.$row[1].'</center></h3>
				<!-- <div style="color:green; text-align:center;"> Disponible  : 50</div> -->
				<p class="texto-descripcion">'.nl2br(/*htmlentities(*/$row[2])/*))*/.'</p>';

			echo '<table class="describe">
				<tr><td>Precio:</td><td> $'.$row[3].' </td></tr>
				<tr><td>Marca:</td><td> '.$row[4].' </td></tr>';

				$cat = $db->query("select categoria.nombre from categoria,subcategoria where categoria.id=subcategoria.idcategoria and subcategoria.id=".$row[6]." limit 1;");
				foreach ($cat-> fetchAll(PDO::FETCH_NUM) as $row1 )
					echo '	<tr><td>Categoria:</td><td> '.$row1[0].' </td></tr>';
			echo '	<tr><td>Subcategoria:</td><td> '.$row[5].' </td></tr>
			</table>';

			// echo '</div>';
        }

?>
	
	<?php
	if ($_SESSION['nom_usu']){
	?>
	<div class="desc-agregar">
		<div class="d-cantidad">
			<!-- <fieldset class="field"> -->
				<!-- <form> -->
				<label style="position:relative; height:25%; padding:4%; float:left; width:42%;">
					Cantidad:</label>
				<select id="num" >
					<?php 
						for ($i=1; $i <=$max; $i++) { 
							print '<option value='.$i.'>'.$i.'</option>';
						}
					?>
				</select>
				<!-- <input id="num" name="cantidad" value="1" style=" position:relative; float:left; width:50%" type="number" class="form-control" min="1"> -->
		</div>
		<div class="d-agrega">
				<?php
				// printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$id.",num.value);\"><img class=\"b_add_car\" src=\"Iconos/bagregar.png\"></a>");
				printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$id.",num.value);\"><input type=\"submit\" class=\"btn-buscar\" value=\"Agregar al carrito\"></a>");
				?>
			<!-- </form> -->
			<!-- </fieldset> -->
		</div>
	</div>
	<?php } ?>
	</div>

</div>

<?php include('pie_pagina.php'); ?>


