<?php include('encabezado.php'); 

echo $_POST["calle"];
echo $_POST["numero"];
echo $_POST["colonia"];
echo $_POST["estado"];
echo $_POST["municipio"];
echo $_POST["cp"];
echo $_POST["destinatario"];

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
						<h3>Pago en Ventanilla<h3>
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
									<td>	<input type="text" class="form-control" name="autorizacion" minlength="6" maxlength="6" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" Placeholder="numAutorizacion"></td>
								</tr>
								<tr>
									<td>Referencia</td>
									<td><input type="text" class="form-control" name="referencia" minlength="20" maxlength="30" PlaceHolder="numReferencia" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"></td>
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
								<h3>Pago con Tarjeta</h3>		
								<p><IMG SRC="img\baco.jpg"> </p>
							</center>
						</td>
					</tr>
					<tr>
						<td>
							<center><table  id="tabla_a_desplegar2"   style="display: none;">
								<form action="Cuenta.php" method="POST">
								
									
									
										<tr>
											<td><label>Nombre del titular de la tarjeta: </label></td>
											<td>	<input type="text" class="form-control" minlength="10"  maxlength="10" pattern="[a-zA-Z ]" name="titular_tarjeta" placeholder="Nombre"></td>
										
										</tr>
										<tr>
											<td><label><center>Número de tarjeta: </center> </label></td>
											<td>    <input type="text" id="ccNo" minlength="16"  maxlength="16" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" title="Teclee los 16 digitos de su tarjeta" class="form-control" name="numero_tarjeta" placeholder="Numero de tarjeta"></td>
										
											</tr>
										<tr>
												<td><label >Mes de Vencimiento: </label></td>
										<td>
											<select  id="expMonth" class="form-control" name="mes">
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</td>
									</tr>
										<tr>
											<td><label >Año de Vencimiento: </label></td>
											<td>
											<select  id="expYear" class="form-control" name="anio">
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
									</tr>
										<tr>
											<td><label >Código de Seguridad: </label></td>
										<td><input id="cvv" type="text" class="form-control"  minlength="3"  maxlength="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" autocomplete="off" name="Codigo_tarjeta" placeholder="000" pattern="[0-9]{3}" title="teclea el número de seguridad de tu tarjeta. Son 3 digitos"></td>
										</tr>
										<tr >
											<td colspan="2" align="center">	
											<input type="submit" class="btn grande" value="Finalizar compra">
										</td>
									</tr>
									
								
								</table></center>
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

