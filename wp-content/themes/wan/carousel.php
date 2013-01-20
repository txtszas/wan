<?php
//获取轮播数据
$lunbo = array(
	'numberposts' => 4,
	'category'    => 25,
);
$lunbolist = get_posts( $lunbo );
?>

<div class="carousel">

	<div class="big-car">
		<div class="pre-slide"></div>
		<div class="next-slide"></div>
		<ul class="slide">
	<?php foreach ($lunbolist as $k => $post) { ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php echo_first_image('456', '210', $post); ?> 
				</a>
			</li>
	<?php } ?>
		</ul>
		<ul class="slide-title">
			<?php foreach ($lunbolist as $k => $post) { ?>
			<li >
				<a href="<?php the_permalink(); ?>">
					<?php echo $post->post_title ?>
				</a>
			</li>
			<?php } ?>
		</ul>

		<ul class="slide-num">
			<li class="active">
				1
			</li>
			<li>
				2
			</li>
			<li>
				3
			</li>
			<li>
				4
			</li>
		</ul>
	</div>
<?php
//获取轮播数据
$right = array(
	'numberposts' => 2,
	'category'    => 26,
);
$rightlist = get_posts( $right );
?>
	<div class="right">
<?php foreach ($rightlist as $k => $post) { ?>
		<div class="right-car">
			<a href="<?php the_permalink(); ?>">
				<?php echo_first_image('222', '98', $post); ?> 
				<div class="right-desc"><?php echo $post->post_title ?></div>
			</a>
		</div>
<?php } ?>
	</div>
</div>
<script type="text/javascript">

nowCurrent = 0;
pmouseOn(nowCurrent);
t = setInterval(showAuto, 5000);
$('.pre-slide').click(function(){
	nowCurrent = nowCurrent == 0 ? 3 : --nowCurrent;
	pmouseOn(nowCurrent);
	t=window.clearInterval(t);
	t = setInterval(showAuto, 5000);
});
$('.next-slide').click(function(){
	nowCurrent = nowCurrent >= 3 ? 0 : ++nowCurrent;
	pmouseOn(nowCurrent);
	t=window.clearInterval(t);
	t = setInterval(showAuto, 5000);
});
function pmouseOn(n){
	$('.slide li').fadeOut();
	$('.slide-title li').fadeOut();
	$('.slide li').eq(n).fadeIn();
	$('.slide-title li').eq(n).fadeIn();
	$('.slide-num li').removeClass('active');
	$('.slide-num li').eq(n).addClass('active');
}

function preSlide(){
	nowCurrent = nowCurrent == 0 ? 3 : --nowCurrent;
	pmouseOn(nowCurrent);
}

function nextSlide(){
	nowCurrent = nowCurrent >= 3 ? 0 : ++nowCurrent;
	pmouseOn(nowCurrent);
}

function showAuto()
	{
		nowCurrent = nowCurrent >= 3 ? 0 : ++nowCurrent;
		pmouseOn(nowCurrent);
	}
$('.slide-num li').click(function(){
	if ($(this).index() != nowCurrent) {
		pmouseOn($(this).index());
		nowCurrent = $(this).index();
	}
	t=window.clearInterval(t);
	t = setInterval(showAuto, 5000);
});	

</script>