<?php
/*
Template Name: more
*/

get_header();
?>
<div class="breadcrumbs">
	您的位置：
<?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>
</div><!-- .breadcrumbs -->
<div class="clear"></div>
<div class="main-left">
	<div id="content">
		<!-- 今日更新 -->

		<?php 
			$today = getdate();
			$query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"] . '&posts_per_page=-1' );
			if ($query->have_posts()){
		?>
			<div class="today-line">
				<h2>每日更新</h2>
			</div>
 			<ul class="more-ul">
		<?php	
				while ( $query->have_posts() ) : $query->the_post();
					get_template_part('content','more');
				endwhile;
		?>
			</ul>
		<?php
			}
		?>
		
		<!-- 本月文章，按日输出 -->

		<?php
		if ($today["mday"] > 1) {
			for ($i = $today["mday"] - 1; $i > 0  ; $i--) { 
				$query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $i . '&posts_per_page=-1' );
				if ($query->have_posts() ) {
		?>
				<div class="day-line">
				<h2><?php echo $today["mon"] . '-' . $i ?></h2>
				</div>
				<ul class="more-ul">

		<?php
					

					while ( $query->have_posts() ) : $query->the_post();
						get_template_part('content','more');
					endwhile;
		?>
				</ul>
		<?php
				}
			}
		}
		?>

		<!-- 今年文章，按月输出 -->


		<?php
		if ($today["mon"] > 1) {
			for ($i = $today["mon"] - 1; $i > 0  ; $i--) { 
				$query = new WP_Query( 'year=' . $today["year"] . '&monthnum=' . $i . '&posts_per_page=-1' );
				if ($query->have_posts() ) {
		?>
				<div class="day-line">
				<h2><?php echo $i . '月' ?></h2>
				</div>
				<ul class="more-ul">
		<?php
				while ( $query->have_posts() ) : $query->the_post();
					get_template_part('content','more');
				endwhile;
		?>
				</ul>
		<?php
				}
			}
		}
		?>

	</div> 
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>

<?php get_footer(); ?>