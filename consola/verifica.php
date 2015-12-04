<?php
	error_reporting(0);
	session_start();
	if($_SESSION['nom_usu'])
		echo "true";
	else
		echo "false";
?>