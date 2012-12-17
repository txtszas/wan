<?php get_header(); ?>
<div class="breadcrumbs">
	您的位置：
<?php if(function_exists('bcn_display'))
{
    bcn_display();
}?>




<style type="text/css">
.wp-pagenavi{
	display: none;
}
</style>
</div><!-- .breadcrumbs -->

<div class="clear"></div>
<div class="main-left">


	<?php 
	if ($paged == 0 || $paged == 1) {
		include (TEMPLATEPATH . '/carousel.php'); 

	?>
	<div class="clear"></div>
	<?php
		include (TEMPLATEPATH . '/list20.php'); 
	}else{
		wp_pagenavi(array(),3);
	}
	?>

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
	<div class="loading">
		<p>正在加载中...</p>
		<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif">
	</div>

		<?php wp_pagenavi(array(),1); ?>

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
			if (this.getScrollFromBottom() < 400 ){
				if (loadPage.done < 1) {
					if (this.realPage <= this.loadLimit) {
						this.showLoading();
						this.setTime = setTimeout( function(){
        					loadPage.loadData();
        				}, 1000 );
        				loadPage.done = 1;
						this.realPage++;
					}else{
						$('.wp-pagenavi').show();
					}
				}
			}else{
				this.done = 0;
			}
		}
		,loadData: function(){
			var that = this
			data = $.ajax({
					url:"/",
					data:{action:'dkh-pageload-ajax',tk_paged:((this.paged-1)*3+this.realPage)},
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
			link_post();
			this.hiddenLoading();
		}
		,hiddenLoading:function(){
			$('.loading').hide();
		}
		,showLoading:function(){
			$('.loading').fadeIn();
		}
		,addArticle:function(article){
			var article;
			data = '<article id="post-'+article.id+'" class="well" style="display:none">\
							<div class="entry-title">\
								<div class="cat-title">\
								<h4 class="cat_'+article.cat_id+'">\
									<a href="'+article.cat_link+'">'+article.cat_name+'</a></h4>\
								</div>\
								<h2><a href="'+article.link+'" > '+article.title+'</a></h2>\
								<div class="clear"></div>\
							</div>\
							<div class="entry-meta">\
								<div class="post_on">'+article.post_on+'</div>\
								<div class="commit-views">\
									<span class="commits">'+article.comment+'<div class="commit-arrow"></div></span>\
								</div>\
								<div class="ding-cai">\
									'+article.ding_cai+'\
								</div>\
								<div class="clear"></div>\
							</div>\
							<div class="entry-excerpt of">\
								'+article.excerpt+'\
							</div>';
			data += '<div class="img-review">' + article.attachInfo + '</div>';
			data += '<div class="entry-more"><a href="'+article.link+'" class="btn">阅读全文>></a>';

			$('#content').append(data);
			$('article').fadeIn();
		} 
	}
	
loadPage.listen();
</script>
<?php get_footer(); ?>