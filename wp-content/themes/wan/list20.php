<div  class="well of">
<h2>最新20条</h2>
<ul id="list20" >
<?php
$list20 = get20list();
foreach ($list20 as $key => $post) {
?>
<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
<?php	
}
?>
</ul>

<a href="http://wan.erqilu.com/?page_id=211">更多</a>
</div>