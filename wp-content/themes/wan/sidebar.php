<div id="sidebar" class="well">
<?php
if (is_home()){
?>
<a href="/office" title="一起午餐吧">
	<img src="<?php echo get_template_directory_uri(); ?>/images/office.jpg" class="ad-img">
</a>
<?php

	include (TEMPLATEPATH . '/rss.php');
	include (TEMPLATEPATH . '/piece.php');
?>
<a href="/itstore" title="新春心好礼">
	<img src="<?php echo get_template_directory_uri(); ?>/images/itstore.jpg" class="ad-img">
</a>
<?php
	dynamic_sidebar( 'sidebar-index');
}

if (is_category()){
	include (TEMPLATEPATH . '/categorylist.php');
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

