<?php
/*
Template Name: archives
*/

get_header();
?>

<div class="row">
	<div class="span8">
		<?php wp_get_archives('type=daily'); ?>
	</div>
	<div class="span4">
	 	<?php get_sidebar(); ?>
	</div>

</div>

<?php get_footer();?>
