	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="搜索大咖汇" value="<?php echo get_search_query();?>"/>
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="搜索" />
	</form>
