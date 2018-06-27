<?php
	session_start();
	session_destroy();
	if(isset($_SESSION['doctorid']))
	header("location:index.php");
	else
	header("location:login.php");
?>