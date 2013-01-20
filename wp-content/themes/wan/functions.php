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
	return '<a href="' . esc_url(get_permalink()) . '" title="'.esc_attr( get_the_time() ).'" rel="bookmark"><time class="entry-date" datetime="'.esc_attr( get_the_date( 'c' ) ).'" pubdate>'.esc_html( get_the_date() ).'</time></a><span class="gg">|</span><span class="by-author"><span class="author vcard"><a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" title="'.esc_attr( sprintf( '查看 %s 发布的文章', get_the_author() ) ).'" rel="author">' . get_the_author() .'</a></span></span>';
}




function wan_posted_on() {
	printf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="gg">|</span><span class="by-author"><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
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
	$result = preg_match('/(?<=<embed).*(?=<\/embed>)/', $code, $match);
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
	$codeString = $match[0];
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
	if (count($categories) > 1){
		return $categories[1];
	}else{
		return $categories[0];
	}

}
?>

<?php add_filter( 'show_admin_bar', '__return_false' ); ?>


