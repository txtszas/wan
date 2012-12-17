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

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/help.js"></script>
		<footer>
			<div class="container">
				<ul class="foot-link">
					<li>
						<a href="http://dakahui.com">大咖汇 dakahui.com</a> 
					</li>
					<li class="gege">|</li>
					<li>
						<a href="#">关于我们</a>
					</li>
					<li class="gege">|</li>
					<li>
						<a href="#">加入我们</a>
					</li>
					<li class="gege">|</li>
					<li>
						<a href="#">投稿</a>
					</li>
				</ul>

			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>