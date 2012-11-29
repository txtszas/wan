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

	$data[] = array(
			'id' 		=> $post->ID,
			'title'		=> $post->post_title,
			'excerpt'	=> get_the_excerpt(),
			'link'		=> get_permalink(),
			'post_on'	=> get_posted_on(),
			'attachInfo'=> getImageList($attachInfo,$post->ID)
		);
endwhile;



echo json_encode($data);
?>