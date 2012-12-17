<?php

$attachInfo = getAttachementsByPostId($post->ID);
$maxWidth = 680;
$maginRight = 6;
echo getImageList($attachInfo,$post->ID,$post,$maxWidth,$maginRight);