<?php 
	session_start();
	include("../db/DB.php");
	
	if(($ans=verificausuario($_POST))=="true")
		echo "true";
	else
		echo $ans;


?>