<?php
$list20 = get20list();

$listTwo = array_chunk($list20,3,true);
?>

<div id="list20">
	<h2>最近更新<i class="icon-chevron-down" style="float:right" id="list20-down"></i></h2>

	<div class="three-list">
	<ul class="left" >
	<?php
	
	foreach ($listTwo[0] as $key => $post) {
	?>
		<li><a href="<?php the_permalink() ?>"><?php echo cutText($post->post_title,18); ?></a></li>
	<?php	
	}
	?>
	</ul>

	<ul class="middle" >
	<?php
	
	foreach ($listTwo[2] as $key => $post) {
	?>
		<li><a href="<?php the_permalink() ?>"><?php echo cutText($post->post_title,18); ?></a></li>
	<?php	
	}
	?>
	</ul>

	<ul class="right">
	<?php
	
	foreach ($listTwo[3] as $key => $post) {
	?>
		<li><a href="<?php the_permalink() ?>"><?php echo cutText($post->post_title,18); ?></a></li>
	<?php	
	}
	?>
	</ul>
	<div class="more">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=176" title="查看更多"><img src="<?php echo get_template_directory_uri(); ?>/images/more.jpg"></a>
	</div>
	</div>
</div>
<script type="text/javascript">
var listshow = 0;
$('#list20 h2').click(function(){
	if (listshow == 0) {
		$('.three-list').animate({height:93});
		$('#list20-down').attr("class","icon-chevron-up");
		listshow = 1;
	}else{
		$('.three-list').animate({height:0});
		$('#list20-down').attr("class","icon-chevron-down");
		listshow = 0;
	}
	
})
</script>