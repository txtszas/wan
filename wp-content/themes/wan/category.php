<?php get_header(); ?>
<style type="text/css">
article .entry-title h2{
	margin-left: 0;
}
</style>
<div class="breadcrumbs">
	您的位置：
<?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>
<?php
	$categories = get_the_category();
	$cate = getReadCate($categories);
?>
<div class="main-left">
<!-- .breadcrumbs -->

	<div class="category-title">
		<h2 class="cat-<?php echo $cat ?>"><?php echo $cate->name ?></h2>
		<div class="cat_desc">
			<?php echo $cate->description; ?>
		</div>
	</div>
	<div id="content">
		<?php 
		while ( have_posts() ) : the_post(); 
			get_template_part('content','category'); 
		endwhile; 
		?>
	</div>
	<?php wp_pagenavi(array(),1); ?>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<!-- 侧边栏 -->
<?php get_footer();?>