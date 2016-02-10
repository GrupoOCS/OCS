<?php include('encabezado.php'); 


	print'  <div class="contenido"> 
				<div align="center">
				<p class="alert alert-danger" align="center">Al dar clic en <b>Continuar</b> su pedido quedará registrado</p>
				<center><p colspan="2" ><h2>Dirección de envio</h2></p></center>
				
			<table class="carrito"> 
			 	<form id="formulari">
                    <td align="right">Calle:</td>                         
                    <td><input name="calle" class="form-control" placeholder="Calle"  maxlength="25" onKeypress="soloLetras()" required></td>
                </tr>
                <tr>
                   	<td align="right">Número:</td>                         
                    <td><input name="numero" class="form-control" placeholder="Número" maxlength="5" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required></td>
                </tr>
                <tr>
                    <td align="right">Colonia:</td>                         
                    <td><input name="colonia" class="form-control" placeholder="Colonia" maxlength="30" onKeypress="soloLetras()" required></td>
                </tr>
                <tr>
			    	<td align="right">Municipio:</td> 
			    	<td>
			      		<input type="text" class="form-control" name="municipio" maxlength="50" onKeypress="soloLetras()" required>
			      	</td>
			  	</tr>
			  	<tr>
			    	<td align="right">Ciudad:</td> 
			    	<td>
			      		<input type="text" class="form-control" name="ciudad" maxlength="30" onKeypress="soloLetras()" required>
			      	</td>
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
			    	<td align="right">Telefono:</td> 
			    	<td>
			      		<input type="text" class="form-control" name="tel" maxlength="10" minlength="10" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
			      	</td>
			  	</tr>
			  	<tr>
			      	<td align="right">CP:</td>
			      	<td><input  placeholder="Código Postal" class="form-control"  name="cp" type="text" maxlength="5" minlength="5" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" /></td>
			    </tr>
				<tr>
                    <td align="right">Destinatario:</td>                         
                    <td><input name="destinatario" class="form-control" placeholder="Destinatario" onKeypress="soloLetras()"required></td>
                </tr>
                <tr style="padding:50px;">
                <td colspan="3"> &nbsp; </td>
                </tr>
                
				<tr>
			     <td></td ><td rowspan="2" align="right"><button name="Guardar" onclick=this.form.action="guardaNuevaDirec.php" class="btn grande" > Guardar y continuar</button></td>
			     
				<td rowspan="2" style="padding:10px;"  ><button class="btn grande" onclick=this.form.action="pago2.php">Continuar compra</button></td>				
			    </tr>
			    </form>
			    <tr>
			    <td> 
			    <form action="direccion.php?conti=si">
				<center><input type="submit" class="btn mediano cancelar" value="Cancelar"> </center>
				</form>
			    </td>

			    <td>
			   
			    </td>
			    </tr>
			</table>
				</div>
				
				</div>
		
		';


 include('pie_pagina.php'); 

?>
<script type="text/javascript">

function soloLetras() {
 	if ((event.keyCode != 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122))
  	event.returnValue = false;
}
</script>