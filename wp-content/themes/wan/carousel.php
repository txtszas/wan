<div class="carousel">
	<div class="big-car">
		<ul class="slide">
			<li>
				<a href="/?p=744">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slide-1.jpg">
				</a>
			</li>
			<li>
				<a href="/?p=737">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slide-2.jpg">
				</a>
			</li>
			<li>
				<a href="/?p=740">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slide-3.jpg">
				</a>
			</li>
			<li>
				<a href="/?p=748">
					<img src="<?php echo get_template_directory_uri(); ?>/images/slide-4.jpg">
				</a>
			</li>
		</ul>
		<ul class="slide-title">
			<li >
				<a href="/?p=744">
					受奥巴马接见的华裔女孩
				</a>
			</li>
			<li>
				<a href="#">
					YY上市首日收报11.31美元涨8% 市值6亿美元
				</a>
			</li>
			<li>
				<a href="#">
					这里是中国的“北方西湖”，更是世界上最大的火山熔岩堰塞湖
				</a>
			</li>
			<li>
				<a href="#">
					超帅的裸眼3D演唱会？世界最尖端技术，舞台渲染力的新高度
				</a>
			</li>
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
	<div class="right">
		<div class="right-car">
			<a href="/?p=742">
				<img src="<?php echo get_template_directory_uri(); ?>/images/slide-s1.jpg">
				<div class="right-desc">腾讯的一次惨败：搜搜输在哪？</div>
			</a>
		</div>
		<div class="right-car">
			<a href="/?p=746">
				<img src="<?php echo get_template_directory_uri(); ?>/images/slide-s2.jpg">
				<div class="right-desc">高科技战争装备简直就是逆天了</div>
			</a>
		</div>
	</div>
</div>
<script type="text/javascript">

nowCurrent = 0;
pmouseOn(nowCurrent);
t = setInterval(showAuto, 5000);
function pmouseOn(n){
	$('.slide li').fadeOut();
	$('.slide-title li').fadeOut();
	$('.slide li').eq(n).fadeIn();
	$('.slide-title li').eq(n).fadeIn();
	$('.slide-num li').removeClass('active');
	$('.slide-num li').eq(n).addClass('active');
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