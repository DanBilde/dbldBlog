<?php
session_start();
$user=$_POST['user'];
$pw=md5($_POST['pw']);
include_once "classes/DbConnection.class.php";
$db=new DbConnection();
$sql="SELECT * FROM blog_admin WHERE username='$user' AND password='$pw' LIMIT 1";

if($all_users=$db->getRows($sql)){
	$_SESSION['admin']=$all_users[0]['username'];
	header("location:admin.php");
	} else{
		header("location:blog.php");
		}
?>