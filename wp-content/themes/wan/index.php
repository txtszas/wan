<?php get_header(); ?>
<div class="main-left">

	<div class="breadcrumbs">
		您的位置：
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
	</div><!-- .breadcrumbs -->
	<?php include (TEMPLATEPATH . '/list20.php'); ?>

		<!-- 主体内容 -->
	<div id="content">
			<?php 
			$s = 0;
			while ( have_posts() ) : the_post(); 
				$s++;
				if ($s <= 5) {
			?>

						<?php get_template_part('content','index'); ?>

			<?php 
			}else{
				break;
			}
			endwhile; 

			?>



			<!-- <div class="pager">
				<ul>
					<li class="previous"><?php previous_posts_link('&laquo; 上一页') ?></li>
					<li class="next"><?php next_posts_link('下一页 &raquo;','') ?></li>
				</ul>
	 		</div> -->
	</div><!-- #content -->
		<?php wp_pagenavi(); ?>

	<!-- 最新二十条 -->
	

<!-- 侧边栏 -->
	 	
</div><!-- #main-left -->
<?php get_sidebar(); ?>
<div class="clear"></div>
<script type="text/javascript">
//动态加载

loadPage = {
		//获取当前滚动条与底部距离
		open:true
		,done:0
		,paged:<?php echo $paged == 0 ? 1 : $paged ; ?>
		,realPage:2
		,loadLimit:3
		,getScrollFromBottom:function() {
			return $(document).height()-$(window).scrollTop()-$(window).height();
		}
		,listen: function(){
			$(window).scroll(function(){
				loadPage.checkHeight();
			})
		}
		,checkHeight: function(){
			if (this.getScrollFromBottom() < 500 ){
				if (!this.done) {
					if (this.realPage<= this.loadLimit) {
						loadPage.loadData();
						this.done = 1;
						this.realPage++;
					}
				}
			}else{
				this.done = 0;
			}
		}
		,loadData: function(){
			var that = this
			data = $.ajax({
					url:"/wp-content/plugins/pageload/pageload.php",
					data:{tk_paged:((this.paged-1)*3+this.realPage)},
					dataType:'json',
					success:function(data){
						that.inputData(data);

					}});
		}
		,inputData:function(itemList){
			for(var key in itemList){
				this.addArticle(itemList[key]);
			}
			makeImg();
		}
		,addArticle:function(article){
			var article;
			data = '<article id="post-'+article.id+'" class="well">\
							<div class="entry-title">\
								<h4 class="cat_'+article.cat_id+'">\
									<a href="'+article.cat_link+'">'+article.cat_name+'</a></h4>\
								<h2><a href="'+article.link+'" > '+article.title+'</a></h2>\
								<div class="clear"></div>\
							</div>\
							<div class="entry-meta">\
								<div class="post_on">'+article.post_on+'</div>\
								<div class="commit-views">\
									<span class="views">'+article.views+'人围观</span>\
									<span class="commits">'+article.comment+'条评论</span>\
								</div>\
								<div class="clear"></div>\
							</div>\
							<div class="entry-excerpt of">\
								'+article.excerpt+'\
							</div>';
			data += '<div class="img-review">' + article.attachInfo + '</div>';
			data += '<div class="entry-more"><a href="'+article.link+'" class="btn">阅读全文>></a>';

			$('#content').append(data);
		} 
	}
	
loadPage.listen();
</script>
<?php get_footer(); ?>