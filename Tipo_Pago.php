
<?php include('encabezado.php'); ?>

<div class="contenido">
	<div class="wholeTipoPago">
		
		<form action="Cuenta.php" method="POST">
			<p>
			<center>
			<center><h2>Seleccione un metodo de pago </h2></center>
		<p><h5>aceptamos X tipos de tarjetas</h5></p>
				<table class="carrito">
					<tr>
						<td><label>Nombre del titular de la tarjeta</label></td>
						<td><label><center>Numero de tarjeta </center> </label></td>
						<td><label >Fecha de vencimiento</label></td>
					</tr>
					<tr>
						<td>	<input type="text" class="form-control" name="titular_targeta" value="MINOMBRE"></td>
						<td><input type="text" class="form-control" name="numero_targeta" value="NUMS5445"></td>
						<td>
							<select id="mes" class="form-control" name="mes">
								<option value="1">01</option>
								<option value="2">02</option>
								<option value="3">03</option>
								<option value="4">04</option>
								<option value="5">05</option>
								<option value="6">06</option>
								<option value="7">07</option>
								<option value="8">08</option>
								<option value="9">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>

							<select id="anio" class="form-control" name="anio">
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
							</select>
							
							<input type="submit" class="btn grande" value="Añadir a tu tarjeta"
						</td>
					</tr>
				
				</table>
				
			</center>
					
			</p>
		</div>	
</div>
<?php include('pie_pagina.php'); ?>


