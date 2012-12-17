<?php
require_once( '../../../wp-load.php' );
wp();
header("Status: 200");
//每页多少条
$per_page = isset($_GET['tk_per_page']) ? $_GET['tk_per_page'] : 5; 

//第几页
$tk_paged = isset($_GET['tk_paged']) ? $_GET['tk_paged'] : 1;

//配置参数
$args = array(
			'posts_per_page' => $per_page,
			'paged' => $tk_paged
			);
$the_query = new WP_Query( $args );

// The Loop



$data = array();

while ( $the_query->have_posts() ) : $the_query->the_post();
	$attachInfo = getAttachementsByPostId($post->ID);
	$categories = get_the_category($post->ID);
	$data[] = array(
			'id' 		=> $post->ID,
			'title'		=> $post->post_title,
			'excerpt'	=> get_the_excerpt(),
			'link'		=> get_permalink(),
			'post_on'	=> get_posted_on(),
			'attachInfo'=> getImageList($attachInfo,$post->ID),
			'comment'	=> $post->comment_count,
			'views'		=> 11,
			'cat_link'	=> get_category_link($categories[0]->term_id),
			'cat_id'	=> $categories[0]->cat_ID,
			'cat_name'	=> $categories[0]->name,
			'ding_cai'	=> GetWtiLikePost('put')
		);
endwhile;



echo json_encode($data);
?>