<div id="sidebar" class="well">
<?php
if (is_home()){
?>

<img src="<?php echo get_template_directory_uri(); ?>/images/2wei.jpg" class="ad-img">
<?php

	include (TEMPLATEPATH . '/piece.php');
	include (TEMPLATEPATH . '/rss.php');
	dynamic_sidebar( 'sidebar-index');
}

if (is_category()){
	dynamic_sidebar( 'sidebar-category');
}

if (is_single()){
	dynamic_sidebar( 'sidebar-read');
}

if (is_page()){
	dynamic_sidebar( 'sidebar-page');
}
?>
</div>

