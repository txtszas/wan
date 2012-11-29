<?php


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


function getImageList($attachInfo,$post_id){
	$imgList = '';
	$num = 0;
	if ($attachInfo){
		$imgList = '<ul id="thumn_'.$post_id.'" class="img_thumb" date-postid = "'.$post_id.'">';
		foreach ($attachInfo as $k => $v) { 
			if ($num > 2)
				break;
			$num++;
			$imgList = $imgList . '<li class="thumbnail">';
			$imgList = $imgList . '<img src="'.wp_get_attachment_thumb_url($k).'" height="120"></li>';
		}
		$imgList = $imgList . '</ul><div class="preivew_box" id="preivew_box_'.$post_id.'">';
		$img_num = count($attachInfo);
		$imgList = $imgList . '<div class="tips"><span class="current-num">1</span>/<span class="count">'.$img_num.'</span><a href="javascript:;" class="close-back">收回</a></div><ul class="img_preview" id="img_'.$post_id.'">';
		foreach ($attachInfo as $k => $v) { 
			$url = wp_get_attachment_image_src($k,'medium');
			$imgList = $imgList . '<li><img src="'. $url[0] . '" class="img-polaroid"></li>';	
		}
		$imgList = $imgList . '</ul><a class="carousel-control left" href="#myCarousel" data-slide="prev"><span>&lsaquo;</span></a><a class="carousel-control right" href="#myCarousel" data-slide="next"><span>&rsaquo;</span></a></div>';
	}
	return $imgList;
}



function get20list()
{
	$args = array(
		'numberposts' 	=> 20,
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
		'numberposts' 	=> 10,
		'orderby'     	=> 'post_date',
		'category'	 	=> 4,
	);
	return $postslist = get_posts( $args );
}


function get_posted_on(){
	return '<span class="sep">发布于 </span><a href="' . esc_url(get_permalink()) . '" title="'.esc_attr( get_the_time() ).'" rel="bookmark"><time class="entry-date" datetime="'.esc_attr( get_the_date( 'c' ) ).'" pubdate>'.esc_html( get_the_date() ).'</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'" title="'.esc_attr( sprintf( '查看 %s 发布的文章', get_the_author() ) ).'" rel="author">' . get_the_author() .'</a></span></span>';
}

function wan_posted_on() {
	printf( '<span class="sep">发布于 </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
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

add_theme_support( 'post-thumbnails' ); 
?>