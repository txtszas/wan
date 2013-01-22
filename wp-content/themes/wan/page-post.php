

<?php 
/*
Template Name: post
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
			<h2>投稿</h2>
			<p>本站欢迎一切文章的投递，转载文章尽量注明来源，原创文章请注明，转载请留下原文地址，建议在开头添加自己的一点评论。
</p>
			<p>投稿邮箱：tougao@dakahui.com</p>
		</div>
	</div>
</div>
<div id="sidebar" class="well">
	<aside  class="widget">
<h2>其他</h2>
<ul>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=2"  title="关于我们">关于我们</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1685"  title="加入我们">加入我们</a></li>
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>?page_id=1688"  title="加入我们">投稿</a></li>
</ul>
</aside>
</div>
<div class="clear"></div>

<?php get_footer(); ?>