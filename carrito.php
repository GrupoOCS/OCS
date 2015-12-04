<?php 	include('encabezado.php'); ?>

	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<div class="contenido">
		<div class="wholeCarrito">	
			<div class="tabla_descripcion">
				<table class="table table-hover">
					<thead>
						<tr class="tabla_carrito">
							<th>Cantidad</th>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Precio unitario</th>
							<th>Total</th>
							<!--<th>Eliminar</th>-->
						</tr>
					</thead>
					<tbody>
							<?php
								include 'abrirConexion.php';
		                		$db = Conectar();
								$query = "SELECT * FROM  carrito";
								$res = $db->query($query);
								$total = 0;
								$iva=0;
								$descuento = 0;
								foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
								{
									print'<tr class="fondo">';
									print '<td class="tabla_carrito"><input type="number" min="1" value="'.$row["cantidad"].'"></td>';
									//Falta realizar la consulta de la imagen
									$query3 = "SELECT nombre FROM imagen WHERE id_producto = '".$row["id_producto"]."'";
									$res3 = $db->query($query3);
									foreach($res3->fetchAll(PDO::FETCH_ASSOC) as $row3) 
									{
										print '<td class="tabla_carrito"><img class="imagen_resumen" src="'.$row3["nombre"].'" ></td>';
									}
									$query2 = "SELECT nombre,precio FROM producto WHERE id = '".$row["id_producto"]."'";
									$res2 = $db->query($query2);
									foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $row2) 
									{
										print '<td class="tabla_carrito">'.$row2["nombre"].'</td>';
										print '<td class="tabla_carrito">$ '.$row2["precio"].'.00</td>';
										print '<td class="tabla_carrito">$'.$row["cantidad"] * $row2["precio"].'.00</td>';
										$total += $row["cantidad"] * $row2["precio"];
									}							
									//print "<br>";
									print '</tr>';
									$iva = $total * 0.16;
								}
								
								//print '<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>';
							?>
							
							<!--<td><img class="carro_compra"src="compu.png"></td> -->
					</tbody>
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
						<td></td><td align="right"><button class="btn mediano" type="submit">Comprar</button></td>
					</tr>
				</table>
			</div>
		</div>

	</div>

	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>