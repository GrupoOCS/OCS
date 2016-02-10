<?php 
include('encabezado.php'); 
include_once 'DB.php';
?>
<head>
        <meta charset="UTF-8">
        <script src="js/login.js"></script>   
       
    </head>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

		<div class="wholeRegistro" id="adduser">
			<table width="100%">
				<form id="registrarse">

				    <tr>
				     	<td colspan="3" align="center"><h3 name="#top" id="registro">Registrate</h3></td>

				    </tr>
				    <tr height='35px'>

				      	<td>
	                    	<input id="nombre" class="form-control2" type="text"  placeholder="Nombre" autofocus="" required/ >
	                    	<span class='textleft'>Nombre:</span>
	                    </td>
	                                
	                    <td>
	                    	<input id="apellidoP" type="text" class="form-control2"  placeholder="Apellido  paterno" required/>
	                    	<span class='textleft'>Apellido Paterno: </span>
	                    </td>
					
	                 	<td >
	                   	 	<input id="apellidoM" type="text" class="form-control2" placeholder="Apellido  materno" required/>
	                   	 	<span class='textleft'>Apellido Materno:</span>
	                   	</td>
	                    <!--=============================================================================================-->
	 				</tr>
	 				<tr height='35px'>
	 					<td>
	                   		<input id="correo" type="email" class="form-control2" placeholder="e-mail" required/>
	                   		<span class='textleft'>Correo:</span>
	                 	</td>

	 				</tr>
	 				<tr height='35px'>
	                 	<td > 
	                    	<input id="pass" type="password" class="form-control2"  placeholder="Contraseña" required/>
	                    	<span class='textleft'>Contraseña:</span>
	                    </td>
	 				
	                   	<td>
	                		<input id="repass" type="password" class="form-control2" placeholder="Confirmación" required/>
	                		<span class='textleft'>Confirmación:</span>
	                	</td>
	                </tr>

	                 <tr height='50px'>
	                   <td colspan="3" align="center"><h3>Dirección</h3> </td>
	                </tr>
	                 <tr height='35px'>
		                    <td>                    
								<input id="calle" class="form-control2" placeholder="Calle" type="text"required/>
								<span class='textleft'>Calle:</span>
		                    </td>
		                    <td>                         
			                    <input id="numero" class="form-control2" placeholder="Número" type="number"required/>
			                    <span class='textleft'>Número:</span>
		                    </td>
		                    <td>                       
			                    <input id="colonia" class="form-control2" placeholder="Colonia"type="text" required/>
			                    <span class='textleft'>Colonia:</span>
			                </td>
	                </tr>
	                <tr height='35px'>
				     	<td>
					     	<input class="form-control2"  placeholder="Municipio" id="municipio" type="text" required/>
					     	<span class='textleft'>Municipio:</span>	
				      	</td>
				      	<td>
					     	<input  class="form-control2"  placeholder="Ciudad" id="ciudad" type="text" required/>
					     	<span class='textleft'>Ciudad:</span>	
				      	</td>
				      	<td>
				      		<select id="estado"  class="form-control2" required/>
				      		<?php 
				      		$db = conectar();
							if ( is_null($db) )
								echo "Error al conectar a la db";
							$db->query("SET NAMES utf8");
				      		$consulta = $db->query("SELECT id,nombre FROM estados");
				      		while ($row=$consulta->fetch(PDO::FETCH_NUM))
				      		{
				      		 echo"<option value=".$row[0].">".$row[1]."</option>";
				      		}
				      		?>php
							</select>
							<span class='textleft'>Estado:</span>
				      	
				      	</td>
				  	</tr>
					<tr height='35px'>
					    <td>
					      	<input  class="form-control2"  placeholder="Código Postal" id="cp" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
							minlength="5" maxlength="5" required/>
							<span class='textleft'>CP:</span>
						</td>
						 <td>
					        <input  class="form-control2" maxlength="10" minlength="10" placeholder="Teléfono" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" id="telefono" type="text" required/>
					        <span class='textleft'>Tel&eacutefono:</span>
				        </td>
				    </tr>
					<tr height='70px'>
				    	<td align="center" colspan="3"><input id="campo3"  id="Guardar" class="btn mediano" type="submit" value="Guardar"/></td>
				    </tr>
				</form>

			</table>
		</div>
	</div>
	<!--................................................................. -->


<?php include('pie_pagina.php'); ?>