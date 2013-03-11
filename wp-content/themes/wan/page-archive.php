<?php
/*
Template Name: archives
*/

get_header();
?>
<div class="breadcrumbs">
	您的位置：
<?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div>
<div class="main-left">

	<div id="content">
	<?php 
	aeUpdateCache();
	wp_easyarchives(); 
	?>
	</div>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer();?>
