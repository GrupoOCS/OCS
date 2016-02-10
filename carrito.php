<?php 	include('encabezado.php'); ?>

	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap.min.css"> -->
	<script>
		function addp(val,id_cli,id_pro){
			console.log(val);
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

			<?php
        		$db = Conectar();
				$query = "SELECT * FROM  carrito where id_cliente=".$_SESSION['id_usu'];
				$res = $db->query($query);
				$total = 0;
				$iva=0;
				$descuento = 0;
				if($res->rowCount()<=0){ 

						
						header('location:ventas.php?NP=si'); }
				foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	

					$query2 = "SELECT nombre,precio FROM producto WHERE id = '".$row["id_producto"]."'";
					$res2 = $db->query($query2);
					foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $row2)
						$total += $row["cantidad"] * $row2["precio"];
					$iva = $total * 0.16;
				}
			?>

			<div class="tabla_carrito resumen">
				<center><table class="carrito">
					<tr>
						<td align="left">Subtotal: </td>

						 
						
						<td align="right" width="200">$<?php echo number_format(round($total,2), 2); ?></td>
					</tr>
					<tr>
						<td>IVA(16%):</td>
						<td align="right" width="200">$<?php echo number_format(round($iva,2), 2);?></td>
					</tr>
					<tr>
						<td>Descuento (0%):</td>
						<td align="right" width="200">$<?php echo number_format(round($total*$descuento,2), 2);?></td>
					</tr>
					<tr>
						<td>Total: </td>
						<td align="right" width="200">$<?php echo number_format(round($total+$iva,2), 2);?></td>
					</tr>
					<tr>
						<td></td><td align="right">
						<form action="direccion.php">
							<button class="btn mediano" type="submit" <?php if($res->rowCount()<=0){ echo "disabled"; }?>>Comprar</button>
						</form></td>
					</tr>
				</table></center>
			</div>




			<div class="tabla_descripcion">
				<table class="table table-hover">
					
							<tr style="background-color: #1abc9c;" >
							<td style="font-weight: bold; text-align: center;" width="15%">Cantidad</td>
							<td style="font-weight: bold; text-align: center;" width="10%">Imagen</td>
							<td style="font-weight: bold; text-align: center;" width="30%">Nombre</td>
							<td style="font-weight: bold; text-align: center;" width="15%">Precio unitario</td>
							<td style="font-weight: bold; text-align: center;" width="20%">Total</td>
							<td style="font-weight: bold; text-align: center;" width="10%"></td>
							</tr>
						
					
							<?php
								// include 'abrirConexion.php';
								$query = "SELECT * FROM  carrito where id_cliente=".$_SESSION['id_usu'];
								$res = $db->query($query);
								foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
								{	
									print'<tr class="fondo">';
									$max="SELECT cantidad FROM producto WHERE id='".$row["id_producto"]."'";
									$resmax=$db->query($max);
									foreach ($resmax->fetchAll(PDO::FETCH_ASSOC) as $row2) {
										$max = $row2['cantidad'];
									}
									?>
									<td style="text-align: center;	vertical-align: middle;">
										<?php print "<select id='num' onchange='addp(this.value, ".$_SESSION['id_usu'].", ".$row['id_producto'].")'>"; ?>
										<?php for ($i=1; $i <=$max; $i++) { ?>
											<option value="<?php echo $i ?>" <?php if($i==$row["cantidad"]) echo "selected"?>><?php echo $i ?></option>
										<?php } ?>
										</select>
									</td>
									
									<?php
									//Falta realizar la consulta de la imagen
									$query3 = "SELECT nombre FROM imagen WHERE id_producto = '".$row["id_producto"]."' limit 1";
									$res3 = $db->query($query3);
									foreach($res3->fetchAll(PDO::FETCH_ASSOC) as $row3) 
									{
										print '<td style="vertical-align: middle;text-align: center;" ><a href="DescripcionProducto.php?id='.$row["id_producto"].'"><img class="imagen_resumen" src="'.$row3["nombre"].'" ></a></td>';
									}
									$query2 = "SELECT nombre,precio FROM producto WHERE id = '".$row["id_producto"]."'";
									$res2 = $db->query($query2);
									foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $row2) 
									{
										print '<td style="vertical-align: middle;text-align: center;" class="tabla_carrito">'.$row2["nombre"].'</td>';
										print '<td style="vertical-align: middle;text-align: center;" class="tabla_carrito">$ '.$row2["precio"].'.00</td>';
										print '<td style="vertical-align: middle;text-align: center;" class="tabla_carrito">$'.$row["cantidad"] * $row2["precio"].'.00</td>';
									
										print '<td style="vertical-align: middle;text-align: center;"><form method="POST" action="elim_carrito.php">
										<input type="hidden" name="id_p" value="'.$row["id_producto"].'">
										<input type="hidden" name="id_c" value="'.$_SESSION['id_usu'].'">
										<button type="submit"><img class="carro_compra" src="tache.png"></button>
										</form></td>';
									}							
									//print "<br>";
									print '</tr>';
								}
								

							?>
							
							<!--<td><img class="carro_compra"src="compu.png"></td> -->
				
				</table>
			</div>

			<!-- <div class="tabla_espacio"></div> -->
		</div>

	</div>


	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>