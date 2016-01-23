
<?php include('encabezado.php'); 


	print'  <div class="contenido"> 
				<div align="center">
				<center><p colspan="2" ><h2>Agregar dirección de envio</h2></p></center>	
			<table class="carrito">
			 	<form id="formulari" action="pago.php" method="post">
                    <td align="right">Calle:</td>                         
                    <td><input name="calle" class="form-control" placeholder="Calle" ></td>
                </tr>
                <tr>
                   	<td align="right">Número:</td>                         
                    <td><input name="numero" class="form-control" placeholder="Número" ></td>
                </tr>
                <tr>
                    <td align="right">Colonia:</td>                         
                    <td><input name="colonia" class="form-control" placeholder="Colonia" ></td>
                </tr>
			    <tr>
			      	<td align="right">Estado: </td>
			      	<td>
			    		<select name="estado"  class="form-control" >
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
			      		<select name="municipio"  class="form-control" >
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
			      	<td><input  placeholder="Código Postal" class="form-control"  name="cp" type="text" /></td>
			    </tr>
				<tr>
                    <td align="right">Destinatario:</td>                         
                    <td><input name="destinatario" class="form-control" placeholder="Destinatario" ></td>
                </tr>

                
				<tr>
			     <td></td ><td rowspan="2" align="right"><input 	  name="Guardar" class="btn mediano" type="submit" value="Guardar" /></td>
			    </tr>
			    </form>
			    <tr>
			    <td> 
			    <form action="direccion.php">
				<center><input type="submit" class="btn mediano cancelar" value="cancelar"> </center>
				</form>
			    </td>
			    <td></td>
			    </tr>
			</table>
				</div>
				
				</div>
		
		';


 include('pie_pagina.php'); 

?>
