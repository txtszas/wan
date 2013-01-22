

<?php 
/*
Template Name: about
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
			<h2>关于大咖汇</h2>
			<p>大咖汇（dakahui.com）是中国领先的专注精英阅读的新媒体，我们提供最新的互联网热点及优质内容汇集,打造一站式新鲜谈资快速获取。我们的目标是，通过对互联网优质内容和热点的关注，为中文互联网精英读者提供最高效、最新鲜的阅读体验。</p>
			<p>大咖汇的内容主要覆盖4个维度：</p>
			<ul>
				<li>- 新谈资：覆盖互联网新鲜资讯，帮助大家快速了解当下</li>
				<li>- 热视频：关注热门、高质视频，第一时间分享推送</li>
				<li>- 好段子：“微”力无边，用段子传递态度</li>
				<li>- 深阅读：传播也有态度，为你提供思想的盛宴</li>
			</ul>
			<p>大咖（kā），咖在闽南语是“脚”的同声发音，咖就是脚的意思。闽南语中的“大咖”原意为在某个地方或者某个领域里较为有钱有能力的人；台湾闽南语“大咖”本意为大角色，引申为在某一方面的达人。</p>
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