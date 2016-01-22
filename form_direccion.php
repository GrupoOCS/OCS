<?php   
$tipo=$_POST["tipo"];
$id_cliente=$_POST["id_c"];

if(isset($_POST["tipo"]) && ($_POST["tipo"])=="nueva")
{
	print'  <center><p colspan="2" ><h2>Agregar dirección de envio</h2></p></center>	
			<table class="carrito">
			 	<form id="formulari" action="pago.php" method="post">
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
			     <td></td><td align="right"><input 	  name="Guardar" class="btn mediano" type="submit" value="Guardar" /></td>
			    </tr>
			    </form>
			</table>
		
		';
}
else
{		include ('abrirConexion.php');
		$db = Conectar();
		$query = $db->prepare("");
	$prod = $db->query("SELECT * FROM direccion where id_cliente=".$id_cliente);
	$prod->execute();
	foreach($prod->fetchAll(PDO::FETCH_ASSOC) as $row)
		{	
			print'<center><p colspan="2" ><h2>Agregar dirección de envio</h2></p></center>	
			<table class="carrito">
			 	<form id="formulario" action="pago.php" method="post">
                    <td align="right">Calle y Número:</td>                         
                    <td><input name="calle" class="form-control" placeholder="Calle" value="'.$row["calle"].'" ></td>
                </tr>
               
                <tr>
                    <td align="right">Colonia:</td>                         
                    <td><input name="Colonia" class="form-control" placeholder="Colonia" value="'.$row["colonia"].'"></td>
                </tr>
			    <tr>
			      	<td align="right">Estado: </td>
			      	<td>
			    		<select name="Estado"  class="form-control" >'; ?>

					        <option <?php if($row["id_estado"]==1 )echo "selected";?> value="1">Aguascalientes</option> 
					        <option <?php if($row["id_estado"]==2 )echo "selected";?> value="2">Baja California</option> 
					        <option <?php if($row["id_estado"]==3 )echo "selected";?> value="3">Baja California Sur</option>
					        <option <?php if($row["id_estado"]==4 )echo "selected";?> value="4">Campeche</option> 
					        <option <?php if($row["id_estado"]==5 )echo "selected";?> value="5">Coahuila</option> 
					        <option <?php if($row["id_estado"]==6 )echo "selected";?> value="6">Colima</option> 
					        <option <?php if($row["id_estado"]==7 )echo "selected";?> value="7">Chiapas</option> 
					        <option <?php if($row["id_estado"]==8 )echo "selected";?> value="8">Oaxaca</option> 
			      		</select>
			     </td>
			    </tr>
			    <?php print' <tr>
			    	<td align="right">Municipio:</td> 
			    	<td>
			      			<input name="Municipio" class="form-control" placeholder="Municipio" value="'.$row["municipio"].'">
			      	</td>
			  	</tr>
			 	<tr>
			      	<td align="right">CP:</td>
			      	<td><input  placeholder="Código Postal" class="form-control"  name="CP" type="text" value="'.$row["cp"].'" /></td>
			    </tr>
				<tr>
                    <td align="right">Destinatario:</td>                         
                    <td><input name="destinatario" class="form-control" placeholder="Destinatario" value="'.$row["destinatario"].'"></td>
                </tr>
				<tr>
			     <td></td><td align="right"><input name="Guardar" class="btn mediano" type="submit" value="Guardar" /></td>
			    </tr>
			    </form>
			</table>';
		}

}

?>
