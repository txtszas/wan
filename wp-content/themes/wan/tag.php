<?php get_header(); ?>
<div class="breadcrumbs">
	您的位置：
<?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>

<div class="main-left">
<!-- .breadcrumbs -->
	<div id="content">
		<?php 
		while ( have_posts() ) : the_post(); 
			get_template_part('content','index'); 
		endwhile; 
		?>
	</div>
	<?php wp_pagenavi(array(),1); ?>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<!-- 侧边栏 -->
<?php get_footer();?>