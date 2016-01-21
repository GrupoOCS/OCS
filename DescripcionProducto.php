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

<?php
	$id = $_GET['id'];
	$db = Conectar();

	$query = "select producto.id, producto.nombre, producto.descripcion, producto.precio, producto.marca, subcategoria.nombre, subcategoria.id from producto, subcategoria where producto.id=".$id." and subcategoria.id=producto.id_subcategoria;";
	$res = $db->query($query);


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
			            for ($i=0; $i<$n; $i++){
			              if ($i==0) printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"0\"  class=\"active\"></li>");
			              else printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"%s\"></li>", $i);
			            }
			          ?>
			        </ol>

			        <!-- Wrapper for slides -->
			        <div class="carousel-inner" role="listbox">

			        <?php			          
			          $i=1;
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
			<fieldset class="field">
			<!-- <form> -->
			<label style="position:relative; height:25%; padding:4%; float:left; width:42%;">
				Cantidad:</label>
			<input id="num" name="cantidad" value="1" style=" position:relative; float:left; width:50%" type="number" class="form-control" min="1">
			
			<?php
			printf ("<a href=\"#\" onClick=\"insertarCarrito(".$_SESSION['id_usu'].",".$id.",num.value);\"><img class=\"b_add_car\" src=\"Iconos/bagregar.png\"></a>");
			?>
		<!-- </form> -->
		</fieldset>
		</div>
	</div>
	<?php } ?>
	</div>

</div>
<?php include('pie_pagina.php'); ?>


