<?php
/*
Template Name: archives
*/

get_header();
?>


<div id='main'>
	<!-- 主体内容 -->
	<div id="content">
		<?php wp_get_archives(); ?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer();?>
