<article id="post-<?php the_ID(); ?>" class="well">
	<?php $categories = get_the_category($post->ID);
	?>
	<div class="entry-title">
		<div class="cat-title">
			<a href="<?php echo get_category_link($categories[0]->term_id) ?>">
				<h4 class="cat_<?php echo $categories[0]->cat_ID;?>">
					<?php echo $categories[0]->name;?>
				</h4>
			</a>
		</div>	
		<h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
		<div class="clear"></div>
	</div>
	<div class="entry-meta">
		<div class="post_on"><?php wan_posted_on(); ?></div>
		<div class="clear"></div>
	</div>
	<div class="entry-excerpt of">
		<?php the_content(); ?>
	</div>
	<div class="clear"></div>
	<div class="ding-cai">
		<?php GetWtiLikePost(); ?>
	</div>
	<div class="commit-views">
		<div class="commit-box"><?php echo $post->comment_count; ?>评论</div>
	</div>
	<div class="clear"></div>
</article>
<div class="clear"></div>