<?php	
include_once "classes/DbConnection.class.php";
$db=new DbConnection();
if(isset($_GET['p_id'])){
	$post_id=$_GET['p_id'];
	
	$delete_post_sql="DELETE FROM blog_post WHERE post_id=$post_id";
	
	/*
	$any_comment_sql="SELECT * FROM blog_comment 
						WHERE fk_post_id=$post_id";
	if(is_array($db->getRows($any_comment_sql))){
		$delete_comment_sql="DELETE FROM blog_comment 
								WHERE fk_post_id=$post_id";
		//delete the comment to a specific post
		$db->delete($delete_comment_sql);
		}
		*/
		//delete the specific post
		if($db->delete($delete_post_sql)){
			header("location:admin.php");
			}
		}
		
?>