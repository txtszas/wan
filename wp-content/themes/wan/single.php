<?php get_header(); ?>
<div class="row">
	<!-- 主体内容 -->
	<div class="span8">

		<?php while ( have_posts() ) : the_post(); ?>


					<?php get_template_part( 'content', 'read' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>
				<div class="ujian-hook"></div>
	</div>

	<div class="span4">
	 	<?php get_sidebar(); ?>
	 </div>
</div>



<?php get_footer(); ?>