<?php

$attachInfo = getAttachementsByPostId($post->ID);
$maxWidth = 660;
$maginRight = 6;
echo getImageList($attachInfo,$post->ID,$post,$maxWidth,$maginRight);