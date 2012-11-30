<?php
$list20 = get20list();

$listTwo = array_chunk($list20,8,true);
?>

<div id="list20">
	<h2>最近更新</h2>
	<ul class="left" >
	<?php
	
	foreach ($listTwo[0] as $key => $post) {
	?>
		<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
	<?php	
	}
	?>
	</ul>

	<ul class="right">
	<?php
	
	foreach ($listTwo[1] as $key => $post) {
	?>
		<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
	<?php	
	}
	?>
	</ul>
<!-- 	<div class="more">
		<a href="http://wan.erqilu.com/?page_id=211">更多</a>
	</div> -->
</div>