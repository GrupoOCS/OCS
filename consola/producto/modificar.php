<?php
	include('../funciones/DB.php');
	if($_POST['acc']=='mod')
		modProducto($_POST['id']);
	else
		updProducto($_POST);
?>
