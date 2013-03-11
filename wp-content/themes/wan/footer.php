			</div>
		</div><!-- #main -->
		<div class="backtotop">

		</div>
<script type="text/javascript">
var backtotop_display = 0;
$(window).scroll(function(){

	if ($(window).scrollTop() > 1000 && backtotop_display == 0){
		//$('.backtotop').fadeIn();
		backtotop_display = 1;
	}
	if ($(window).scrollTop() < 1000 && backtotop_display == 1){
		$('.backtotop').fadeOut();
		backtotop_display = 0;
	}
})
$('.backtotop').click(function(){
	$('body').animate({scrollTop:0},500);
})
</script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/login.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/help.js"></script>

		<div id="backtop">
			<img src="<?php echo get_template_directory_uri(); ?>/images/backtop.png">
		</div>


<script type="text/javascript">
$(document).ready(function(){
//当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
$(function () {
$(window).scroll(function(){
	if ($(window).scrollTop()>100){
		$("#backtop").fadeIn(1500);
	}else{
		$("#backtop").fadeOut(1500);
	}
});
//当点击跳转链接后，回到页面顶部位置
$("#backtop").click(function(){
$('body,html').animate({scrollTop:0},500);
return false;
});
});
});
</script>


		</script>
		<footer>
			<div class="container">
				<ul class="foot-link">
					<li>
						<a href="http://dakahui.com">大咖汇 dakahui.com</a> 
					</li>
					<li class="gege">|</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=2">关于我们</a>
					</li>
					<li class="gege">|</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1685">加入我们</a>
					</li>
					<li class="gege">|</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1688">投稿</a>
					</li>
				</ul>

			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>