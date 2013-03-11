<aside id="cat_list" class="widget">
<h3 class="widget-title">分类目录</h3>
<ul>
<?php wp_list_categories(array(
						'style' 	=> 'list',
						'title_li' 	=> '',
						'show_count'=> 1,
						'orderby' => 'ID', 
						'exclude' => '26,1,25'
						)); ?> 
</ul>
</aside>