<?php include('encabezado.php'); 
// include 'abrirConexion.php';
	$db = Conectar();
	$query = "SELECT * FROM  direccion where id_cliente=".$_SESSION['id_usu'];
	$res = $db->query($query);




?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	
			<script>
		function muestra(val,id_cli){

			$.ajax({

				type: "POST",
				url: "form_direccion.php",
				data: "tipo="+ val +"&id_c="+ id_cli,
				success: function(res)
				{	

					 document.getElementById("formu").innerHTML = res;
					
				},
				error: function(jqXHR, textStatus, error)
				{
					console.log("no se pudo mover");
				}
			});
		}

	</script>

			   <?php print "<div class='contenido'>

		<div align='center'><table class='carrito'>
		<tr><td><select name='OP_DIRECCION' class='form-control' onclick='muestra(this.value, ".$_SESSION['id_usu'].")'>";
			    	  foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row)
								{	
			    			print'<option  value="'.$row["lugar"].'">'.$row["lugar"].'</option>';
			    				}
					        ?>
					        <option value="nueva" selected>Nueva Direccion</option>
			</select></td></tr></table>
				<form action="Pago.php" method="post">
			<div id="formu">

			</div>
			</form>

			</div>
				</div>

		   
	




	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>







