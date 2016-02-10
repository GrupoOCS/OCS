<?php
session_start();
$id=$_SESSION["id_usu"];

include('abrirConexion.php');
$db = Conectar();


if(isset($_GET["ciudad"]) && isset($_GET["calle"]) && isset($_GET["numero"]) && isset($_GET["tel"]) && isset($_GET["colonia"]) && isset($_GET["municipio"]) && isset($_GET["estado"]) && isset($_GET["cp"]) && isset($_GET["destinatario"]))
{
	$calle=$_GET["calle"];
	$tel=$_GET["tel"];
	$col=$_GET["colonia"];
	$mun=$_GET["municipio"];
	$num=$_GET["numero"];
	$dest=$_GET["destinatario"];
	$cp=$_GET["cp"];
	$est=$_GET["estado"];
	$ciudad=$_GET["ciudad"];

}
if($db!=null)
		{
			
			$prepared = array(
				'calle' => $calle." ".$num,
				'idc' => $id,
				'cp' => $cp,
				'tel' => $tel,
				'ciudad' => $ciudad,
				'est' => $est,
				'dest'=>$dest,
				'mun'=>$mun,
				'col'=>$col
				
				);
			
			$query = $db->prepare("UPDATE direccion SET colonia=:col,municipio=:mun,destinatario=:dest,id_estado=:est,telefono=:tel,calle=:calle,cp=:cp,ciudad=:ciudad WHERE id_cliente=:idc");
			
			try {
				$query->execute($prepared);
				header('location:direccion.php');
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else{}
			//echo "ERROR:No se pudo conectar a la base de datos<BR>";


?>