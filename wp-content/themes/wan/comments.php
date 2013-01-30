<div id="commits">
<h2>本文评论</h2>
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyeleven' ); ?></p>
</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<ol class="commentlist">
<?php if ( have_comments() ) : ?>

	
		<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use twentyeleven_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define twentyeleven_comment() and that will be used instead.
				 * See twentyeleven_comment() in twentyeleven/functions.php for more.
				 */
				wp_list_comments( array('callback' => 'wan_comment') );
			?>
		
<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments">评论已经关闭</p>
	<?php endif; ?>
</ol>
	<?php wan_comment_form(); ?>

</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/comment.js"></script>
<script type="text/javascript">
!function($){
	 $(1).comment(<?php echo $id ?>);
}(window.jQuery)
	
</script>
