<?php
if(isset($_GET['p_id'])){
$p_id=$_GET['p_id'];
$r=$_GET['rating'];;
}else{
header("Location:blog.php");
}
include_once ("classes/DbConnection.class.php");
$db=new DbConnection();
$insert_sql="INSERT INTO blog_rating (r_id,rating, fk_p_id)
VALUES ('',$r,'$p_id')";
if($result=$db->insert($insert_sql)){
header("Location:blog.php");
}else{
echo mysql_error();
}
?>