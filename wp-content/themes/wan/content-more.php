<li><?php $categories = get_the_category($post->ID);
		  $cate = getReadCate($categories);
	?>
	<?php
		echo $cate->name;
	?>
	|
	<a href="<?php the_permalink() ?>" class="title">
	<?php
		the_title();
	?>
	</a>
</li>