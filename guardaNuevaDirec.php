<?php
session_start();
$id=$_SESSION["id_usu"];

include('abrirConexion.php');
$db = Conectar();


$calle=$_POST["calle"];
$num =$_POST["num"];
$col =$_POST["col"];
$est= $_POST["est"];
$mun= $_POST["mun"];
$cp=$_POST["cp"];
$dest= $_POST["dest"];
$tel= $_POST["tel"];
$ciudad= $_POST["ciudad"];
echo $id;
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
			    //echo "Se ha Modificado exitosamente";
			} 
			catch (Exception $e) {
				//echo "ERROR:No se modifico excitosamente. Vuelva a intentarlo mas tarde<BR>";
			}
		}
		else{}
			//echo "ERROR:No se pudo conectar a la base de datos<BR>";


?>