<?php
include_once "classes/DbConnection.class.php";
$db = new DbConnection();
if(isset($_POST['new_post'])){
	$post=$_POST['new_post'];
	
	$insert_post_sql="INSERT INTO blog_post
					(post_id, post, post_date)
					VALUES (null, '$post', CURDATE())";
	//insert the new post
	if($db->insert($insert_post_sql)){
		header("location: admin.php");
	}
}

?>