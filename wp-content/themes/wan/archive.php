<?php get_header(); ?>
<div class="row">
	<div class="span8">
		<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part('content','index'); ?>

		<?php endwhile; ?>
			<div class="pager">
				<ul>
					<li class="previous"><?php previous_posts_link('&laquo; 上一页') ?></li>
					<li class="next"><?php next_posts_link('下一页 &raquo;','') ?></li>
				</ul>
	 		</div>
	</div>
	<div class="span4">
	 	<?php get_sidebar(); ?>
	 </div>


</div>
<!-- 侧边栏 -->
<?php get_footer();?>