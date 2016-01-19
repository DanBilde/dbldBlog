<?php
if(isset($_GET['p_id'])){
	$p_id=$_GET['p_id'];
}else{
	header("Location:blog.php");
}
include_once "includes/functions.php";
include_once "classes/DbConnection.class.php";
$db = new DbConnection(); //a new DbConnection object

$all_posts_sql="SELECT * FROM blog_post WHERE post_id=$p_id" ;
$all_posts = $db->getRows($all_posts_sql);

foreach($all_posts as $one_post){
	$post = $one_post['post'];
	$post_id = $one_post['post_id'];
	$out=edit_post_form($p_id,$post);
} //end foreach
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Edit a post in the blog</title>
</head>
<body>
<div id="main">
	<div id="blog">
		<?php echo $out; ?>
	</div>
</div>
</body>
</html>