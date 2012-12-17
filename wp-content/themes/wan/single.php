<?php get_header(); ?>

	<!-- 主体内容 -->
	<div class="breadcrumbs">
	您的位置：
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
	</div><!-- .breadcrumbs -->
<div class="clear"></div>
<div class="main-left">
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>


					<?php get_template_part( 'content', 'read' ); ?>

					<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		<div class="ujian-hook"></div>
		<div class="clear"></div>
	</div>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>