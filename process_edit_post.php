<?php
include_once "classes/DbConnection.class.php";
$db = new DbConnection();
if(isset($_POST['post'])){
	$post=$_POST['post'];
	$p_id=$_POST['p_id'];
	
	$update_post_sql="UPDATE blog_post
					SET post='$post', post_date=CURDATE()
					WHERE post_id=$p_id";
	//update the post
	if($db->update($update_post_sql)){
		header("location: admin.php");
	}else{
		echo mysql_error();
		}
}

?>