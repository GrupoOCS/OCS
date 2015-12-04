<?php
	include('../funciones/DB.php');
	if($_POST['acc']=='mod')
		modSubcategoria($_POST['id']);
	else
		updSubcategoria($_POST);
?>
