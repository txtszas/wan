<article id="post-<?php the_ID(); ?>">
	<?php $categories = get_the_category($post->ID);
	?>
	<div class="entry-title">
		<div class="cat-title">
			<h4 class="cat_<?php echo $categories[0]->cat_ID;?>">
				<a href="<?php echo get_category_link($categories[0]->term_id) ?>"><?php echo $categories[0]->name;?></a>
			</h4>
		</div>	
		<h2><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></h2>
		<div class="clear"></div>
	</div>
	<div class="entry-meta">
		<div class="post_on"><?php wan_posted_on(); ?></div>
		
		<div class="commit-views">
			<span class="commits" title="评论"><?php echo $post->comment_count; ?>

				<div class="commit-arrow"></div>
			</span>
		</div>
		<div class="clear"></div>
	</div>
	<div class="entry-excerpt of">
		<?php the_content();?>
	</div>
	<div>
		<?php GetWtiLikePost(); ?>
	</div>
	<div class="clear"></div>
	<div class="pre-next">
		<?php previous_post_link('%link', '上一篇'); ?>
			<?php next_post_link('%link', '下一篇'); ?> 
	</div>
</article>
<style type="text/css">
#content img{
	max-width: 680px;
	height: auto;
}

</style>
