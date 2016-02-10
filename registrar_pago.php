<?php include('encabezado.php'); 
$id=$_SESSION["id_usu"];

if(isset($_GET["elim"]))
{
	echo"<p class=\"alert alert-info\" align=\"center\"> Su pedido ha sido eliminado </p>";	
	echo"<script> setTimeout(function(){  location.href = \"registrar_pago.php\"; }, 500); </script>";
}
$db = Conectar();
?>

<div class="contenido">
	<div class="wholeTipoPago">


			<center><h3>  Selecciona el pedido que deseas concluir o eliminar</h3> </center>
			<form action="accion_pedido.php" method="post"><select class="form-control" id="idpedido" name="idpedi" onChange=habilitar(this)>
			<option disabled selected> -- Selecciona una opción -- </option>
		<?php 

		
		$query = $db->prepare("select id,fecha from pedido where pedido.id_cliente=".$id);
			
			try {
				$query->execute();
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
			foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $row2) {
				
				$query2 = $db->prepare("select id_producto,cantidad from producto_pedido where id_pedido=".$row2["id"]);
				
				try {
					$query2->execute();
				    //echo "Se ha Modificado exitosamente";
				} 
				catch (Exception $e) {
					//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
				}

				foreach ($query2->fetchAll(PDO::FETCH_ASSOC) as $row3) {
					$query3 = $db->prepare("select precio from producto where id=".$row3["id_producto"]);
				
					try {
						$query3->execute();
					    //echo "Se ha Modificado exitosamente";
					} 
					catch (Exception $e) {
						//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
					}
					foreach ($query3->fetchAll(PDO::FETCH_ASSOC) as $row4) {
						$total+=$row3["cantidad"]*$row4["precio"];
						
					}

				}

			$total=$total + $total*0.16;
			echo"<option value='".$row2["id"]."'>"."Monto: $".number_format(round($total,2), 2)."- Fecha: ".$row2["fecha"]."</option>";	
			$total=0;
		}
		$query = "SELECT id FROM pedido where status='en proceso' and id_cliente=".$_SESSION['id_usu'];
		$res = $db->query($query);
		?>
		</select>
		<br><br><br>
		<center><table style="width:600px;">
			<tr>
				<td><input type="submit" name="elim" value="Eliminar" class="btn grande cancelar" disabled="disabled"></td> <td><input type="submit" name="continuar" value="Continuar" class="btn grande" disabled="disabled"></td>
			</tr>
		</table></center>
		</form>

	</div>
</div>






<?php include('pie_pagina.php'); ?>



<script type="teXt/javascript">

function desplegar(tabla_a_desplegar,estadoT) {
var tablA = document.getElementById(tabla_a_desplegar);
var estadOt = document.getElementById(estadoT);

	switch(tablA.style.display) {
	case "none":
	tablA.style.display = "block";
	estadOt.innerHTML = "Ocultar coneNido"
	break;
		default:
		tablA.style.display = "none";
		estadOt.innerHTML = "Mostrar coNteNido"
		break;
}
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script>
    // Called when token created successfully.
    var successCallback = function(data) {
        var myForm = document.getElementById('myCCForm');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
        myForm.submit();
    };

    // Called when token creation fails.
    var errorCallback = function(data) {
        if (data.errorCode === 200) {tokenRequest();} else {alert(data.errorMsg);}
    };

    var tokenRequest = function() {
        // Setup token request arguments
        var args = {
            sellerId: "901308282",
            publishableKey: "6E275F45-7F5E-414F-B781-2427480DA7E4",
            ccNo: $("#ccNo").val(),
            cvv: $("#cvv").val(),
            expMonth: $("#expMonth").val(),
            expYear: $("#expYear").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function() {
        // Pull in the public encryption key for our environment
        TCO.loadPubKey('sandbox');

        $("#myCCForm").submit(function(e) {
            // Call our token request function
            tokenRequest();

            // Prevent form from submitting
            return false;
        });
    });

    function habilitar(select){
    	if($(select).val()!=null){
    		$('input[type="submit"]').removeAttr("disabled");
    	}
    }
</script>
