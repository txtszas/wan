<?php




$num = 0;
$attachInfo = getAttachementsByPostId($post->ID);

if ($attachInfo){
	//获取缩略图
?>
	<ul id="thumn_<?php the_ID();?>" class="img_thumb" date-postid = "<?php the_ID();?>">
	<?php foreach ($attachInfo as $k => $v) { 
		if ($num > 2)
			break;
		$num++;
		?>
		<li class="thumbnail">
		<img src="<?php  echo wp_get_attachment_thumb_url($k); ?>" height='120'>
		</li>
	<?php } ?>
	</ul>
	<div class="preivew_box" id="preivew_box_<?php the_ID();?>">
		<?php
		$img_num = count($attachInfo)
		?>
		<div class="tips"><span class="current-num">1</span>/<span class="count"><?php echo $img_num;?></span><a href="javascript:;" class="close-back">收回</a></div>
		<ul class="img_preview" id="img_<?php the_ID();?>">
		<?php foreach ($attachInfo as $k => $v) { 
				$url = wp_get_attachment_image_src($k,'medium');
		?>
			<li>
				<img src="<?php  echo $url[0]; ?>" class="img-polaroid"> 
			</li>
		<?php } ?>
		</ul>
		<a class="carousel-control left" href="#myCarousel" data-slide="prev" id="prev_<?php the_ID();?>"><span>&lsaquo;</span></a>
  		<a class="carousel-control right" href="#myCarousel" data-slide="next"><span>&rsaquo;</span></a>
	</div>	

<?php
}else{

}
?>