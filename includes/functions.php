<?php
/*
::::FUNCTIONS:::::
log_form()
log_link($admin)
post_form();
comment_form($post_id)
*/
function login_form(){
	$log_form="<form method =\"post\" action=\"process_login.php\">";
	$log_form.="<div id=\"login-form\">"; //Login-form id
	$log_form.="<input type=\"text\" name=\"user\" placeholder=\"Username\" /> ";
	$log_form.="<input type=\"password\" name=\"pw\" placeholder=\"Password\" />";
	$log_form.="<input type=\"submit\" value=\"login\" />";
	$log_form.="</form>";
	$log_form.="</div>"; //end of login-form id

	return $log_form;
}


function logout_link($admin){
	$log_link="Welcome $admin. <a href=\"process_logout.php\">Log Out</a>";
	return $log_link;
}


function post_form(){
	$post_form="<form method='post' action='insert_post.php'>";
	$post_form.="<br /><textarea name='new_post' placeholder=\"Add new post...\" cols='50' rows='5'></textarea>";
	$post_form.="<br /><input type='submit' value='Save Post' />";
	$post_form.="</form>";
	return $post_form;
}
function comment_form($post_id){
	$comment_form="<form method=\"post\" action=\"process_insert_comment.php\">";
	$comment_form .="<div class=\"box\">";
	$comment_form .="<br /><textarea name=\"comment\" placeholder=\"Comment...\" cols=\"20\" rows=\"2\">";
	$comment_form.="</textarea>";
	$comment_form .="<input type=\"hidden\" name=\"p_id\" value=\"$post_id\">";
	$comment_form .="<input type=\"submit\" value=\"Save Comment\">";
	$comment_form .="</div>";
	$comment_form.="</form>";
	return $comment_form;
}

function edit_post_form($p_id, $post){
	$post_form="<form method='post' action='process_edit_post.php'>";
	$post_form .="<fieldset>";
	$post_form.="Edit the post: <br /><textarea name='post' cols='50' rows='5'>$post</textarea>";
	$post_form.="<br /><input type='hidden' name=\"p_id\" value=\"$p_id\" />";
	$post_form.="<br /><input type='submit' value='Edit the Post' />";
	$post_form .="</fieldset>";
	$post_form.="</form>";
	return $post_form;
}

function rate_post_form($p_id) { 
	$rate_form="<form method=\"get\" action=\"process_rating.php\">";
	$rate_form .="<div class=\"box\">";
	$rate_form .="<select name=\"rating\">";
	$rate_form .="<option value=\"1\"> 1 star </option>";
	$rate_form .="<option value=\"2\"> 2 star </option>";
	$rate_form .="<option value=\"3\"> 3 star </option>";
	$rate_form .="<option value=\"4\"> 4 star </option>";
	$rate_form .="<option value=\"5\"> 5 star </option>";
	$rate_form .="</select>";
	$rate_form .="<input type=\"hidden\" name=\"p_id\" value =\"$p_id\" />";
	$rate_form .="<input type =\"submit\" value=\"Rate\" />";
	$rate_form .="</div>";
	$rate_form .="</form>";
	
	return $rate_form;}

?>
