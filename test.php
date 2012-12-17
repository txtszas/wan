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


$url = 'http://www.tudou.com/a/ydbqBFAvHVc/&rpid=29547518&resourceId=29547518_05_05_99&iid=158506529&bid=05/v.swf';

if (preg_match('/(?<=a\/).*(?=\/&rpid)/', $url,$match1)){
	$vid = $match1[0];
}elseif (preg_match('/(?<=id\=)\d+(?=&xuid)/', $url,$match2)){
	$vid = $match2[0];
}
var_dump($vid);
$appKey = '231e26972d881499';
$content = file_get_contents('http://api.tudou.com/v3/gw?method=item.info.get&appKey=' . $appKey . '&format=json&itemCodes='.$vid);
var_dump('http://api.tudou.com/v3/gw?method=item.info.get&appKey=' . $appKey . '&format=json&itemCodes='.$vid);
$video = json_decode($content,true);
var_dump($video);


