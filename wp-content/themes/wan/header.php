<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/typo.css">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.3.min.js"></script>
	<?php
		//hook
		wp_head();
	?>
	</head>
	<body>
		<div id="top-nav">
			<div class="container">
				<div id="login">
					<?php
					if (is_user_logged_in()){
						global $current_user;
						echo $current_user->display_name;
					}else{
						echo '登录';
					}
					?>
				</div>
				<div id="login-box">
					<?php
						login_with_ajax();
					?>
				</div>

<script type="text/javascript">
var loginBox = 0;
$('#login').click(function(){
	if (loginBox == 0){
		$('#login-box').slideDown();
		$('.right-box').addClass('active');
		loginBox = 1;
	}else{
		$('#login-box').slideUp();
		$('.right-box').removeClass('active');
		loginBox = 0;
	}


})

</script>




			</div>
		</div><!-- #top-nav -->

		<header role="banner">
			<div class="container">
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></a></span></h1>
				<div class="header-right">
					<h4 id="site-description"><?php bloginfo( 'description' ); ?></h4>
					<nav id="access" role="navigation" class="navbar navbar-inverse">
						<?php wp_nav_menu(array(
							'container' 		=> 'div',
							'container_class'	=> 'nav-box',
							'menu_class'        => 'nav',
							'walker'        => new wan_walker_nav_menu
						)) ?>
						<div class="nav-line"></div>	
					</nav>
				</div>
			</div>
		</header>
<script type="text/javascript">
function showNav(num){
	$('.nav-line').animate({left: 69*num },100)
}
$('.nav li').mouseenter(function(){
	num = $(this).index();
	showNav(num);
})
$('.nav').mouseleave(function(){
	$('.nav-line').animate({left: $('.nav li.active').position().left },300)
})
$('.nav-line').animate({left: $('.nav li.active').position().left },300);

</script>
		<div id="main">
			<div class="container">