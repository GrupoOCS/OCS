<?php
	$id_p=$_POST["id_p"];
	$id_cliente=$_POST["id_c"];
	include 'abrirConexion.php';
	$db = Conectar();
	$query = $db->prepare("");
	$prod = $db->query("DELETE FROM carrito where id_cliente=".$id_cliente." and id_producto=".$id_p.";");
	$prod->execute();
print'<script>  window.location.assign("carrito.php") </script>';
?>

