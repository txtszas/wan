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
		<div class="search-form">
			<div class="search-field">
			<?php 
				/* Search Count */
				$allsearch = new WP_Query("s=$s&showposts=-1");
				$count = $allsearch->post_count ? $allsearch->post_count : 0;
				get_search_form(); 
			?>
			</div>

			<div class="search-result">
				<?php echo $count; ?>个结果
			</div>

		</div>
		<?php if (have_posts()) : ?>

			<?php 
			while ( have_posts() ) : the_post(); 
				get_template_part('content','index'); 
			endwhile; 
			?>
		<?php else : ?>
		<div class="no-result">
			<h2>未找到</h2>
			<p>抱歉，没有符合您搜索条件的结果。请换其他关键词再试试。</p>

		</div>
			
			
		<?php endif; ?>
	</div>
	<?php wp_pagenavi(array(),1); ?>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<!-- 侧边栏 -->
<?php get_footer();?>