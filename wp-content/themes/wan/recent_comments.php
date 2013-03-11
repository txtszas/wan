<style type="text/css">
	#sidebar li.recent_comment_li{background:none;border-bottom:1px dashed #f1f1f1;}
	li.recent_comment_li{margin-bottom:5px !IMPORTANT;line-height:1.5em;list-style-type:none !important;}
	#recent_comment_div1{float:left;}
	#recent_comment_div2{width:200px;margin-left: 40px;margin-bottom:10px;}
	span.comment_author em{color:#565656;text-weight:blod;}
	span.comment_span{padding-left:1em;}
	#recent_comment_div2 a{color:#999999 !IMPORTANT;}
	#recent_comment_div2 a:hover{color:#2b9bcd !IMPORTANT;}
</style>
<h3>最新评论</h3>
<?php
$comments = get_comments('number=8&status=approve');
$true_comment_count = 0;
foreach ($comments as $comment) {

		$true_comment_count = $true_comment_count +1;
        $comm_title = get_the_title($comment->comment_post_ID);
        $comm_link = get_permalink($comment->comment_post_ID);
        $comm_comm_temp = get_comment($comment->comment_ID,ARRAY_A);
        $comm_content = $comm_comm_temp['comment_content'];
        
?>
<li class="recent_comment_li">
	<div id="recent_comment_div1">
		<?php echo get_avatar( $comment, 30 );?>
	</div>
	<div id="recent_comment_div2">
	<span class="comment_author">
		<em><?php echo($comment->comment_author)?></em>
	</span> 
	<span class="comment_span">评论 </span><br/>
	<a href="<?php echo($comm_link)?>" title="<?php comment_excerpt(); ?>">
		<?php echo $comm_title ?>
	</a><br />
	<?php echo $comm_content ?>
	</div>
</li>
<?php
	if($true_comment_count == 8) break;
}
?>