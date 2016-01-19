<?php	
session_start();

if(isset($_SESSION['admin'])) {
	session_unset($_SESSION['admin']);
	}
	
header ("location:blog.php");
?>