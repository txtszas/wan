<?php
/*
Template Name: archives
*/

get_header();
?>
<div class="main-left">
	<div class="breadcrumbs">
		您的位置：
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
	</div>
	<div id="content">
	<?php wp_get_archives('type=daily'); ?>
	</div>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer();?>
