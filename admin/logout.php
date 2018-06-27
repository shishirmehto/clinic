<?php
	session_start();
	session_destroy();
	if(isset($_SESSION['adminid']))
	header("location:index.php");
	else
	header("location:login.php");
?>