<?php include('encabezado.php'); 


	print'  <div class="contenido"> 
				<div align="center">
				<center><p colspan="2" ><h2>Agregar dirección de envio</h2></p></center>	
			<table class="carrito"> 
			 	<form id="formulari" >
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
			    	<td align="right">Municipio:</td> 
			    	<td>
			      		<input type="text" class="form-control" name="municipio" >
			      	</td>
			  	</tr>
			  	<tr>
			    	<td align="right">Ciudad:</td> 
			    	<td>
			      		<input type="text" class="form-control" name="ciudad" >
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
			      		<input type="text" class="form-control" name="tel" >
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
                <tr style="padding:50px;">
                <td colspan="3"> &nbsp; </td>
                </tr>
                
				<tr>
			     <td></td ><td rowspan="2" align="right"><button name="Guardar" onclick="guarda(calle.value,numero.value,colonia.value,estado.value,municipio.value,cp.value,destinatario.value,tel.value,ciudad.value)" class="btn mediano" > Guardar </button></td>
			     
				<td rowspan="2" style="padding:10px;"  ><button class="btn mediano" onclick=this.form.action="pago.php"> Continuar </button></td>				
			    </tr>
			    </form>
			    <tr>
			    <td> 
			    <form action="direccion.php">
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
function guarda(calle,num,col,est,mun,cp,dest,tel,ciudad)
{
	$.ajax({

				type: "POST",
				url: "guardaNuevaDirec.php",
				data: "calle="+ calle +"&num="+ num +"&col=" +col +"&est=" +est +"&mun=" +mun+"&cp=" +cp+"&dest=" +dest+"&tel=" +tel+"&ciudad=" +ciudad,
				success: function(res)
				{	
					
					window.location.href = 'direccion.php';
				},
				error: function(jqXHR, textStatus, error)
				{
					console.log("no se pudo mover");
				}
			});

}

</script>