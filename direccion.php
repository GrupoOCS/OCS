<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

		<div class="wholeDireccion">
			<table class="carrito">
			 	<form id="formulario" action="#" method="post">

			     <tr>
			     	<td colspan="2" align="center"><h3>Agregar dirección</h3></td>
			     </tr>
			     <tr>
                    <td align="right">Calle:</td>                         
                    <td><input name="calle" class="form-control" placeholder="Calle" ></td>
                </tr>
                <tr>
                   	<td align="right">Número:</td>                         
                    <td><input name="Numero" class="form-control" placeholder="Número" ></td>
                </tr>
                <tr>
                    <td align="right">Colonia:</td>                         
                    <td><input name="Colonia" class="form-control" placeholder="Colonia" ></td>
                </tr>
			    <tr>
			      	<td align="right">Estado: </td>
			      	<td>
			    		<select name="Estado"  class="form-control" >
					        <option value="1">Aguascalientes</option> 
					        <option value="2">Baja California</option> 
					        <option value="3">Baja California Sur</option>
					        <option value="4">Campeche</option> 
					        <option value="5">Coahuila</option> 
					        <option value="6">Colima</option> 
					        <option value="7">Chiapas</option> 
					        <option value="8">Oaxaca</option> 
			      		</select>
			     	</td>
			    </tr>
			    <tr>
			    	<td align="right">Municipio:</td> 
			    	<td>
			      		<select name="Ciudad"  class="form-control" >
					        <option value="1">San José de Gracia</option> 
					        <option value="2">Mexicali</option> 
					        <option value="3">Baja California Sur</option>
					        <option value="4">Campeche</option> 
					        <option value="5">Coahuila</option> 
					        <option value="6">Colima</option> 
					        <option value="7">Chiapas</option> 
					        <option value="8">Oaxaca</option> 
			      		</select>
			      	</td>
			  	</tr>
			  	<tr>
			      	<td align="right">CP:</td>
			      	<td><input  placeholder="Código Postal" class="form-control"  name="CP" type="text" /></td>
			    </tr>
				<tr>
                    <td align="right">Destinatario:</td>                         
                    <td><input name="Colonia" class="form-control" placeholder="Destinatario" ></td>
                </tr>
				<tr>
			     <td></td><td align="right"><input id="campo3"  name="Guardar" class="btn mediano" type="submit" value="Guardar" /></td>
			    </tr>
			    </form>
			</table>
		</div>
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>

