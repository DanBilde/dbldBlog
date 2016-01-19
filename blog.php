<?php
include_once "includes/functions.php";
include_once "classes/DbConnection.class.php";
$db = new DbConnection();//a new DbConnection object

$all_posts_sql="SELECT * FROM blog_post ORDER by post_id DESC";
$all_posts = $db->getRows($all_posts_sql);

$out="";

$log_form="Login: <form method =\"post\" action=\"process_login.php\">";
	
	$log_form.="Username:<input type=\"text\" name=\"user\" /> ";
	$log_form.="Password:<input type=\"password\" name=\"pw\" />";
	$log_form.="<input type=\"submit\" value=\"login\" />";
	$log_form.="</form>";
	//$out .= $log_form;


foreach($all_posts as $one_post){
	
	$out .="<div class='onepost'>";
	$out .="<p>" .$one_post['post']. "</p>";
	$out .="<div class='date'>";
	$out .="<p>".$one_post['post_date']."</p>";
	$out .="</div>";
	$out .="</div>";
	$post_id=$one_post['post_id'];
	$out .= comment_form($post_id);
	$all_comments_one_post_sql="SELECT * FROM blog_comment WHERE fk_post_id=$post_id ORDER BY comment_id DESC";
	// here will the script to display the comments be...
				if ($comments=$db->getRows($all_comments_one_post_sql)){
		$out .= "";
		foreach($comments as $comment){
			$out .="<div class='comment'>";			
			$out .= "<li>".$comment['comment'];
			$out .="</div>";
			
			$fk_id=$comment['comment_id'];	
			$out .= "</li>";
		}//end foreach
			$out .= "";
	}//end if
	//the form to comment on a specific post
$out .=rate_post_form($post_id);
$rate_count="SELECT COUNT(rating) AS ratings
FROM blog_rating
WHERE fk_p_id=$post_id";
$result=mysql_query($rate_count);
$row=mysql_fetch_assoc($result);
$ratings=$row['ratings'];
if($ratings>0){
$avg_sql = "SELECT AVG(rating) as result
FROM blog_rating
WHERE fk_p_id='$post_id'";
$avg_rating_array=$db->getRows($avg_sql);
$avg_rating=$avg_rating_array[0]['result'];
$out .="<p>avg rating: ".$avg_rating;
$out .=" ---- number of ratings :$ratings</p>";}
}//end foreach
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>BLOGGERT</title>
<link rel="stylesheet" href="blog.css" />
</head>
<body>

<div class="logo">
	<img src="logoblog.png" alt="" />
</div>
	
<div id="main">
	<div id="login">
	<?php echo login_form();//from included functions.php ?>
	</div>
	<h1>Rowntrees Randoms</h1>
		
	<div id="blog">
		<?php echo $out; ?>
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