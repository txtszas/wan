<?php
/**
 * ajax comment to wp
 * @author skytao
 */

/** Sets up the WordPress Environment. */
require( dirname(__FILE__) . '/wp-load.php' );
nocache_headers();
$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
$post = get_post($comment_post_ID);

//不存在的comment_id

if ( empty($post->comment_status) ) {
	do_action('comment_id_not_found', $comment_post_ID);
	response_error('comment_id_not_found');
	exit;
}

$status = get_post_status($post);

$status_obj = get_post_status_object($status);

if ( !comments_open($comment_post_ID) ) {
	do_action('comment_closed', $comment_post_ID);
	response_error('Sorry, comments are closed for this item.');
	exit;
} elseif ( 'trash' == $status ) {
	do_action('comment_on_trash', $comment_post_ID);
	response_error('comment_on_trash');
	exit;
} elseif ( !$status_obj->public && !$status_obj->private ) {
	do_action('comment_on_draft', $comment_post_ID);
	response_error('comment_on_trash');
	exit;
} elseif ( post_password_required($comment_post_ID) ) {
	response_error('comment_on_password_protected');
	do_action('comment_on_password_protected', $comment_post_ID);
	exit;
} else {
	//response_error('pre_comment_on_post');
	do_action('pre_comment_on_post', $comment_post_ID);
}

$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
$user = wp_get_current_user();
if ( $user->exists() ) {
	if ( empty( $user->display_name ) )
		$user->display_name=$user->user_login;
	$comment_author       = $wpdb->escape($user->display_name);
	$comment_author_email = $wpdb->escape($user->user_email);
	$comment_author_url   = $wpdb->escape($user->user_url);
	if ( current_user_can('unfiltered_html') ) {
		if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
			kses_remove_filters(); // start with a clean slate
			kses_init_filters(); // set up the filters
		}
	}
} else {
	if ( get_option('comment_registration') || 'private' == $status ){
		response_error('对不起，您必须登录才能发表评论');
		exit;
	}

}
$comment_type = '';
if ( get_option('require_name_email') && !$user->exists() ) {
	if ( 6 > strlen($comment_author_email) || '' == $comment_author )
	{
		response_error('请填写昵称和邮箱');
		exit;
	}
		
	elseif ( !is_email($comment_author_email)){
		response_error('请填写有效的邮箱');
		exit;
	}
}
if ($comment_content == '') {
	response_error('评论内容为空');
	exit;
}

$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');
$comment_id = wp_new_comment( $commentdata );
if (isset($comment_id)) {
	$comment = get_comment($comment_id);
	response_success($comment);
}


// do_action('set_comment_cookies', $comment, $user);
function response_success($comment){
	$avatar_size = 52;
	if ( '0' != $comment->comment_parent )
		$avatar_size = 32;
	$avatar = get_avatar( $comment, $avatar_size );
	$response = array(
				'status'	=> 'success',
				'data'		=>  array(
						'avatar' => $avatar,
						'author' => $comment->comment_author,
						'comment_date' => $comment->comment_date,
						'comment_text' => $comment->comment_content,
						'comment_id'   => $comment->comment_ID,
						'comment_class'=>  join(' ',get_comment_class('',$comment->comment_ID,$comment_post_ID)),
						'comment_parent'=> $comment->comment_parent
					)
		);
	echo json_encode($response);

}

function response_error($message){
	$response = array(
				'status'	=> 'error',
				'error'		=> $message
				);
	echo json_encode($response);
}