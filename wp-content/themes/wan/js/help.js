var img_show_num = new Array();
function show_img(post_id,show_eq){
	$('#preivew_box_' + post_id + ' .current-num').text(show_eq+1);
	$('#img_'+ post_id + ' li').removeClass('active');
	$('#img_'+ post_id + ' li').eq(show_eq).addClass('active');
}

function makePreNextListesn(post_id,img_count){
	$('#preivew_box_' + post_id + ' .right').unbind("click");
	$('#right-'+post_id).click(function(){
		if (img_show_num[post_id] < img_count - 1) {
			img_show_num[post_id]++;
			show_img(post_id, img_show_num[post_id]);
			$('#preivew_box_' + post_id + ' .left').css('display','block');
		}
		if (img_show_num[post_id] == img_count - 1){
			$('#preivew_box_' + post_id + ' .right').hide();
		}
	})
	$('#preivew_box_' + post_id + ' .left').unbind("click");
	$('#preivew_box_' + post_id + ' .left').click(function(){
		if (img_show_num[post_id] > 0){
			img_show_num[post_id]--;
			show_img(post_id, img_show_num[post_id]);
			$('#preivew_box_' + post_id + ' .right').css('display','block');
		}
		if (img_show_num[post_id] == 0){
			$('#preivew_box_' + post_id + ' .left').hide();
		}
		
	})
}
function makeCloseListen(post_id){
	$('#preivew_box_' + post_id + ' img').unbind("click");
	$('#preivew_box_' + post_id + ' img').click(function(){
		$('#thumn_' + post_id).show();
		$('#preivew_box_' + post_id).hide();
	})
}

function makeVideoCloseListen(post_id){
	$('#video-' + post_id + ' .video-close').click(function(){
		$('#thumn_' + post_id).show();
		$('#video-' + post_id).hide();
	})
}

function makeImg(){
	$('ul.img_thumb li.thumbnail').unbind("click");
	$('ul.img_thumb li.thumbnail').click(function(){
		var show_eq = $(this).index();
		var show_id;
		post_id = $(this).parent().attr('date-postid');
		$('#thumn_' + post_id).hide();
		$('#preivew_box_' + post_id).show();
		var img_count = $('#preivew_box_' + post_id + ' .count').text();

		if (img_count > 1){
			if (show_eq != (img_count -1)){
				$('#preivew_box_' + post_id + ' .right').css('display','block');
			}
			if (show_eq != 0) {
				$('#preivew_box_' + post_id + ' .left').css('display','block');
			}
		}
		makeCloseListen(post_id);
		show_img(post_id,show_eq);
		img_show_num[post_id] = show_eq;
		makePreNextListesn(post_id,img_count);
	});
	$('ul.img_thumb li.video').unbind("click");
	$('ul.img_thumb li.video').click(function(){
		post_id = $(this).parent().attr('date-postid');
		$('#thumn_' + post_id).hide();
		$('#video-' + post_id).show();
		makeVideoCloseListen(post_id);
	});

}

makeImg();

