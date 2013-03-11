<?php
/*
Plugin Name: WP-EasyArchives
Plugin URI: http://www.neoease.com/plugins/
Description: Display your archive tree on custom page, it's more faster and search engine friendly.
Version: 3.1.2
Author: mg12
Author URI: http://www.neoease.com/
*/

/* core functions */
/* ------------------------------------------------------------ */
include ('core.php');
/* ------------------------------------------------------------ */
/* core functions */

/* l10n */
/* ------------------------------------------------------------ */
load_plugin_textdomain('wp-easyarchives', "/wp-content/plugins/wp-easyarchives/languages/");
/* ------------------------------------------------------------ */
/* l10n */

/* options */
/* ------------------------------------------------------------ */
class WPEasyArchivesOptions {

	function getOptions() {
		$options = get_option('wp_easyarchives_options');
		if(!is_array($options)) {
			$options['use_css'] = true;
			$options['js_type'] = 'normal';
			$options['jquery_url'] = '';
			$options['mode'] = 'last';
			$options['page'] = false;
			$options['external'] = false;
			$options['comment_count'] = false;
			$options['cache']['all'] = eaGetArchives('', '', $options);

			update_option('wp_easyarchives_options', $options);
		}
		return $options;
	}

	function add() {
		if(isset($_POST['wp_easyarchives_save'])) {
			$options = WPEasyArchivesOptions::getOptions();

			if(!$_POST['use_css']) {
				$options['use_css'] = (bool)false;
			} else {
				$options['use_css'] = (bool)true;
			}

			$options['js_type'] = $_POST['js_type'];
			$options['jquery_url'] = stripslashes($_POST['jquery_url']);
			$options['mode'] = $_POST['mode'];

			if($_POST['page']) {
				$options['page'] = (bool)true;
			} else {
				$options['page'] = (bool)false;
			}

			if($_POST['external']) {
				$options['external'] = (bool)true;
			} else {
				$options['external'] = (bool)false;
			}

			if($_POST['comment_count']) {
				$options['comment_count'] = (bool)true;
			} else {
				$options['comment_count'] = (bool)false;
			}

			$options['cache']['all'] = eaGetArchives('', '', $options);

			update_option('wp_easyarchives_options', $options);

		} else {
			WPEasyArchivesOptions::getOptions();
		}

		add_options_page(__('WP-EasyArchives', 'wp-easyarchives'), __('WP-EasyArchives', 'wp-easyarchives'), 10, basename(__FILE__), array('WPEasyArchivesOptions', 'display'));
	}

	function display() {
		$options = WPEasyArchivesOptions::getOptions();
?>

<div class="wrap">
	<div class="icon32" id="icon-options-general"><br /></div>
	<h2><?php _e('WP-EasyArchives Options', 'wp-easyarchives'); ?></h2>

	<?php if(!empty($_POST)) : ?>
		<div class='updated fade'><p><?php _e('Settings <strong>saved</strong>.', 'wp-easyarchives'); ?></p></div>
	<?php endif; ?>

	<div id="poststuff" class="has-right-sidebar">
		<div class="inner-sidebar">
			<div id="donate" class="postbox" style="border:2px solid #080;">
				<h3 class="hndle" style="color:#080;cursor:default;"><?php _e('Donation', 'wp-easyarchives'); ?></h3>
				<div class="inside">
					<p><?php _e('If you like this plugin, please donate to support development and maintenance!', 'wp-easyarchives'); ?></p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
						<div>
							<input type="hidden" name="cmd" value="_s-xclick" />
							<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----" />
							<input style="border:none;" type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" name="submit" alt="" />
							<img alt="" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" style="height:1px;width:1px;" />
						</div>
					</form>
				</div>
			</div>

			<div class="postbox">
				<h3 class="hndle" style="cursor:default;"><?php _e('About Author', 'wp-easyarchives'); ?></h3>
				<div class="inside">
					<ul>
						<li><a href="http://www.neoease.com/"><?php _e('Author Blog', 'wp-easyarchives'); ?></a></li>
						<li><a href="http://www.neoease.com/plugins/"><?php _e('More Plugins', 'wp-easyarchives'); ?></a></li>
					</ul>
				</div>					
			</div>
		</div>

		<div id="post-body">
			<div id="post-body-content">

				<form action="#" method="post" enctype="multipart/form-data" name="wp_easyarchives_form">
					<table class="form-table">
						<tbody>

							<tr valign="top">
								<th scope="row"><?php _e('CSS', 'wp-easyarchives'); ?></th>
								<td>
									<label>
										<input name="use_css" type="checkbox" <?php if($options['use_css']) echo 'checked="checked"'; ?> />
										 <?php _e('Use wp-easyarchives.css.', 'wp-easyarchives'); ?>
									</label>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><?php _e('JavaScript Library', 'wp-easyarchives'); ?></th>
								<td>
									<label style="margin-right:20px;">
										<input name="js_type" type="radio" value="normal" <?php if($options['js_type'] != 'custom_jquery' && $options['js_type'] != 'wp_jquery') echo "checked='checked'"; ?> />
										 <?php _e('Use normal JavaScript library that is supported by this plugin.', 'wp-easyarchives'); ?>
									</label>
									<br />
									<label>
										<input name="js_type" type="radio" value="wp_jquery" <?php if($options['js_type'] == 'wp_jquery') echo "checked='checked'"; ?> />
										 <?php _e('Use jQuery library that is supported by WordPress.', 'wp-easyarchives'); ?>
									</label>
									<br />
									<label>
										<input name="js_type" type="radio" value="custom_jquery" <?php if($options['js_type'] == 'custom_jquery') echo "checked='checked'"; ?> />
										 <?php _e('Custom jQuery.', 'wp-easyarchives'); ?>
									</label>
									 <label>
										<?php _e('Please input the URL of jQuery:', 'wp-easyarchives'); ?>
										 <input type="text" name="jquery_url" class="code" size="40" value="<?php echo($options['jquery_url']); ?>" />
									</label>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><?php _e('Display Mode', 'wp-easyarchives'); ?></th>
								<td>
									<select name="mode" size="1">
										<option value="all" <?php if($options['mode'] != 'none') echo ' selected '; ?>><?php _e('Expand all', 'wp-easyarchives'); ?></option>
										<option value="none" <?php if($options['mode'] == 'none') echo ' selected '; ?>><?php _e('Collapse all', 'wp-easyarchives'); ?></option>
									</select> <?php _e('by default.', 'wp-easyarchives'); ?>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><?php _e('Post Items', 'wp-easyarchives'); ?></th>
								<td>
									<label>
										<input name="page" type="checkbox" <?php if($options['page']) echo 'checked="checked"'; ?> />
										 <?php _e('Show page items.', 'wp-easyarchives'); ?>
									</label>
									<br />
									<label>
										<input name="comment_count" type="checkbox" <?php if($options['comment_count']) echo 'checked="checked"'; ?> />
										 <?php _e('Show comment counts.', 'wp-easyarchives'); ?>
										<p class="description"><?php _e('Update the comment counts when (1) posts are updated, (2) plugin options are updated and (3) everyday 0:00AM.', 'wp-easyarchives'); ?></p>
									</label>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><?php _e('Links', 'wp-easyarchives'); ?></th>
								<td>
									<label>
										<input name="external" type="checkbox" <?php if($options['external']) echo 'checked="checked"'; ?> />
										 <?php _e('Open link in new tab/window.', 'wp-easyarchives'); ?>
									</label>
								</td>
							</tr>

						</tbody>
					</table>

					<p class="submit">
						<input class="button-primary" type="submit" name="wp_easyarchives_save" value="<?php _e('Save Changes', 'wp-easyarchives'); ?>" />
					</p>
				</form>

			</div>
		</div>

	</div>
</div>

<?php
	}
}

add_action('admin_menu', array('WPEasyArchivesOptions', 'add'));
/* ------------------------------------------------------------ */
/* options */

/* hooks */
/* ------------------------------------------------------------ */
function aeUpdateCache() {
	$options = get_option('wp_easyarchives_options');
	$options['cache']['all'] = eaGetArchives('', '', $options);
	update_option('wp_easyarchives_options', $options);
}
add_action('save_post', 'aeUpdateCache');
add_action('delete_post', 'aeUpdateCache');

// update cache schedule.
$options = get_option('wp_easyarchives_options');
if($options['comment_count']) {
	function aeGetTomorrowZero() {
		$offsetHour = 24 + get_option('gmt_offset');
		$date = date('Y-m-d 00:00:00', strtotime($offsetHour . ' hours', time()));
		return strtotime($date);
	}
	wp_schedule_event(aeGetTomorrowZero(), 'daily', 'wp_easyarchives_cache_update');
	add_action('wp_easyarchives_cache_update', 'aeUpdateCache');
} else {
	remove_action('wp_easyarchives_cache_update', 'aeUpdateCache');
	wp_clear_scheduled_hook('wp_easyarchives_cache_update');
}

function aeLoadStatic() {
	$options = get_option('wp_easyarchives_options');
	$plugins_version = '3.1.2';
	$plugins_url = plugins_url('wp-easyarchives');
	$plugins_css_url = $plugins_url . '/css';
	$plugins_css_media = 'screen';

	// CSS
	if($options['use_css']) {
		if(file_exists(TEMPLATEPATH . '/wp-easyarchives.css')){
			wp_enqueue_style('wp-easyarchives-custom', get_bloginfo('template_url') . '/wp-easyarchives.css', array(), $plugins_version, $plugins_css_media);
		} else {
			wp_enqueue_style('wp-easyarchives', $plugins_css_url . '/wp-easyarchives.css', array(), $plugins_version, $plugins_css_media);
		}
	}
}
add_action('template_redirect', 'aeLoadStatic');

function aeFooter() {
	global $hasEasyArchive;
	if(!$hasEasyArchive) {
		return false;
	}

	$options = get_option('wp_easyarchives_options');
	$plugins_version = '3.1.2';
	$plugins_url = plugins_url('wp-easyarchives');
	$plugins_js_url = $plugins_url . '/js';
?>
<script>
/* <![CDATA[ */
var aeGlobal = {
	serverUrl		:'<?php bloginfo('url'); ?>',
	loadingText		:'<?php _e('loading', 'wp-easyarchives'); ?>',
	mode			:'<?php echo $options['mode']; ?>',
	external		:'<?php echo $options['external']; ?>'
};
/* ]]> */
</script>
<?php

	// JavaScript
	if($options['js_type'] == 'normal') {
		wp_enqueue_script('wp-easyarchives', $plugins_js_url . '/wp-easyarchives.js', array(), $plugins_version, true);

	} else {
		if($options['js_type'] == 'custom_jquery') {
			if($options['jquery_url'] != '') {
				wp_enqueue_script('wp-easyarchives-lib', $options['jquery_url'], array(), $plugins_version, true);
			}
			wp_enqueue_script('wp-easyarchives-jquery', $plugins_js_url . '/wp-easyarchives-jquery.js', array(), $plugins_version, true);
		} else {
			wp_enqueue_script('wp-easyarchives-jquery-with-lib', $plugins_js_url . '/wp-easyarchives-jquery.js', array('jquery'), $plugins_version, true);
		}
	}
}
add_action('wp_footer', 'aeFooter');
/* ------------------------------------------------------------ */
/* hooks */
?>