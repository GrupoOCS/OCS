<?php
	include('../funciones/DB.php');
	if($_POST['acc']=='eli')
		eliSubcategoria($_POST['id']);
	else
		delSubcategoria($_POST['id']);
?>