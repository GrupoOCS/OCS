<?php
	include('../funciones/DB.php');
	if($_POST['acc']=='eli')
	{
<<<<<<< HEAD
		eliSubcategoria($_POST['id']);
=======
		eliSubcategoria($_POST['id'],$_POST['cat']);
>>>>>>> origin/master
	}
	else
		delSubcategoria($_POST['id'],$_POST['cat']);
?>