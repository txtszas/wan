

<?php 
/*
Template Name: joinus
*/


get_header(); ?>
<style type="text/css">
h2{
	margin: 1em 0 0.5em;
}
.paaaaa{
	padding-left: 90px;
}
.paaaaa p{
	padding-left: 30px;
	margin-bottom: 1em;
	line-height: 25px;
}
.paaaaa ul{
	padding-left: 30px;
	margin-bottom: 1em;
	line-height: 25px;
}

</style>
	<!-- 主体内容 -->
	<div class="breadcrumbs">
	您的位置：
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
	</div><!-- .breadcrumbs -->
<div class="clear"></div>
<div class="main-left">
	<div id="content">
		<div class="paaaaa">
			<h2>加入我们</h2>
			<p>互联网事业部：</p>
			<p>资深策划：善察来龙去脉，妙笔生花，口吐莲花；</p>
			<p>文案指导：指哪儿打哪儿，胸中有丘壑，笔底起惊雷；</p>
			<p>网站主编：敢想敢写，放得出去，收得回来；</p>
			<p>美术指导：募视觉将才，善用色诱，善沟通；</p>
			<p>资深设计：找视觉达人，视觉匠材勿扰；</p>
			<p>AE：有型，有心，有识，有品。</p>
			<p>注：要求同等职位两年以上工作经验。</p>
			<p>有意者请直洽：010-84150403或发简历、作品至E-mail:hr@dakahui.com</p>
			<p>地址：北京市朝阳区太阳宫火星园9# 13层</p>
		</div>
	</div>
</div>
<div id="sidebar" class="well">
	<aside  class="widget">
<h2>其他</h2>
<ul>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=2"  title="关于我们">关于我们</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1685"  title="加入我们">加入我们</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1688"  title="投稿">投稿</a></li>
</ul>
</aside>
</div>
<div class="clear"></div>

<?php get_footer(); ?>