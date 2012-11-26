<ul id="list20">
<?php
$list20 = get20list();
foreach ($list20 as $key => $post) {
?>
<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
<?php	
}
?>
</ul>