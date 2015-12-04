<?php
	include('../funciones/DB.php');
	if($_POST['acc']=='eli')
		eliProductos($_POST['id']);
	else
		delProductos($_POST['id']);
?>