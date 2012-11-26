<?php get_header(); ?>
<div id='main'>
	<!-- 主体内容 -->
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part('content','category'); ?>

		<?php endwhile; ?>
		<div class="navigation">
 			<div class="alignleft"><?php previous_posts_link('&laquo; 上一页') ?></div>
 			<div class="alignright"><?php next_posts_link('下一页 &raquo;','') ?></div>
 		</div>
	</div>
</div>
<!-- 侧边栏 -->
<?php get_sidebar(); ?>
<?php get_footer();?>