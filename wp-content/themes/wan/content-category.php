<article id="post-<?php the_ID(); ?>" class="well">
	<?php $categories = get_the_category($post->ID);
	?>
	<div class="entry-title">
		<h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
		<div class="clear"></div>
	</div>
	<div class="entry-meta">
		<div class="post_on"><?php wan_posted_on(); ?></div>
		<div class="commit-views">
			<span class="commits"><?php echo $post->comment_count; ?>
				<div class="commit-arrow"></div>
			</span>
		</div>
		<div class="clear"></div>
	</div>
	<div class="entry-excerpt of">
		<?php the_excerpt(); ?>
	</div>
	<div class="img-review">
		<?php
			get_template_part('imageshow'); 
		?>
	</div>
	<div class="clear"></div>
	<div class="entry-more">
		<a href="<?php echo get_permalink(); ?>" class="btn">阅读全文>></a>
	</div>
	


</article>
<div class="clear"></div>