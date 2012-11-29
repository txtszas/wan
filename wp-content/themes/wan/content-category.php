<article id="post-<?php the_ID(); ?>" class="well">
	<header class="entry-header">
		<h1 class="entry-title">
			

			<?php 
				if ( $cat == 4){
			?>
				<?php the_content();?>
			<?php }else{ ?>
			<a href="<?php the_permalink() ?>" >
				<?php the_title();?>
			</a>
			<?php the_content();?>
			<?php } ?>
		</h1>
	</header>
</article>