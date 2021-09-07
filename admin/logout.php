<?php
	session_start();
	unset($_SESSION['admin']);
	unset($_SESSION['admin_name']);
	unset($_SESSION['admin_role']);
	header("location:login.php");
	exit();
?>