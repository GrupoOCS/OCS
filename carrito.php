<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

	
		<div class="wholeCarrito">	
			<div class="tabla_descripcion" >
				<table class="carrito" border="0" align="center">
					<thead>
						<tr>
							<th>Cantidad</th>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Precio unitario</th>
							<th>Total</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody class="fondo">
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="compu.png"></td>
							<td>LAPTOP ASUS AUX305FA-XSU1T1 QHD NEGRO</td>
							<td>$ 17 549.00</td>
							<td>$ 17 549.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/6lap.jpg"></td>
							<td>COMPUTADORA PORTATIL</td>
							<td>$ 13 543.00</td>
							<td>$ 13 543.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/1imp.jpg"></td>
							<td>IMPRESORA A COLOR</td>
							<td>$ 3, 754.00</td>
							<td>$ 3, 754.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/2acces.jpg"></td>
							<td>AUDIFONOS PARA PC</td>
							<td>$ 540.00</td>
							<td>$ 540.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/2alm.jpg"></td>
							<td>MEMORIA USB DE 32 GB</td>
							<td>$ 250.00</td>
							<td>$ 250.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>	
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/5acces.jpg"></td>
							<td>MOUSE INALAMBRICO</td>
							<td>$ 320.00</td>
							<td width="100">$ 320.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/6acces.jpg"></td>
							<td>AUDIFONOS PARA CELULAR</td>
							<td>$ 290.00</td>
							<td>$ 290.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>	
						<tr class="fondo">
							<td><input type="number" value="1"></td>
							<td><img class="carro_compra"src="Productos/6imp.jpg"></td>
							<td>IMPRESORA LASER</td>
							<td>$ 890.00</td>
							<td>$ 890.00</td>
							<td><button type="submit"><img class="carro_compra" src="eliminar.png"></button></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="tabla_carrito resumen">
				<table class="carrito" border="0">
					<tr>
						<td align="left">Subtotal: </td>
						<td align="right" width="150">$ 103, 000.00</td>
					</tr>
					<tr>
						<td>IVA(16%):</td>
						<td align="right" width="150">$7,873.00</td>
					</tr>
					<tr>
						<td>Descuento:</td>
						<td align="right" width="150">$ 123, 000.00</td>
					</tr>
					<tr>
						<td>Total: </td>
						<td align="right" width="150">$ 123, 000.00</td>
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