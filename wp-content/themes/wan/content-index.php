<article id="post-<?php the_ID(); ?>" class="well">
	<?php $categories = get_the_category($post->ID);
	?>
	<div class="entry-title">
		<h4 class="cat_<?php echo $categories[0]->cat_ID;?>">
			<a href="<?php echo get_category_link($categories[0]->term_id) ?>"><?php echo $categories[0]->name;?></a></h4>
		<h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
		<div class="clear"></div>
	</div>
	<div class="entry-meta">
		<div class="post_on"><?php wan_posted_on(); ?></div>
		<div class="commit-views">
			<span class="views">333人围观</span>
			<span class="commits"><?php echo $post->comment_count; ?>条评论</span>
		</div>
		<div class="clear"></div>
	</div>
	<div class="entry-excerpt of">
		<?php the_excerpt(); ?>
	</div>
	<div class="img-review">
		<?php get_template_part('imageshow'); ?>
	</div>
	<div class="entry-more">
		<a href="<?php echo get_permalink(); ?>" class="btn">阅读全文>></a>
	</div>
	


</article>