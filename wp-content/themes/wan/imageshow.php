<?php

$attachInfo = getAttachementsByPostId($post->ID);

echo getImageList($attachInfo,$post->ID);