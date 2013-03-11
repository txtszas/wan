


//评论js
!function($){
	"use strict";

	var Comment = function(pid) {
		
		this.pid = pid
		this.commentDiv = $('#replay_form')
		this.submit = $('#ajax-submit')
		this.errorMsg = $('#error-msg')
		this.replay = $('.reply a')
		this.listen()
	}


	Comment.prototype = {

		constructor: Comment 

		, listen:function(){
			//监听提交按钮点击
			this.submit
				.on('click',	$.proxy(this.submitClick, this))
			
			this.replay
				.on('click',	$.proxy(this.replayClick, this))
			this.formListen()
			$('.cancle-reply').on('click',$.proxy(this.formBack, this))
	
		}
		, showLoading:function(){
			$('#ajax-loading').slideDown();
		}
		, hideLoading:function(){
			$('#ajax-loading').slideUp();
		}
		, submitClick:function(){
			$('#ajax-loading').slideDown()
		}
		, replayClick:function(e){
			var comment_id = $(e.currentTarget).attr('data-id');
			this.commentDiv.clone(true).appendTo('#comment-'+comment_id+' .comment-right')
			this.commentDiv.remove()
			this.commentDiv = $('#replay_form')
			$('#comment_parent').val(comment_id)
			$('.cancle-reply').show()
			this.labelListen()
			//console.log(comment_id);
		}
		, doWithResponse:function(data){
			var responseData = $.parseJSON(data)
			if (responseData.status == 'error'){
				this.error(responseData.error);
					$('#error-msg').slideDown();
				setTimeout(function(){
		       		$('#error-msg').slideUp();
		        },2000);
			}
			if (responseData.status == 'success') {
				if (responseData.data.comment_parent == 0) {
					$('.commentlist').append(this.makeCommentDom(responseData.data))
					$('#li-comment-'+ responseData.data.comment_id).slideDown()
				}else{
					if ($('#li-comment-'+responseData.data.comment_parent).next('.children').length){
						$('#li-comment-'+responseData.data.comment_parent).next('.children').append(this.makeCommentDom(responseData.data));
					}else{
						if ($('#li-comment-'+responseData.data.comment_parent).hasClass('depth-5')){
							$('#li-comment-'+responseData.data.comment_parent).parent().append(this.makeCommentDom(responseData.data));
						}else{
							$('#li-comment-'+responseData.data.comment_parent).after('<ul class="children">'+this.makeCommentDom(responseData.data)+'</ul>')
						}
					}
					$('#li-comment-'+ responseData.data.comment_id).slideDown();
					this.formBack()
				}
				this.replyAddListen(responseData.data.comment_id)
				this.slideToComment(responseData.data.comment_id)
				this.addColorBg(responseData.data.comment_id)
			}
		}
		, makeCommentDom:function(comment){
			var commentDom = '<li class="'+comment.comment_class+' hide" id="li-comment-' + comment.comment_id + '">\
							 	<div id="comment-'+ comment.comment_id+'" >\
							 		<div class="comment-avatar">'+comment.avatar+'</div>\
							 		<div class="comment-right">\
							 			<div class="comment-author">\
							 				<cite>'+ comment.author+'</cite>\
							 				<time>'+ comment.comment_date+'</time>\
							 			</div>\
							 			<div class="comment-content">'+comment.comment_text+'</div>\
							 			<div class="reply"><a href="javascript:;" data-id="'+comment.comment_id+'">评论</a></div>\
							 		</div>\
							 	</div>\
							 	<div class="clear"></div>\
							 </li>'
			return commentDom

		}
		, replyAddListen:function(comment_id){
			$('#li-comment-'+comment_id + ' .reply a').on('click',	$.proxy(this.replayClick, this))
		}
		, formBack:function(){
			this.commentDiv.clone(true).appendTo('#commits')
			this.commentDiv.remove()
			this.commentDiv = $('#replay_form')
			$('#comment_parent').val(0)
			$('.cancle-reply').hide()
			$('#ajax-loading').hide()
			this.labelListen()
		}
		, error:function(msg){
			$('#error-msg').text(msg)
		}
		, formListen:function(){
			var that = this
			//监听表单提交
			$('#commentform').ajaxForm(function(data){
				$('#ajax-loading').slideUp()
				that.doWithResponse(data)
			})
		}
		, slideToComment:function(cid){
			var offset = $('#li-comment-'+cid).offset();
			$('body,html').animate({scrollTop:offset.top-100},500);
		}
		, addColorBg:function(cid){
			$('#li-comment-'+ cid).css({background:'#ffffca'})
			setTimeout(function(){
		        $('#li-comment-'+ cid).css({background:'#fff'})
		        },2000);
		}
		, labelListen:function(){
			$('#replay_form p').click(function(){
				var label = $(this).find('label');
				var input = $(this).find('input');
				label.animate({left:50,opacity:0.3},200);
				input.focus();
			})
			$('#replay_form p input').keydown(function(){
				var label = $(this).parent().find('label');
				label.fadeOut();
			})
			$('#replay_form p input').change(function(){
				var label = $(this).parent().find('label');
				label.fadeOut();
			})


			$('#replay_form p input').focusout(function(){
				var value = $(this).val();
				var label = $(this).parent().find('label');
				if (value == ''){
					label.animate({left:12,opacity:1},200);
					label.fadeIn();
				}
			})
		}

	}


	$.fn.comment = function(pid){
		return new Comment(pid);
	}

}(window.jQuery)
$('#replay_form p').click(function(){
	label = $(this).find('label');
	input = $(this).find('input');
	label.animate({left:50,opacity:0.3},200);
	input.focus();
})
$('#replay_form p input').keydown(function(){
	label = $(this).parent().find('label');
	label.fadeOut();
})
$('#replay_form p input').change(function(){
	label = $(this).parent().find('label');
	label.fadeOut();
})


$('#replay_form p input').focusout(function(){
	value = $(this).val();
	label = $(this).parent().find('label');
	if (value == ''){
		label.animate({left:12,opacity:1},200);
		label.fadeIn();
	}
})

