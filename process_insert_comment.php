<?php
include_once "classes/DbConnection.class.php";
$db=new DbConnection (); //create a new DbConnection object
if(isset($_POST['p_id'])){
	$p_id=$_POST['p_id'];
	$comment=$_POST['comment'];
	$insert_comment_sql="INSERT INTO blog_comment 
	(comment_id,comment,fk_post_id)
	VALUES ('','$comment','$p_id')";
	//insert the new post using the $db object
	if($db->insert($insert_comment_sql)){
		header("location:blog.php");
		}
	}
	else
	{
		header("location:blog.php");
	}
?>