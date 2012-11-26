<aside id="meta" class="widget">
	<h3 class="widget-title">功能</h3>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<?php wp_meta(); ?>
		<a href="<?php bloginfo_rss('rss_url'); ?>">订阅</a> 
	</ul>
</aside>