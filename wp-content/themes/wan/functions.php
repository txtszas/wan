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






function get20list()
{
	$args = array(
		'numberposts' 	=> 20,
		'orderby'     	=> 'post_date',
		'category'	 	=> '1,3',
	);
	return $postslist = get_posts( $args );

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

?>