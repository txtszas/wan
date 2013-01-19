<?php
// $appkey = '3000001205';
// $secret = '6eac245c5f20cbae';
// $vid = 'ODA5MzIyMTk';
// $ts = time();
// $sign=md5(md5('vid='.$vid). '#' . $appkey . '#' . $secret . '#' . $ts);
// $content = file_get_contents('http://oapi.56.com/video/getVideoInfo.json?appkey='.$appkey.'&sign='.$sign.'&ts='.$ts.'&vid='.$vid);
// var_dump($content);
// $code = 'http://player.ku6.com/refer/pMfQrDkw-uyDFaDoqRw7Hw../v.swf';
// preg_match('/(?<=refer\/).*(?=\/v.swf)/', $code, $match);
// var_dump($video);$content = file_get_contents('http://v.ku6.com/fetch.htm?t=getVideo4Player&vid='.$match[0]);
// $video = json_decode($content,true);


// $url = 'http://www.tudou.com/a/ydbqBFAvHVc/&rpid=29547518&resourceId=29547518_05_05_99&iid=158506529&bid=05/v.swf';

// if (preg_match('/(?<=a\/).*(?=\/&rpid)/', $url,$match1)){
// 	$vid = $match1[0];
// }elseif (preg_match('/(?<=id\=)\d+(?=&xuid)/', $url,$match2)){
// 	$vid = $match2[0];
// }
// var_dump($vid);
// $appKey = '231e26972d881499';
// $content = file_get_contents('http://api.tudou.com/v3/gw?method=item.info.get&appKey=' . $appKey . '&format=json&itemCodes='.$vid);
// var_dump('http://api.tudou.com/v3/gw?method=item.info.get&appKey=' . $appKey . '&format=json&itemCodes='.$vid);
// $video = json_decode($content,true);
// var_dump($video);
// $itemCodes = 'iJNGovrNUZU';
// $videoInfo = file_get_contents('http://api.tudou.com/v3/gw?method=item.info.get&appKey=231e26972d881499&format=json&itemCodes=' . $itemCodes);
// $video = json_decode($videoInfo,true);
// var_dump($video['multiResult']['results'][0]['picUrl']);

$code = '<object width=980 height=515><param name="movie" value="http://share.vrs.sohu.com/935115/v.swf&topBar=1&autoplay=false&plid=1010170&pub_catecode="></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="Transparent"></param><embed width=980 height=515 wmode="Transparent" allowfullscreen="true" allowscriptaccess="always" quality="high" src="http://share.vrs.sohu.com/935115/v.swf&topBar=1&autoplay=false&plid=1010170&pub_catecode=" type="application/x-shockwave-flash"/></embed></object>';

var_dump(get_video_code($code));


function get_video_code($code){
	preg_match('/<embed.*<\/embed>/', $code, $match);
	$codeString = $match[0];
	var_dump($codeString);
	preg_match('/(?<=height=)["\']?\d+/', $codeString, $heightMatch);
	preg_match('/(?<=width=)["\']?\d+/', $codeString, $widthMatch);
	preg_match('/\d+/', $heightMatch[0], $heightMatch2);
	$height = $heightMatch2[0];
	preg_match('/\d+/', $widthMatch[0], $widthMatch2);
	$width = $widthMatch2[0];
	$rWidth = 680;
	$rheight = (680 * $height)/$width;
	if ($height && $width) {
		$codeString = str_replace($height, $rheight, $codeString);
		$codeString = str_replace($width, $rWidth, $codeString);
	}
	return $codeString;
}
