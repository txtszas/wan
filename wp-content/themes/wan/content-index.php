<article id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" >
			<?php the_title(); ?>
			</a>
		</h1>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
			<a href="<?php echo get_permalink(); ?>"> [ Read More → ]</a>
		</div>

		<div class="entry-meta">
			<?php wan_posted_on(); ?>
		</div><!-- .entry-meta -->

	</header>



</article>