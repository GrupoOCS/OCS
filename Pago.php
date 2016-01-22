<?php include('encabezado.php'); 


?>

<div class="contenido">
	<div class="wholeTipoPago">
		
		
			<p>
			<center>
			<center><h2> Proporciona tu información de pago </h2>
			</center>
			





			<table >
				<tr>
					<th onClick="desplegar('tabla_a_desplegar','estadoT')" align="center">
						<h3>Pago en efectivo<h3>
					</th>
				</tr>

				<tr>
					<td>
						<table  id="tabla_a_desplegar" style="display: none;">		
							<form action="Efectivo.php" method="post" enctype="multipart/form-data">
								<tr>
									<th align="center">
										<h5>CuentaX: 1548-64       CuentaY:65498-5</h5>
									</th>
								</tr>
								<tr>
									<td><label>Autorizacion</label></td>
									<td>	<input type="text" class="form-control" name="autorizacion" Placeholder="numAutorizacion"></td>
								</tr>
								<tr>
									<td>Referencia</td>
									<td><input type="text" class="form-control" name="referencia" PlaceHolder="numReferencia"></td>
								</tr>
								<tr>
									<td>
										<label>Imagen</label>
									</td>
									<td>
										<input type="file"  name="imagen" required>
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="right"><input type="submit" class="btn grande" value="Enviar"></td>
								</tr>
								<tr>
									<td></td>
									<td><h5>Si aun no tiene el comprobante del deposito, puede volver mas tarde, el pedido y la cantidad de pago se guardaran temporalmente hasta que usted pague o cancele el pedido</h5></td>
								</tr>
							</form>
						</table>	

					</td>
				</tr>
			</table>
			
			<center>			
				<table  >
					<tr>
						<td onClick="desplegar('tabla_a_desplegar2','estadoT2')">
							<center>
								<h3>Targeta de débito</h3>		
								<p><IMG SRC="img\baco.jpg"> </p>
							</center>
						</td>
					</tr>
					<tr>
						<td>
							<table  id="tabla_a_desplegar2" style="display: none;">
								<form action="Cuenta.php" method="POST">
								
									 <tr>
									 	<td><label>Nombre del titular de la tarjeta</label></td>
										<td><label><center>Numero de tarjeta </center> </label></td>
										<td><label >Fecha de vencimiento</label></td>
										<td></td>
										<td><label >Código de Seguridad</label></td>				
									</tr>
									<tr>
										<td>	<input type="text" class="form-control" name="titular_targeta" value="MINOMBRE"></td>
										<td>    <input type="text" class="form-control" name="numero_targeta" value="NUMS5445"></td>
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
										</td>
										<td>
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
										</td>
										<td>    <input type="text" class="form-control" name="Codigo_targeta" value="000"></td>
										<td>	
											<input type="submit" class="btn grande" value="Añadir a tu tarjeta">
										</td>
									</tr>
								
								</table>
							</form>
						</td>
					</tr>
				</table>
			</center>
			
			
				
			
					
			</p>
		</div>	
</div>











<?php include('pie_pagina.php'); ?>



<script type="teXt/javascript">
function desplegar(tabla_a_desplegar,estadoT) {
var tablA = document.getElementById(tabla_a_desplegar);
var estadOt = document.getElementById(estadoT);

	switch(tablA.style.display) {
	case "none":
	tablA.style.display = "block";
	estadOt.innerHTML = "Ocultar coneNido"
	break;
		default:
		tablA.style.display = "none";
		estadOt.innerHTML = "Mostrar coNteNido"
		break;
}
}
</script>

