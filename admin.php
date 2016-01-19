<?php
session_start();
if(!isset($_SESSION["admin"])){
	header ("Location:blog.php");
}else{
	$admin=$_SESSION["admin"];
}
include_once "includes/functions.php";
include_once "classes/DbConnection.class.php";

$db = new DbConnection();
$all_posts_sql="SELECT * FROM blog_post ORDER BY post_id DESC";
$all_posts = $db->getRows($all_posts_sql);
$out=post_form(); //display the form to submit new posts
foreach ($all_posts as $one_post){
	$post_id=$one_post['post_id'];
	$all_comments_one_post_sql="SELECT * FROM blog_comment WHERE fk_post_id=$post_id ORDER BY comment_id DESC";
	$out .="<div class='onepost'>";
	$out .="<p>".$one_post['post']."</p>";
	$out .="<div class='date'>";
	$out .="<p>".$one_post['post_date']."</p>";
	$admin_links=
	"<p><a href=\"delete_post.php?p_id=$post_id\">delete post</a>,";
	$admin_links.=
	" <a href=\"edit_post.php?p_id=$post_id\">edit post</a></p>";
	$out .= $admin_links; //displays the links
	$out .="</div>";
	$out .="</div>";
				if ($comments=$db->getRows($all_comments_one_post_sql)){
		$out .= "<ol>";
		foreach($comments as $comment){
			$out .= "".$comment['comment'];
			
			$fk_id=$comment['comment_id'];
			$delete_comment_link=
		"<a href=\"process_delete_comment.php?c_id=$fk_id\">delete comment</a>";
			$out .= "<br />".$delete_comment_link;
			
			$out .= "";
		}//end foreach
			$out .= "</ol>";
	}//end if
} //end foreach
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Section. The blog</title>
<link rel="stylesheet" href="blog.css" />
</head>
<body>
<div class="logo">
	<img src="logoblog.png" alt="" />
</div>



<div id="main">
		<h1>BLOGGERT</h1>
		<?php echo logout_link($admin);/*from included functions.php*/ ?>
		<?php echo $out; ?>
<div class="ribbon">
	<img src="admin-ribbon.png" alt="" />
</div>		
		
</div>

<SCRIPT type="text/javascript">
/*
Snow Fall 1 - no images - Java Script
Visit http://rainbow.arch.scriptmania.com/scripts/
  for this script and many more
*/

// Set the number of snowflakes (more than 30 - 40 not recommended)
var snowmax=35

// Set the colors for the snow. Add as many colors as you like
var snowcolor=new Array("#aaaacc","#ddddff","#ccccdd","#f3f3f3","#f0ffff")

// Set the fonts, that create the snowflakes. Add as many fonts as you like
var snowtype=new Array("Times","Arial","Times","Verdana")

// Set the letter that creates your snowflake (recommended: * )
var snowletter="*"

// Set the speed of sinking (recommended values range from 0.3 to 2)
var sinkspeed=0.6

// Set the maximum-size of your snowflakes
var snowmaxsize=30

// Set the minimal-size of your snowflakes
var snowminsize=8

// Set the snowing-zone
// Set 1 for all-over-snowing, set 2 for left-side-snowing
// Set 3 for center-snowing, set 4 for right-side-snowing
var snowingzone=1

///////////////////////////////////////////////////////////////////////////
// CONFIGURATION ENDS HERE
///////////////////////////////////////////////////////////////////////////


// Do not edit below this line
var snow=new Array()
var marginbottom
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera

function randommaker(range) {
        rand=Math.floor(range*Math.random())
    return rand
}

function initsnow() {
        if (ie5 || opera) {
                marginbottom = document.body.scrollHeight
                marginright = document.body.clientWidth-15
        }
        else if (ns6) {
                marginbottom = document.body.scrollHeight
                marginright = window.innerWidth-15
        }
        var snowsizerange=snowmaxsize-snowminsize
        for (i=0;i<=snowmax;i++) {
                crds[i] = 0;
            lftrght[i] = Math.random()*15;
            x_mv[i] = 0.03 + Math.random()/10;
                snow[i]=document.getElementById("s"+i)
                snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)]
                snow[i].size=randommaker(snowsizerange)+snowminsize
                snow[i].style.fontSize=snow[i].size+'px';
                snow[i].style.color=snowcolor[randommaker(snowcolor.length)]
                snow[i].style.zIndex=1000
                snow[i].sink=sinkspeed*snow[i].size/5
                if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
                snow[i].style.left=snow[i].posx+'px';
                snow[i].style.top=snow[i].posy+'px';
        }
        movesnow()
}

function movesnow() {
        for (i=0;i<=snowmax;i++) {
                crds[i] += x_mv[i];
                snow[i].posy+=snow[i].sink
                snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
                snow[i].style.top=snow[i].posy+'px';

                if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
                        if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                        if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                        if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                        if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                        snow[i].posy=0
                }
        }
        var timer=setTimeout("movesnow()",50)
}

for (i=0;i<=snowmax;i++) {
        document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"'>"+snowletter+"</span>")
}
if (browserok) {
        window.onload=initsnow
}

</SCRIPT>

</body>
</html>