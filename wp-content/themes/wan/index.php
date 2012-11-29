<?php get_header(); ?>



<div class="row">
	<div class="span8">
		<?php include (TEMPLATEPATH . '/list20.php'); ?>

		<!-- 主体内容 -->
		<div id="content">
			<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part('content','index'); ?>

			<?php endwhile; ?>



			<!-- <div class="pager">
				<ul>
					<li class="previous"><?php previous_posts_link('&laquo; 上一页') ?></li>
					<li class="next"><?php next_posts_link('下一页 &raquo;','') ?></li>
				</ul>
	 		</div> -->
		</div>
		<?php wp_pagenavi(); ?>
	</div>

	<!-- 最新二十条 -->
	

<!-- 侧边栏 -->
	 <div class="span4">
	 	<?php get_sidebar(); ?>
	 </div>


</div>


<script type="text/javascript">

var img_show_num = new Array();
function show_img(post_id,show_eq){
	$('#preivew_box_' + post_id + ' .current-num').text(show_eq+1);
	$('#img_'+ post_id + ' li').removeClass('active');
	$('#img_'+ post_id + ' li').eq(show_eq).addClass('active');
}

function makePreNextListesn(post_id,img_count){
	$('#preivew_box_' + post_id + ' .right').click(function(){
		if (img_show_num[post_id] < img_count - 1) {
			img_show_num[post_id]++;
			show_img(post_id, img_show_num[post_id]);
			$('#preivew_box_' + post_id + ' .left').show();
		}
		if (img_show_num[post_id] == img_count - 1){
			$('#preivew_box_' + post_id + ' .right').hide();
		}
	})
	$('#preivew_box_' + post_id + ' .left').click(function(){
		if (img_show_num[post_id] > 0){
			img_show_num[post_id]--;
			show_img(post_id, img_show_num[post_id]);
			$('#preivew_box_' + post_id + ' .right').show();
		}
		if (img_show_num[post_id] == 0){
			$('#preivew_box_' + post_id + ' .left').hide();
		}
		
	})
}
$('ul.img_thumb li').click(function(){
	var show_eq = $(this).index();
	var show_id;
	post_id = $(this).parent().attr('date-postid');
	$('#thumn_' + post_id).hide();
	$('#preivew_box_' + post_id).show();
	var img_count = $('#preivew_box_' + post_id + ' .count').text();

	if (img_count > 1){
		if (show_eq != (img_count -1)){
			$('#preivew_box_' + post_id + ' .right').show();
		}
		if (show_eq != 0) {
			$('#preivew_box_' + post_id + ' .left').show();
		}
	}

	$('#preivew_box_' + post_id + ' .close-back').click(function(){
		console.log(333);
		$('#thumn_' + post_id).show();
		$('#preivew_box_' + post_id).hide();
	})

	show_img(post_id,show_eq);
	img_show_num[post_id] = show_eq;
	makePreNextListesn(post_id,img_count);
});




</script>
<?php get_footer(); ?>