<?php
	include 'abrirConexion.php';
	$idc = $_GET['idc'];
	$idp = $_GET['idp'];
	$n = $_GET['n'];
	$db = Conectar();

	$prod = $db->query("select *from carrito where id_cliente=".$idc." and id_producto=".$idp.";");
	$count = $prod->rowCount();
	if ($count <= 0){
		$query = $db->exec("insert into carrito (id_cliente, id_producto, cantidad) VALUES (".$idc.", ".$idp.", ".$n.")");
		$id = $db->lastInsertId();
	}else{
		$prod = $db->query("select cantidad from carrito where id_cliente=".$idc." and id_producto=".$idp." limit 1;");
		foreach ($prod-> fetchAll(PDO::FETCH_NUM) as $row ){
			$query = $db->exec("update carrito SET cantidad=".$row[0]."+".$n." where id_cliente=".$idc." and id_producto=".$idp.";");
			$id = $db->lastInsertId();
		}
	}

	$car = $db->query("select sum(cantidad) from carrito where id_cliente=".$idc.";");
	foreach ($car-> fetchAll(PDO::FETCH_NUM) as $row ){
		printf ("(%s)",$row[0]);
	}
?>

