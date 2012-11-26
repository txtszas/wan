<aside id="piece" class="widget">
<h2>段子</h2>
<ul>
<?php
$pieces = getPiece();
foreach ($pieces  as $key => $post) {
?>
<li><?php echo $post->post_content; ?></li>
<?php	
}
?>
</ul>
</aside>