<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

		<div class="wholeRegistro">
			<table class="carrito">
				<form id="formulario" action="#" method="post">

				    <tr>
				     	<td colspan="2" align="center"><h3>Registrate</h3></td>

				    </tr>
				    <tr>

				      	<td align="right">Nombre:</td>
	                    <td><input name="nombre" class="form-control" type="text"  placeholder="Nombre" autofocus=""></td>
	                </tr>
	                <tr>                  
	                    <td align="right">Apellido Paterno:</td> 
	                    <td> <input name="apellidos" type="text" class="form-control"  placeholder="Apellido  paterno" ></td>
	                </tr>
					<tr>
	                 	<td align="right">Apellido Materno:</td>
	                    <td><input name="apellidos" type="text" class="form-control" placeholder="Apellido  materno" ></td>
	                    <!--=============================================================================================-->
	 				</tr>
	 				<tr>
	                    <td align="right">Correo:</td>
	                    <td> <input name="correo" type="text" class="form-control" placeholder="e-mail" ></td>
	 				</tr>
	 				<tr>
	                 	<td align="right">Contraseña:</td> 
	                    <td> <input name="pass" type="password" class="form-control"  placeholder="Contraseña"/ ></td>
	 				</tr>
	 				<tr>
	                   	<td align="right">Confirmación:</td>
	                	<td><input name="repass" type="password" class="form-control" placeholder="Confirmación" /></td>
	                </tr>
	                 <tr>
	                   <td colspan="2" align="center"><h3>Dirección</h3> </td>
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
				      	<td><input id="CP" class="form-control"  placeholder="Código Postal" name="CP" type="text" /></td>
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