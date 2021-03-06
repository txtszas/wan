<?php get_header(); ?>
<div class="breadcrumbs">
	<div class="bread">
	您的位置：
	<?php if(function_exists('bcn_display'))
	{
	    bcn_display();
	}?>
	</div>
	<div class="search">
	<?php get_search_form( 1 ); ?>
	</div>



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
					$categories = get_the_category($post->ID);
					if ($categories[0]->cat_ID == 4) {
						get_template_part('content','piece');
					}else{
						get_template_part('content','index');
					}
				}else{
					break;
				}
			endwhile; 
			?>
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
		,status:0
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
			console.log(333)
			if (this.getScrollFromBottom() < 400 && this.getScrollFromBottom() >0 && this.status == 0){
				this.status =1
					if (this.realPage <= this.loadLimit) {
						var that = this 
						this.showLoading();
						this.setTime = setTimeout( function(){
        					loadPage.loadData();
        				}, 1000 );
					}else{
						$('.wp-pagenavi').show();
					}

			}else if(this.status == 2){
				this.status = 0;
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
						that.realPage++;
					}});
		}
		,inputData:function(itemList){
			for(var key in itemList){
				this.addArticle(itemList[key]);
			}
			this.clearClickevent();
			makeImg();
			link_post();
			this.hiddenLoading();
		}
		,clearClickevent:function(){
			 $('.like, .unlike').unbind("click");
			      jQuery(".like, .unlike").click(function(){
		          that= jQuery(this).find('span');
		          var task = jQuery(that).attr("rel");
		          var post_id = jQuery(that).attr("id");
		          
		          if(task == "like")
		          {
		               post_id = post_id.replace("lc-", "");
		          }
		          else
		          {
		               post_id = post_id.replace("unlc-", "");
		          }
		          
		          //jQuery("#status-" + post_id).html("&nbsp;&nbsp;").addClass("loading-img");
		          
		          jQuery.ajax({
		               type: "POST",
		               url: blog_url + "/wp-content/plugins/wti-like-post/wti_like.php",
		               data: "post_id=" + post_id + "&task=" + task + "&num=" + Math.random(),
		               success: function(data){
		                    jQuery("#status-" + post_id).fadeIn();
		                    jQuery("#lc-" + post_id).html(data.like);
		                    jQuery("#unlc-" + post_id).html(data.unlike);
		                    jQuery("#status-" + post_id).empty().html(data.msg);
		                    setTimeout(function(){
		                         jQuery("#status-" + post_id).fadeOut();
		                    },2000); 
		               },
		               dataType: "json"
		          });
     });
		}
		,hiddenLoading:function(){
			$('.loading').hide();
		}
		,showLoading:function(){
			$('.loading').fadeIn();
		}
		,addArticle:function(article){
			this.status = 1;
			var article;
			if (article.cat_id == 4) {
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
							</div>\
							<div class="entry-excerpt of">\
								'+article.post_content+'\
							</div>';
					data += '<div class="commit-views commit">\
								<div class="commit-box" title="评论">'+article.comment+'评论</div>\
							</div>\
							<div class="ding-cai">\
								'+article.ding_cai+'\
							</div>\
							<div class="clear"></div></article>';
			}else{
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
								<div class="clear"></div>\
							</div>\
							<div class="entry-excerpt of">\
								'+article.excerpt+'\
							</div>';
			//data += '<div class="entry-more"><a href="'+article.link+'" class="btn">阅读全文</a></div>';
			data += '<div class="img-review">' + article.attachInfo + '</div>';
			data += '<div class="commit-views commit">\
						<div class="commit-box" title="评论">'+article.comment+'评论</div>\
					</div>\
					<div class="ding-cai">\
						'+article.ding_cai+'\
					</div>\
					<div class="clear"></div></article>';
			
			}

			var that = this

			$('#content').append(data);
			$("#content").trigger("create"); 
			$('article').fadeIn('normal','swing',function(){
				that.status = 2
			});
		} 
	}
	
loadPage.listen();
</script>
<?php get_footer(); ?>