<?php include('encabezado.php'); ?>
<div class="contenido">
	<div class="wholeDireccionEnvio">
		<center><h3>Introdusca la dirección de envio </h3></center>
		<form action="Tipo_Pago.php" method="POST">
			<p>
				
				<table align="center">
					<tr>
						<td><label>Destinatario</label></td>
						<td><input type="text" name="destinatario" class="form-control" value="MINOMBRE"></td>
					</tr>
					<tr>
						<td><label>Calle</label></td>
						<td><input type="text" name="calle" class="form-control" value="SNS"></td>
					</tr>
					<tr>
						<td><label>Colonia</label></td>
						<td><input type="text" name="colonia" class="form-control" value="MICOLONIA"></td>
					</tr>
					<tr>
						<td><label>Municipio</label></td>
						<td><input type="text" name="municipio" class="form-control" value="MSKD"></td>
					</tr>
					<tr>
						<td><label>Ciudad</label></td>
						<td><input type="text" name="ciudad"  class="form-control" value="MiCiudad"></td>
					</tr>
					<tr>
						<td><label>Código Postal</label></td>
						<td><input type="text" name="cp" class="form-control" value="654321"></td>
					</tr>
					<tr>
						<td><label>Telefono</label></td>
						<td><input type="text" name="telefono"  class="form-control" value="2225151525"><br></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="btn	mediano" value="Continuar"</td>
					</tr>	
				</table>
				
				
							
			</p>
	</div>
</div>
<?php include('pie_pagina.php'); ?>


