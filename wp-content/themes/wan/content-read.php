<article id="post-<?php the_ID(); ?>">
		<?php $categories = get_the_category($post->ID);
		  $cate = getReadCate($categories);
	?>
	<div class="entry-title">
		<div class="cat-title">
			<h4 class="cat_<?php echo $cate->cat_ID;?>">
				<a href="<?php echo get_category_link($cate->term_id) ?>"><?php echo $cate->name;?></a>
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
	<div class="tag-pn">
		<div class="tags">
			<?php the_tags(); ?>
		</div>
		<div class="clear"></div>
		<div class="from">
		<?php
			$from_name = get_post_meta($post->ID, "article_from_name_value", true);
    // 自定义字段名称为 keywords_value
    		$from_link = get_post_meta($post->ID, "article_from_link_value", true);
		if ($from_name && $from_link && 0){
		?>
		来自：<a href="<?php echo $from_link ?>" target="_blank"><?php echo $from_name ?></a>
		<?php }?>
		大咖汇链接：<a href="<?php echo the_permalink() ?>" target="_blank"><?php echo the_permalink() ?></a>
		</div>
		<div class="pre-next">
			<?php previous_post_link('%link', '上一篇'); ?>
			<?php next_post_link('%link', '下一篇'); ?> 
		</div>
	</div>
	<div class="clear"></div>
	<div>
		<?php GetWtiLikePost(); ?>
	</div>
	<div class="clear"></div>



</article>
<style type="text/css">
#content img{
	max-width: 680px;
	height: auto;
}
article{
	padding: 0;
	border-bottom: 0;
}
article p{
		margin-top: 1em;
		margin-bottom: 1em;
	}
.main-left{
	width: 638px;
	padding: 0 28px 100px 34px;
}
article .entry-title h2{
	margin-left: 67px;
}


</style>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?move=0&amp;btn=r4.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
