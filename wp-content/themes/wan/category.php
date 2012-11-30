<?php get_header(); ?>
<div class="main-left">
	<div class="breadcrumbs">
		您的位置：
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
	</div><!-- .breadcrumbs -->
	<div id="content">
		<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part('content','index'); ?>

		<?php endwhile; ?>
	</div>
	<?php wp_pagenavi(); ?>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<!-- 侧边栏 -->
<?php get_footer();?>