<?php 	include('encabezado.php'); ?>

	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap.min.css"> -->
	<script>
		function addp(val,id_cli,id_pro){

			$.ajax({

				type: "POST",
				url: "modif_carrito.php",
				data: "cantidad_modif="+ val +"&id_c="+ id_cli +"&id_p=" +id_pro,
				success: function(res)
				{	
					location.reload();
				},
				error: function(jqXHR, textStatus, error)
				{
					console.log("no se pudo mover");
				}
			});
		}
	</script>
	<div class="contenido">
		<div class="wholeCarrito">	
			<div class="tabla_descripcion">
				<table class="table table-hover">
					
							<tr >
							<td style="font-weight: bold; text-align: center;" width="15%">Cantidad</td>
							<td style="font-weight: bold; text-align: center;" width="10%">Imagen</td>
							<td style="font-weight: bold; text-align: center;" width="30%">Nombre</td>
							<td style="font-weight: bold; text-align: center;" width="15%">Precio unitario</td>
							<td style="font-weight: bold; text-align: center;" width="20%">Total</td>
							<td style="font-weight: bold; text-align: center;" width="10%"></td>
							</tr>
						
					
							<?php
								// include 'abrirConexion.php';
		                		$db = Conectar();
								$query = "SELECT * FROM  carrito where id_cliente=".$_SESSION['id_usu'];
								$res = $db->query($query);
								$total = 0;
								$iva=0;
								$descuento = 0;
								foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
								{	
									print'<tr class="fondo">';
									$max="SELECT cantidad FROM producto WHERE id='".$row["id_producto"]."'";
									$resmax=$db->query($max);
									foreach ($resmax->fetchAll(PDO::FETCH_ASSOC) as $row2) {
										print "<td style='text-align: center;' class='tabla_carrito' width='100'><input type='number' max='".$row2['cantidad']."' onchange='addp(this.value, ".$_SESSION['id_usu'].", ".$row['id_producto'].")' min='1' value='".$row["cantidad"]."'></td>";
									}
									
									//Falta realizar la consulta de la imagen
									$query3 = "SELECT nombre FROM imagen WHERE id_producto = '".$row["id_producto"]."'";
									$res3 = $db->query($query3);
									foreach($res3->fetchAll(PDO::FETCH_ASSOC) as $row3) 
									{
										print '<td style="text-align: center;" ><img class="imagen_resumen" src="'.$row3["nombre"].'" ></td>';
									}
									$query2 = "SELECT nombre,precio FROM producto WHERE id = '".$row["id_producto"]."'";
									$res2 = $db->query($query2);
									foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $row2) 
									{
										print '<td style="text-align: center;" class="tabla_carrito">'.$row2["nombre"].'</td>';
										print '<td style="text-align: center;" class="tabla_carrito">$ '.$row2["precio"].'.00</td>';
										print '<td style="text-align: center;" class="tabla_carrito">$'.$row["cantidad"] * $row2["precio"].'.00</td>';
										$total += $row["cantidad"] * $row2["precio"];
									
										print '<td style="text-align: center;"><form method="POST" action="elim_carrito.php">
										<input type="hidden" name="id_p" value="'.$row["id_producto"].'">
										<input type="hidden" name="id_c" value="'.$_SESSION['id_usu'].'">
										<button type="submit"><img class="carro_compra" src="tache.png"></button>
										</form></td>';
									}							
									//print "<br>";
									print '</tr>';
									$iva = $total * 0.16;
								}
								

							?>
							
							<!--<td><img class="carro_compra"src="compu.png"></td> -->
				
				</table>
			</div>
			<!-- <div class="tabla_espacio"></div> -->
			<div class="tabla_carrito resumen">
				<table class="carrito">
					<tr>
						<td align="left">Subtotal: </td>
						<td align="right" width="200"><?php echo "$ ".$total.".00" ?></td>
					</tr>
					<tr>
						<td>IVA(16%):</td>
						<td align="right" width="200"><?php echo "$ ".$iva ."0"?></td>
					</tr>
					<tr>
						<td>Descuento (0%):</td>
						<td align="right" width="200"><?php echo "$ ".$total * $descuento .".00"?></td>
					</tr>
					<tr>
						<td>Total: </td>
						<td align="right" width="200"><?php echo "$ ".($total + $iva)."0"?></td>
					</tr>
					<tr>
						<td></td><td align="right">
						<form action="direccion.php">
							<button class="btn mediano" type="submit">Comprar</button>
						</form></td>
					</tr>
				</table>
			</div>
		</div>

	</div>

	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>