<?php include('encabezado.php'); 
// include 'abrirConexion.php';
	$db = Conectar();
	$query = "SELECT * FROM  direccion where id_cliente=".$_SESSION['id_usu'];
	$res = $db->query($query);





?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	
	

<?php
	
	foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
		{	

			//alert('entra');
			print'<div class="contenido">

		<div align="center"><center><p colspan="2" ><h2>Domicilio Actual</h2></p></center>	
			<table class="carrito">
			 	<form id="formulario" action="pago.php" method="post">
                    <td align="right">Calle y Número:</td>                         
                    <td><label for="calle" >&nbsp '.$row["calle"].'</label></td>
                </tr>
               
                <tr>
                    <td align="right">Colonia:</td>                         
                    <td><label for="colonia" >&nbsp '.$row["colonia"].'</label></td>
                </tr>
			    <tr>
			      	<td align="right">Estado: </td>';

					$query2 = "SELECT nombre FROM estados where id=".$row["id_estado"];
					$res2 = $db->query($query2);
			
					foreach($res2->fetchAll(PDO::FETCH_ASSOC) as $row2)
					{	
				      	print'
				      	<td><label for="estado" >&nbsp '.$row2["nombre"].'</label></td>
				      	
				    	</tr>';
			   		}
			    	print ' <tr>
			    	<td align="right">Municipio:</td>                         
                    <td><label for="municipio" >&nbsp '.$row["municipio"].'</label></td>
			  	</tr>
			 	<tr>
			      <td align="right">Código Postal:</td>                         
                    <td><label for="cp" >&nbsp '.$row["cp"].'</label></td>
			    </tr>
				<tr>
                    <td align="right">Destinatario:</td>                         
                    <td><label for="destinatario" >&nbsp '.$row["destinatario"].'</label></td>
                </tr>

				<tr>
			     <td>
			     </td>
			     <td align="right"><input name="Guardar" class="btn mediano" type="submit" value="Continuar" /></td>
			    </tr>
			    </form>

			</table>'; 
		}


	   ?>
			</div>
			<a class="enlace negro" href="form_direccion.php"><h5>Cambiar Dirección de envío</h5></a>
				</div>

		   
	




	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>







