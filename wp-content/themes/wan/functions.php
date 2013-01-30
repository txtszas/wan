<?php

function pageLoadAjax(){
	

	if ($_GET['action'] == 'dkh-pageload-ajax') {
	//每页多少条
	//require_once( '../../../wp-load.php' );
	//wp();
	$per_page = isset($_GET['tk_per_page']) ? $_GET['tk_per_page'] : 5; 

	//第几页
	$tk_paged = isset($_GET['tk_paged']) ? $_GET['tk_paged'] : 1;

		//配置参数
	$args = array(
				'posts_per_page' => $per_page,
				'paged' => $tk_paged
				);
	$the_query = new WP_Query( $args );
	//var_dump($the_query->posts);

	// The Loop
	$maxWidth = 680;
	$maginRight = 6;

	$data = array();

	while ( $the_query->have_posts() ) : $the_query->the_post();
		$post = $the_query->post;
		$attachInfo = getAttachementsByPostId($post->ID);
		$categories = get_the_category($post->ID);
		$cate = getReadCate($categories);
		if ($cate->cat_ID == 4) {
			$data[] = array(
			'id' 		=> $post->ID,
			'title'		=> $post->post_title,
			'excerpt'	=> get_the_excerpt(),
			'link'		=> get_permalink(),
			'post_on'	=> get_posted_on(),
			'attachInfo'=> getImageList($attachInfo,$post->ID,$post,$maxWidth,$maginRight),
			'comment'	=> $post->comment_count,
			'post_content' 	=> $post->post_content,
			'views'		=> 11,
			'cat_link'	=> get_category_link($cate->term_id),
			'cat_id'	=> $cate->cat_ID,
			'cat_name'	=> $cate->name,
			'ding_cai'	=> GetWtiLikePost('put')
			);
		}else{
			$data[] = array(
			'id' 		=> $post->ID,
			'title'		=> $post->post_title,
			'excerpt'	=> get_the_excerpt(),
			'link'		=> get_permalink(),
			'post_on'	=> get_posted_on(),
			'attachInfo'=> getImageList($attachInfo,$post->ID,$post,$maxWidth,$maginRight),
			'comment'	=> $post->comment_count,
			'views'		=> 11,
			'cat_link'	=> get_category_link($cate->term_id),
			'cat_id'	=> $cate->cat_ID,
			'cat_name'	=> $cate->name,
			'ding_cai'	=> GetWtiLikePost('put')
			);
		}
		//var_dump($post);

	endwhile;
	//var_dump($data);
	echo json_encode($data);
	die();
	}

}
add_action('init', 'pageLoadAjax');

function wan_widgets_init() {

	register_sidebar( array(
		'name' => '首页',
		'id' => 'sidebar-index',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => '分类',
		'id' => 'sidebar-category',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => '阅读页',
		'id' => 'sidebar-read',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => '单独页',
		'id' => 'sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );		

	// register_sidebar( array(
	// 	'name' => __( 'Showcase Sidebar', 'twentyeleven' ),
	// 	'id' => 'sidebar-2',
	// 	'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => "</aside>",
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );

	// register_sidebar( array(
	// 	'name' => __( 'Footer Area One', 'twentyeleven' ),
	// 	'id' => 'sidebar-3',
	// 	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => "</aside>",
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );

	// register_sidebar( array(
	// 	'name' => __( 'Footer Area Two', 'twentyeleven' ),
	// 	'id' => 'sidebar-4',
	// 	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => "</aside>",
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );

	// register_sidebar( array(
	// 	'name' => __( 'Footer Area Three', 'twentyeleven' ),
	// 	'id' => 'sidebar-5',
	// 	'description' => __( 'An optional widget area for your site footer', 'twentyeleven' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => "</aside>",
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );
}
add_action( 'widgets_init', 'wan_widgets_init' );


function getImageList($attachInfo,$post_id,$post,$maxWidth,$marginRight){
	$imgList = '';
	$num = 0;
	$limit = 2;
	$nowWidth = 0;
	if ($attachInfo || has_video($post->post_content)){
		

		$imgList = '<ul id="thumn_'.$post_id.'" class="img_thumb" date-postid = "'.$post_id.'">';
		//生成视频缩略图
		if (has_video($post->post_content) && getImageUrl($post->post_content) != '') {
			$imgList .= '<li class="video">';
			$imgUrl = getImageUrl($post->post_content);
			$imgList .= '<img src="'. $imgUrl . '" height="120"><img src="'.get_template_directory_uri().'/images/play.png" class="video-play"/>' ;
			$imgList .= '</li>';
			$showWidth = getShowWidth($imgUrl, 120);
			$nowWidth += $showWidth + $marginRight;
			$num ++;
		}
		foreach ($attachInfo as $k => $v) { 
			$imgUrl = wp_get_attachment_thumb_url($k);
			$showWidth = getShowWidth($imgUrl, 120);
			$nowWidth += $showWidth + $marginRight;
			if ( $num > 2 || $nowWidth > $maxWidth )
				break;
			$num++;
			$imgList = $imgList . '<li class="thumbnail">';
			$imgList = $imgList . '<img src="'.$imgUrl.'" height="120"></li>';
		}
		$imgList = $imgList . '</ul><div class="preivew_box" id="preivew_box_'.$post_id.'">';
		$img_num = count($attachInfo);
		$imgList = $imgList . '<div class="tips">第<span class="current-num">1</span>张/共<span class="count">'.$img_num.'</span>张</div><ul class="img_preview" id="img_'.$post_id.'">';
		foreach ($attachInfo as $k => $v) { 
			$url = wp_get_attachment_image_src($k,'medium');
			$imgList = $imgList . '<li><img src="'. $url[0] . '" class="img-polaroid"></li>';	
		}
		$imgList = $imgList . '</ul><div class="carousel-control left" href="#left" data-slide="prev"><span>left</span></div><div class="carousel-control right"  id="right-'.$post_id.'" ><span>right</span></div></div>';

		if (has_video($post->post_content)) {
			$code = get_video_code($post->post_content);
			$imgList .= '<div class="video-view" id="video-'. $post_id .'"><div>' . $code . '</div><div class="close-video"><a href="javascript:;" class="video-close">收回</a></div></div>';
		}
	}
	return $imgList;
}

function getShowWidth($imgUrl,$showHeight){
	list($width, $height, $type, $attr) = getimagesize($imgUrl);
	$showWidth = ( $width / $height ) * $showHeight;
	return $showWidth;
}

function get20list()
{
	$args = array(
		'numberposts' 	=> 16,
		'orderby'     	=> 'post_date',
		'category'	 	=> '1,3',
	);
	return $postslist = get_posts( $args );

}

//获取文章附件信息by post_id


function getAttachementsByPostId($postId)
{
	$attachInfo = array();
	$args = array( 
		'post_type' => 'attachment', 
		'numberposts' => -1, 
		'post_parent' => $postId,
		'orderby'     => 'post_date',
    	'order'           => 'ASC',
		 );
	$attachments = get_posts( $args); 
	
	if ($attachments) {
		foreach ($attachments as  $post) {
			$attachInfo[$post->ID] = get_post_meta($post->ID,'_wp_attachment_metadata');
		}
	}else{
		return false;
	}
	return $attachInfo;
}


// 段子
function getPiece(){
	$args = array(
		'numberposts' 	=> 4,
		'orderby'     	=> 'post_date',
		'category'	 	=> 4,
	);
	return $postslist = get_posts( $args );
}


function get_posted_on(){
	return '<a href="' . esc_url(get_permalink()) . '" title="'.esc_attr( get_the_time() ).'" rel="bookmark"><time class="entry-date" datetime="'.esc_attr( get_the_date( 'c' ) ).'" pubdate>'.esc_html( get_the_date() ).'</time></a><span class="gg">|</span><span class="by-author"><span class="author vcard">' . get_the_author() .'</span></span>';
}




function wan_posted_on() {
	printf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="gg">|</span><span class="by-author"><span class="author vcard">%7$s</span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( '查看 %s 发布的文章', get_the_author() ) ),
		get_the_author()
	);
}

//导航菜单
if(function_exists('register_nav_menus')){
	register_nav_menus(
	array(
	'header-menu' => __( '导航自定义菜单' ),
	'footer-menu' => __( '页角自定义菜单' ),
	'sider-menu' => __('侧边栏菜单')
	)
	);
}

class wan_walker_nav_menu extends Walker_Nav_Menu{
	function start_el( &$output, $item, $depth, $args ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
  
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

}

function has_video($code){
	$result = preg_match('/<embed/', $code, $match);
	if ($result){
		return true;
	}
	return false;
}

function getImageUrl($code,$size = 'normal'){
	$result = preg_match('/(?<=src=[\'"]).*?(?=[\'"])/', $code, $match);
	$src = $match[0];
	if (preg_match('/youku.com/', $src)){
		preg_match('/(?<=sid\/).*(?=\/v.swf)/', $src, $match);
		$id = $match[0];
		$videoInfo =file_get_contents('http://api.youku.com/api_ptvideoinfo?pid=XMTI5Mg==&id='.$id.'&rt=3');
		$video = json_decode($videoInfo,true);
		if ($size == 'big'){
			return $video['item']['imagelink_large'];
		}
		return $video['item']['imagelink'];
	}elseif (preg_match('/tudou.com/', $src)) {
		preg_match('/(?<=\/v\/)\w+/', $src,$getmatch);
		$itemCodes = $getmatch[0];
		$videoInfo = file_get_contents('http://api.tudou.com/v3/gw?method=item.info.get&appKey=231e26972d881499&format=json&itemCodes=' . $itemCodes);
		$video = json_decode($videoInfo,true);
		return $video['multiResult']['results'][0]['picUrl'];
	}elseif (preg_match('/56.com/', $src)) {
		preg_match('/(?<=v_).*(?=.swf)/', $src, $match);
		$appkey = '3000001205';
		$secret = '6eac245c5f20cbae';
		$vid = $match[0];
		$ts = time();
		$sign=md5(md5('vid='.$vid). '#' . $appkey . '#' . $secret . '#' . $ts);
		$videoInfo = file_get_contents('http://oapi.56.com/video/getVideoInfo.json?appkey='.$appkey.'&sign='.$sign.'&ts='.$ts.'&vid='.$vid);
		$video = json_decode($videoInfo,true);
		return $video[0]['img'];
	}elseif (preg_match('/ku6.com/', $src)){
		preg_match('/(?<=refer\/).*(?=\/v.swf)/', $code, $match);
		$content = file_get_contents('http://v.ku6.com/fetch.htm?t=getVideo4Player&vid='.$match[0]);
		$video = json_decode($content,true);
		return $video['data']['picpath'];
	}elseif (preg_match('/sohu.com/', $src) && 0) {
		// $app_key = 'e22df6eaace9773c47976cbc10f470c6';
		// if (preg_match('/(?<=sohu.com\/)\d+(?=\/v.swf)/', $src,$match1)){
		// 	$vid = $match1[0];
		// }elseif (preg_match('/(?<=id\=)\d+(?=&xuid)/', $src,$match2)){
		// 	$vid = $match2[0];
		// }
		// $content = file_get_contents('http://api.tv.sohu.com/set/info/v/' . $vid . '.json?api_key='.$app_key);
		// $video = json_decode($content,true);
		// return $vid;
	}else{
		return get_template_directory_uri().'/images/video-prview.jpg';
	}
}

function get_video_code($code){
	preg_match('/<embed.*<\/embed>/', $code, $match);
	if (isset($match[0])){
		$codeString = $match[0];
	}else{
		preg_match('/<embed.*?\/>/', $code, $match2);
		$codeString = $match2[0];
	}
	
	preg_match('/(?<=height=)["\']?\d+/', $codeString, $heightMatch);
	preg_match('/(?<=width=)["\']?\d+/', $codeString, $widthMatch);
	preg_match('/\d+/', $heightMatch[0], $heightMatch2);
	$height = $heightMatch2[0];
	preg_match('/\d+/', $widthMatch[0], $widthMatch2);
	$width = $widthMatch2[0];
	$rWidth = 660;
	$rheight = (660 * $height)/$width;
	if ($height && $width) {
		$codeString = str_replace($height, $rheight, $codeString);
		$codeString = str_replace($width, $rWidth, $codeString);
	}
	return $codeString;
}



add_theme_support( 'post-thumbnails' ); 


// 更多页面展示


// function new_excerpt_more($more) {
//        global $post;
// 	return ' <a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
// }
// add_filter('excerpt_more', 'new_excerpt_more');
//修改邮件发送人
add_filter('wp_mail_from','mail_from');
 
  function mail_from() {
 
   $emailaddress = 'service@dakahui.com'; //你的邮箱地址
 
   return $emailaddress;
 
  }
 
   // 更改默认发信人名字
 
  add_filter('wp_mail_from_name','mail_from_name');
 
  function mail_from_name() {
 
   $sendername = 'dakahui'; //你的名字
 
   return $sendername;
 
  }

 //字符串裁剪
function cutText($_text, $_length, $_showDot = true)
    {
        $_text = strip_tags($_text);

        if(function_exists("mb_strlen"))
        {
            $length = mb_strlen($_text, "utf-8");
        }
        else
        {
            $length = strlen($_text);
        }

        if($length > $_length) 
        {
            $cutLength = max(1, $_length - 3);

            if(function_exists("mb_substr")) 
            {
                $text = mb_substr($_text, 0, $cutLength, "utf-8");
                $textRest = mb_substr($_text, $cutLength, mb_strlen($_text, "utf-8"), "utf-8");
            }
            else 
            {
                $text = substr($_text, 0, $cutLength);
                $textRest = substr($_text, $cutLength);
            }

            if($_showDot) 
            {
                $text .= "...";
            }

            return $text;
        }
        else
        {
            return $_text;
        }
    }

function echo_first_image($width="100",$height="100",$post) {    
    //通过正则表达式匹配文章内容中的图片标签   
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    //第一张图片的html代码，下面加了那个缩放的js哦。。如果你不打算缩放，请删除  
    $first_img = '<img src="'. $matches[1][0] .'" width="'.$width.'" height="'.$height.'" alt="'.$post->post_title .'"/>';  
    if(empty($matches[1][0])){ //如果文章中没有图片，就调用下面的的默认代码,自己改图片url，也有缩放js  
        $first_img = '<img src="'. get_bloginfo('template_url') .'/images/defalt.jpg" alt="'.$post->post_title .'" width="'.$width.'" height="'.$height.'" onload="javascript:DrawImage(this,'.$width.','.$height.')" />';  
    }  
    //输出代码  
    echo  $first_img;   
} 
function custom_excerpt_length( $length ) {
	return 150;    //填写需要截取的字符数，1个汉字=2个字符
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function new_excerpt_more($more) {
       global $post;
	return '...'.'<a href="'. get_permalink($post->ID) . '" class="readmore">阅读全文</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


function getReadCate($categories){
	$noShow = array(25,26);
	if (count($categories) > 1){
		if (in_array($categories[0]->cat_ID, $noShow))
			return $categories[1];
		else
			return $categories[0];
	}else{
		return $categories[0];
	}

}

/**
 *评论form
 */

function wan_comment_form(){
	global $id;
	$post_id = $id;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">昵称</label> ' .
		            '<input id="author" name="author" type="text" value="" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">邮箱</label> ' .
		            '<input id="email" name="email" type="text" value="" size="30"' . $aria_req . ' /></p>',
	);
	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
	);
	$args = $defaults;

	if (comments_open( $post_id)) { ?>
		<div id="replay_form">
			<h2>我的评论</h2>
			<form action="<?php echo site_url( '/comments-ajax.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">

				<p><a href="javascript:;" class="cancle-reply"><i class="icon-remove"></i>取消回复</a></p>
				<?php if ( is_user_logged_in() ) : ?>
					<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
					<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
				<?php else : ?>
					<?php
					do_action( 'comment_form_before_fields' );
					foreach ( (array) $args['fields'] as $name => $field ) {
						echo apply_filters( "comment_form_field_{$name}", $field );
					}
					do_action( 'comment_form_after_fields' );
					?>
				<?php endif; ?>
				<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
				<div id="ajax-loading" class="hide">正在提交，请稍后...</div>
				<div id="error-msg" class="hide"></div>
				<p class="form-submit">
					<input name="submit" type="submit" id="ajax-submit" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
					<input type='hidden' name='comment_post_ID' value='<?php echo $id ?>' id='comment_post_ID' />
					<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
				</p>
			</form>
		</div>
<?php
	}
}




/**
 * 评论列表
 */


function wan_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">

			<div class="comment-avatar">
				<?php 
					$avatar_size = 52;
					if ( '0' != $comment->comment_parent )
							$avatar_size = 32;

				echo get_avatar( $comment, $avatar_size ); ?>
			</div>
			<div class="comment-right">
				<div class="comment-author">
					<cite>
						<?php 
					 		echo get_comment_author();
					 	?>:
					 </cite>
					 <time>
					 	<?php
					 		echo $comment->comment_date;
					 		//var_dump($comment);
					 		//echo get_comment_date() . get_comment_time();
					 	?>
					 </time> 
				</div>
				<div class="comment-content">
					<?php comment_text(); ?>
				</div>
				<div class="reply">
					<a href="#li-comment-<?php comment_ID(); ?>" data-id="<?php comment_ID(); ?>">评论</a>
				</div><!-- .reply -->
			</div>
			
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>
			
		</div><!-- #comment-## -->
		<div class="clear"></div>

	</li>
<?php
}
?>


<?php
$new_meta_boxes =
array(
    "article_from_name" => array(
        "name" => "article_from_name",
        "std" => "这里填默认的文章来源显示名称",
        "title" => "来源名称:"),

    "article_from_link" => array(
        "name" => "article_from_link",
        "std" => "这里填默认的文章来源链接",
        "title" => "来源链接:")
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}
function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].'_value'];

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
?>

<?php add_filter( 'show_admin_bar', '__return_false' ); ?>


