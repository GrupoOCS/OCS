<?php include('encabezado.php'); 
$id=$_SESSION["id_usu"];

$db = Conectar();
//-----------------------------------------------------------------------------------------------
$query = "SELECT id FROM direccion where id_cliente=".$_SESSION['id_usu'];
$res = $db->query($query);
foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	
	$id_direccion = $row['id'];
}
// echo $id_direccion;
//-----------------------------------------------------------------------------------------------
$status = "en proceso";
//-----------------------------------------------------------------------------------------------

if($db!=null)
{
	$prepared = array(
		'id' => $id,
		'id_direccion' => $id_direccion,
		'status' => $status
		);
	$query = $db->prepare("INSERT INTO pedido (id_cliente,id_direccion,status) VALUES (:id,:id_direccion,:status)");
    try {
    	$query->execute($prepared);
    	// echo "Sus datos se han guardado exitosamente";
    } 
    catch ( PDOException $e) 
    {
    	echo "ERROR: No se puede insertar en la base de datos\nIntente mas tarde";
    }	
    	
}
else
	echo "ERROR:No se pudo conectar a la base de datos";
//-----------------------------------------------------------------------------------------------
$query = "SELECT id FROM pedido where id_cliente=".$_SESSION['id_usu'];
$res = $db->query($query);
foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	
	$id_pedido = $row['id'];
}

//-----------------------------------------------------------------------------------------------
$query = "SELECT * FROM  carrito where id_cliente=".$_SESSION['id_usu'];
$res = $db->query($query);
foreach($res->fetchAll(PDO::FETCH_ASSOC) as $row){	
	$prepared = array(
		'id_pedido' => $id_pedido,
		'id_producto' => $row['id_producto'],
		'cantidad' => $row['cantidad']
		);
	$query = $db->prepare("INSERT INTO producto_pedido (id_pedido,id_producto,cantidad) VALUES (:id_pedido,:id_producto,:cantidad)");
    try {
    	$query->execute($prepared);
    	// echo "Sus datos se han guardado exitosamente tabla producto pedido";
    } 
    catch ( PDOException $e) 
    {
    	echo "ERROR: No se puede insertar en la base de datos\nIntente mas tarde";
    }	
}
//-----------------------------------------------------------------------------------------------

if(isset($_GET["ciudad"]) && isset($_GET["calle"]) && isset($_GET["numero"]) && isset($_GET["tel"]) && isset($_GET["colonia"]) && isset($_GET["municipio"]) && isset($_GET["estado"]) && isset($_GET["cp"]) && isset($_GET["destinatario"]))
{
	$ca=$_GET["calle"];
	$tel=$_GET["tel"];
	$col=$_GET["colonia"];
	$mun=$_GET["municipio"];
	$num=$_GET["numero"];
	$dest=$_GET["destinatario"];
	$cp=$_GET["cp"];
	$est=$_GET["estado"];
	$ciudad=$_GET["ciudad"];
	$calle=$ca." ".$num;
}
else{
	$db = Conectar();
	if($db!=null)
		{
						
			$query = $db->prepare("SELECT calle,colonia,id_estado,municipio,ciudad,cp,telefono,destinatario FROM direccion WHERE id_cliente=".$id);
			
			try {
				$query->execute($prepared);
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}

		foreach($query->fetchAll(PDO::FETCH_ASSOC) as $row){
			$calle=$row["calle"];
			$tel=$row["telefono"];
			$col=$row["colonia"];
			$mun=$row["municipio"];
			$dest=$row["destinatario"];
			$cp=$row["cp"];
			$est=$row["id_estado"];
			$ciudad=$row["ciudad"];
		}
}
?>

<div class="contenido">
	<div class="wholeTipoPago">
		
		
			<p>
			<center>
			<center><h2> Registrar Pago </h2>
			</center>
			
			<table >
				<tr>
					<th onClick="desplegar('tabla_a_desplegar','estadoT')" align="center">
						<h3>Pago en Ventanilla<h3>
					</th>
				</tr>

				<tr>
					<td>
						<table  id="tabla_a_desplegar" style="display: none;">		
							<form action="Efectivo.php" method="post" enctype="multipart/form-data">
								<tr>
									<th align="center">
										<h5>CuentaX: 1548-64       CuentaY:65498-5</h5>
									</th>
								</tr>
								<tr>
									<td><label>Autorizacion</label></td>
									<td>	<input type="text" class="form-control" name="autorizacion" minlength="6" maxlength="6" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" Placeholder="numAutorizacion" required></td>
								</tr>
								<tr>
									<td>Referencia</td>
									<td><input type="text" class="form-control" name="referencia" minlength="20" maxlength="30" PlaceHolder="numReferencia" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required></td>
								</tr>
								<input type="hidden" name="calle" value=<?php echo "'".$calle."'";?>>
								<input type="hidden" name="col" value=<?php echo "'".$col."'";?>>
								<input type="hidden" name="mun" value=<?php echo "'".$mun."'";?>>
								<input type="hidden" name="ciudad" value=<?php echo "'".$ciudad."'";?>>
								<input type="hidden" name="est" value=<?php echo "'".$est."'";?>>
								<input type="hidden" name="dest" value=<?php echo "'".$dest."'";?>>
								<input type="hidden" name="cp" value=<?php echo "'".$cp."'";?>>
								<input type="hidden" name="tel" value=<?php echo "'".$tel."'";?>>
								
								<tr>
									<td>
										<label>Imagen</label>
									</td>
									<td>
										<input type="file"  name="imagen" required>
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="right"><input type="submit" class="btn grande" value="Enviar"></td>
								</tr>
								<tr>
									<td></td>
									<td><h5>Si aun no tiene el comprobante del deposito, puede volver mas tarde, el pedido y la cantidad de pago se guardaran temporalmente hasta que usted pague o cancele el pedido</h5></td>
								</tr>
							</form>
						</table>	

					</td>
				</tr>
			</table>
			
			<center>			
				<table  >
					<tr>
						<td onClick="desplegar('tabla_a_desplegar2','estadoT2')">
							<center>
								<h3>Pago con Tarjeta</h3>		
								<p><IMG SRC="img\baco.jpg"> </p>
							</center>
						</td>
					</tr>
					<tr>
						<td>
							<center><table  id="tabla_a_desplegar2"   style="display: none;">
								<form id="myCCForm" action="payment.php" method="POST">
								
									
										    <input id="token" name="token" type="hidden" value="">
										<tr>
											<td><label>Nombre del titular de la tarjeta: </label></td>
											<td>	<input type="text" class="form-control" maxlength="35" name="titular_tarjeta" placeholder="Nombre" required></td>
										
										</tr>
										<tr>
											<td><label><center>Número de tarjeta: </center> </label></td>
											<td>    <input type="text" name="dato1" id="ccNo" minlength="16"  maxlength="16" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" title="Teclee los 16 digitos de su tarjeta" class="form-control" placeholder="Numero de tarjeta" required></td>
										
											</tr>
										<tr>
												<td><label >Mes de Vencimiento: </label></td>
										<td>
											<select  id="expMonth" name="mes" class="form-control" >
												<option value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											</select>
										</td>
									</tr>
										<tr>
											<td><label >Año de Vencimiento: </label></td>
											<td>
											<select  id="expYear" name="ano" class="form-control" >
												<option value="15">2015</option>
												<option value="16">2016</option>
												<option value="17">2017</option>
												<option value="18">2018</option>
												<option value="19">2019</option>
												<option value="20">2020</option>
												<option value="21">2021</option>
												<option value="22">2022</option>
												<option value="23">2023</option>
												<option value="24">2024</option>
												<option value="25">2025</option>
												<option value="26">2026</option>
											</select>
										</td>
									</tr>
										<tr>
											<td><label >Código de Seguridad: </label></td>
										<td><input id="cvv" type="text" name="codigo" class="form-control"  minlength="3"  maxlength="3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" autocomplete="off" placeholder="000" pattern="[0-9]{3}" title="teclea el número de seguridad de tu tarjeta. Son 3 digitos" required></td>
										</tr>
										<tr >
											<td colspan="2" align="center">	
											<input type="submit" class="btn grande" value="Finalizar compra">
										</td>
									</tr>
									
								
								</table></center>
							</form>
						</td>
					</tr>
				</table>
			</center>
			
			
				
			
					
			</p>
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
</script>
