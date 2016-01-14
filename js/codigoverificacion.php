<?php 
	session_start();
	include("../db/DB.php");
	echo verificacodigo($_POST);
?>