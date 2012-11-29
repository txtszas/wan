<?php
/*
Template Name: more
*/

get_header();
?>

<div class="row">
	<div class="span8">
			<?php query_posts('posts_per_page=30');?>
		<!-- 主体内容 -->
			<?php while ( have_posts() ) : the_post(); ?>

						<ul>
							<li><a href="<?php the_permalink() ?>"><?php the_title()?></a></li>
						</ul>

			<?php endwhile; ?>
			<div class="pager">
				<ul>
					<li class="previous"><?php previous_posts_link('&laquo; 上一页') ?></li>
					<li class="next"><?php next_posts_link('下一页 &raquo;','') ?></li>
				</ul>
	 		</div>
		</div>

	

<!-- 侧边栏 -->
	 <div class="span4">
	 	<?php get_sidebar(); ?>
	 </div>


</div>



<?php get_footer(); ?>