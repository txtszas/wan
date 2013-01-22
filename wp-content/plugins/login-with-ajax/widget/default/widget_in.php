<?php 
/*
 * This is the page users will see logged in. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>
<?php
	global $current_user;
	if( $is_widget ){
		echo $before_widget . $before_title . '<span id="LoginWithAjax_Title">' . __( 'Hi', 'login-with-ajax' ) . " " . $current_user->display_name  . '</span>' . $after_title;
	}else{
		//If you want the AJAX login widget to work without refreshing the screen upon login, this is needed for the widget title to update.
		echo '<span id="LoginWithAjax_Title_Substitute" style="display:none">' . __( 'Hi', 'login-with-ajax' ) . " " . $current_user->display_name  . '</span>';
	}
?>
<div id="LoginWithAjax">
	<?php 
		global $current_user;
		global $user_level;
		global $wpmu_version;
		get_currentuserinfo();
	?>
				<?php
					//Admin URL
					if (1) {
						if( function_exists('bp_loggedin_user_link') ){
							?>
							<a href="<?php bp_loggedin_user_link(); ?>"><?php echo strtolower(__('Profile')) ?></a><br/>
							<?php	
						}else{
							?>
							<a href="<?php bloginfo('wpurl') ?>/wp-admin/profile.php">设置</a><br/>
							<?php	
						}
					}
					//Logout URL
					?>
				<a id="wp-logout" href="<?php echo wp_logout_url() ?>"><?php echo strtolower(__( 'Log Out' )) ?></a>
</div>
<?php
	if( $is_widget ){
		echo $after_widget;
	}
?>