<?php
include_once "classes/DbConnection.class.php";
$db = new DbConnection();
if(isset($_GET['c_id'])){
	$comment_id=$_GET['c_id'];
	$delete_comment_sql="DELETE FROM blog_comment
	WHERE comment_id=$comment_id";
	//delete the specific comment
	if($db->delete($delete_comment_sql)){
		header("location: admin.php");
	}
}
?>