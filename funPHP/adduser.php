<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include_once 'DB.php';
// Si entramos es que todo se ha realizado correctamente
	$db = conectar();
	if ( is_null($db) )
		echo "Error al conectar a la db";
	$res = $db->query( $query );

// Con esta sentencia SQL insertaremos los datos en la tabla cliente
    $nombre=$_POST['nombre']." ".$_POST['apellidoP']." ".$_POST['apellidoM'];
    $mail=$_POST['correo'];
    $pass=$_POST['pass'];
	mysql_query("INSERT INTO cliente (nombre,contrasena,email)"
	VALUES "($nombre,$mail,$pass)",$res);

// Con esta sentencia SQL insertaremos los datos en la tabla direccion
    $calle_num=$_POST['calle']." ".$_POST['numero'];
    $colonia=$_POST['colonia'];
    $municipio=$_POST['municipio'];
    $edo=$_POST['estado'];
    $ciudad=$_POST['ciudad'];
    $codigo=$_POST['cp'];
    $tel=$_POST['tel'];
    $id_edo=$_POST['estado'];
    
    $destino=$_POST['nombre']." ".$_POST['apellidoP']." ".$_POST['apellidoM'];
	mysql_query("INSERT INTO direccion (calle,colonia,municipio,ciudad,id_estado,telefono,cp,destinatario)"
	VALUES "($calle,$colonia,$municipio,$ciudad,$id_edo,$tel,$codigo,$destino)",$res);

?>