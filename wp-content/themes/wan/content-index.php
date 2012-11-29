<article id="post-<?php the_ID(); ?>" class="well">
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" >
			<?php the_title(); ?>
			</a>
		</h1>
		<div class="entry-excerpt of">
			<?php the_excerpt(); ?>
			<?php get_template_part('imageshow'); ?>
		</div>

		<div class="entry-meta">
			<?php wan_posted_on(); ?>
			<a href="<?php echo get_permalink(); ?>" class="btn">继续阅读</a>
		</div><!-- .entry-meta -->

	</header>
</article>