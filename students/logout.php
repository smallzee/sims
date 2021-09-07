<?php
	session_start();

	unset($_SESSION['matric']);
	unset($_SESSION['last_login']);

	header("location:index.php");
	exit();
?>