$('.controls').click(function(){
	label = $(this).find('label');
	input = $(this).find('input');
	label.animate({left:50,opacity:0.3},200);
	input.focus();
})
$('.controls .input').keydown(function(){
	label = $(this).parent().find('label');
	label.fadeOut();
})
$('.controls .input').change(function(){
	label = $(this).parent().find('label');
	label.fadeOut();
})


$('.controls .input').focusout(function(){
	value = $(this).val();
	label = $(this).parent().find('label');
	if (value == ''){
		label.animate({left:12,opacity:1},200);
		label.fadeIn();
	}
})