<?php
/*
Plugin Name: Smart Video
Plugin URI: http://www.imallen.com/blog/works/smart-video-plugin-for-wordpress
Description: Plugin to insert videos from Youku, Tudou, QQ Video and some other online video sites (mainly supporting chinese sites).
Version: 1.5.1
Author: Allen Hsu
Author URI: http://www.imallen.com
*/

define('SMARTVIDEO_URLPATH', WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__) ) . '/');
include_once (dirname(__FILE__) . '/tinymce/tinymce.php');

function avideo_shortcode($atts, $content = null, $code) {
	if($code == "flash") {
		if(!isset($atts['url']) || empty($atts['url'])) {
			return 'Warning: flash URL not specified!';
		}
	} else if(!isset($atts['id']) || empty($atts['id'])) {
		return 'Warning: video ID not specified!';
	}
	$swf_url = '';
	$vars = '';
	$swf_w = 400;
	$swf_h = 300;
	switch($code) {
		case 'youtube':
			$swf_url = 'http://www.youtube.com/v/' . $atts['id'];
			$swf_w = 425;
			$swf_h = 344;
			break;
		case 'tudou':
			$swf_url = 'http://www.tudou.com/v/' . $atts['id'];
			$swf_w = 420;
			$swf_h = 363;
			break;
		case 'youku':
			$swf_url = 'http://player.youku.com/player.php/sid/' . $atts['id'] . '/v.swf';
			$swf_w = 480;
			$swf_h = 400;
			$vars = 'isShowRelatedVideo=false&showAd=0&show_pre=1&show_next=1&isAutoPlay=false&isDebug=false&UserID=&winType=interior&playMovie=true&MMControl=false&MMout=false&RecordCode=1001,1002,1003,1004,1005,1006,2001,3001,3002,3003,3004,3005,3007,3008,9999';
			break;
		case 'ku6':
			$swf_url = 'http://player.ku6.com/refer/' . $atts['id'] . '/v.swf';
			$swf_w = 480;
			$swf_h = 400;
			break;
		case 'qq':
			$swf_url = 'http://video.qq.com/res/qqplayerout.swf?vid=' . $atts['id'];
			$swf_w = 500;
			$swf_h = 418;
			break;
		case 'sina':
			$swf_url = 'http://p.you.video.sina.com.cn/player/outer_player.swf?auto=1&vid=' . $atts['id'];
			$swf_w = 482;
			$swf_h = 388;
			break;
		case 'sohu':
			$swf_url = 'http://v.blog.sohu.com/fo/v4/' . $atts['id'];
			$swf_w = 480;
			$swf_h = 389;
			break;
		case 'vimeo':
			$swf_url = 'http://vimeo.com/moogaloop.swf?clip_id=' . $atts['id'];
			$swf_w = 480;
			$swf_h = 270;
			break;
		case 'flash':
			$swf_url = SMARTVIDEO_URLPATH . 'player.swf';
			$vars = 'file=' . rawurlencode($atts['url']);
			if(isset($atts['h']) && !empty($atts['h'])) {
				$atts['h'] += 19;
			}
			break;
		case 'mofile':
			$swf_url = 'http://tv.mofile.com/cn/xplayer.swf?v=' . $atts['id'];
			$swf_w = 500;
			$swf_h = 358;
			break;
		default:
			break;
	}
	if(isset($atts['w']) && !empty($atts['w'])) {
		$swf_w = $atts['w'];
	}
	if(isset($atts['h']) && !empty($atts['h'])) {
		$swf_h = $atts['h'];
	}
	$swf_code = '<object width="' . $swf_w . '" height="' . $swf_h . '"><param name="movie" value="' . $swf_url . '"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="never"></param><param name="allownetworking" value="internal"></param><param name="flashvars" value="' . $vars . '" /><embed src="' . $swf_url . '" type="application/x-shockwave-flash" allowscriptaccess="never" allownetworking="internal" allowfullscreen="true" width="' . $swf_w . '" height="' . $swf_h . '" flashvars="' . $vars . '"></embed></object>';
	return $swf_code;
}

add_shortcode('youtube', 'avideo_shortcode');
add_shortcode('tudou', 'avideo_shortcode');
add_shortcode('youku', 'avideo_shortcode');
add_shortcode('ku6', 'avideo_shortcode');
add_shortcode('qq', 'avideo_shortcode');
add_shortcode('sina', 'avideo_shortcode');
add_shortcode('sohu', 'avideo_shortcode');
add_shortcode('vimeo', 'avideo_shortcode');
add_shortcode('mofile', 'avideo_shortcode');
add_shortcode('flash', 'avideo_shortcode');
?>