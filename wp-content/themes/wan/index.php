<?php get_header(); ?>

<div class="row">
	<div class="span8">
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
		</div>
		<?php wp_pagenavi(); ?>
	</div>

	<!-- 最新二十条 -->
	

<!-- 侧边栏 -->
	 <div class="span4">
	 	<?php get_sidebar(); ?>
	 </div>


</div>
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
						<header class="entry-header">\
							<h1 class="entry-title">\
								<a href="'+article.link+'" > '+article.title+'</a>\
							</h1>\
							<div class="entry-excerpt of">\
								'+article.excerpt;
			data += article.attachInfo;
			data +=	'</div></article></header>';

			$('#content').append(data);
		} 
	}
	
loadPage.listen();
</script>
<?php get_footer(); ?>