<?php 
include('encabezado.php'); ?>
<head>
        <meta charset="UTF-8">
        <script src="js/login.js"></script>   
       
    </head>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

		<div class="wholeRegistro" id="adduser">
			<table class="carrito">
				<form id="registrarse">

				    <tr>
				     	<td colspan="2" align="center"><h3>Registrate</h3></td>

				    </tr>
				    <tr>

				      	<td align="right">Nombre:</td>
	                    <td><input id="nombre" class="form-control" type="text"  placeholder="Nombre" autofocus="" required/ ></td>
	                </tr>
	                <tr>                  
	                    <td align="right">Apellido Paterno:</td> 
	                    <td> <input id="apellidoP" type="text" class="form-control"  placeholder="Apellido  paterno" required/></td>
	                </tr>
					<tr>
	                 	<td align="right">Apellido Materno:</td>
	                    <td><input id="apellidoM" type="text" class="form-control" placeholder="Apellido  materno" required/></td>
	                    <!--=============================================================================================-->
	 				</tr>
	 				<tr>
	                    <td align="right">Correo:</td>
	                    <td> <input id="correo" type="text" class="form-control" placeholder="e-mail" required/></td>
	 				</tr>
	 				<tr>
	                 	<td align="right">Contraseña:</td> 
	                    <td> <input id="pass" type="password" class="form-control"  placeholder="Contraseña" required/></td>
	 				</tr>
	 				<tr>
	                   	<td align="right">Confirmación:</td>
	                	<td><input id="repass" type="password" class="form-control" placeholder="Confirmación" required/></td>
	                </tr>
	                 <tr>
	                   <td colspan="2" align="center"><h3>Dirección</h3> </td>
	                </tr>
	                 <tr>
	                    <td align="right">Calle:</td>                         
	                    <td><input id="calle" class="form-control" placeholder="Calle" required/></td>
	                </tr>
	                <tr>
	                    <td align="right">Número:</td>                         
	                    <td><input id="numero" class="form-control" placeholder="Número" required/></td>
	                </tr>
	                             
	               	<tr>
	                    <td align="right">Colonia:</td>                         
	                    <td><input id="colonia" class="form-control" placeholder="Colonia" required/></td>
	                </tr>
				    <tr>
				     	<td align="right">Estado: </td>
				      	<td>
				      		<select id="estado"  class="form-control" required/>
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
				     	<td align="right">Ciudad:</td> 
				     	<td>
				     	<input  class="form-control"  placeholder="Ciudad" id="ciudad" type="text" required/>	
				      	</td>
				  	</tr>
				  	 <tr>
				     	<td align="right">Municipio:</td> 
				     	<td>
				     	<input class="form-control"  placeholder="Municipio" id="municipio" type="text" required/>	
				      	</td>
				  	</tr>
				  	<tr>
				      	<td align="right">CP:</td>
				      	<td><input  class="form-control"  placeholder="Código Postal" id="cp" type="text" required/></td>
				    </tr>
				    	<tr>
				      	<td align="right">Tel&eacutefono:</td>
				      	<td><input  class="form-control"  placeholder="Teléfono" id="telefono" type="text" required/></td>
				    </tr>
					<tr>
				    	<td></td><td align="right"><input id="campo3"  id="Guardar" class="btn mediano" type="submit" value="Guardar" /></td>
				    </tr>
				</form>
			</table>
		</div>
	</div>
	<!--................................................................. -->


<?php include('pie_pagina.php'); ?>