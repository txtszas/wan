<?php

/**
 * ajax action
 */
function eaAjax(){
	if($_GET['action'] == 'ea-monthly-ajax') {
		$authorId = $_GET['author'];
		$year = $_GET['year'];
		if(!(int)$year) {
			$year = '';
		}

		eaPrintArchives($year, $authorId);
		die();
	}
}
add_action('init', 'eaAjax');

/**
 * print monthly archives and the filters
 */
function wp_easyarchives($year='', $authorId='') {
	global $hasEasyArchive;
	$hasEasyArchive = true;

	echo '<div id="easy-archives">';
	eaPrintArchives($year, $authorId);
	echo '</div>';
}

/**
 * print the monthly archives and the filters
 */
function eaPrintArchives($year, $authorId) {
	$output = '';
	$options = get_option('wp_easyarchives_options');
	if($year == '' && $authorId == '' && $options && $options['cache'] && $options['cache']['all']) {
		$output = $options['cache']['all'];
	} else {
		$output = eaGetArchives($year, $authorId, $options);
	}

	echo $output;
}

/**
 * retrieve the monthly archives and the filters
 */
function eaGetArchives($year, $authorId, $options) {
	$mode = $options['mode'];
	$includePages = $options['page'];
	$showCommentCount = $options['comment_count'];

	$filter = '<div id="ea-filter">';
	$filter .= eaGetAuthorSelect($authorId);
	$filter .= eaGetYearSelect($year, $includePages, $authorId);
	$filter .= eaGetExpandallButton();
	$filter .= eaGetCollapseallButton();
	$filter .= '</div>';

	$archives = eaGetMonthlyArchives($year, $authorId, $mode, $includePages, $showCommentCount);

	return $filter . $archives;
}

/**
 * retrieve the monthly archives
 */
function eaGetMonthlyArchives($year, $authorId, $mode, $includePages, $showCommentCount) {
	global $month, $wpdb;

	// author id
	$sql_author = '';
	if($authorId) {
		$sql_author = " AND post_author = " . $authorId;
	}

	// pages
	$sql_page = " AND post_type = 'post'";
	if($includePages) {
		$sql_page = " AND (post_type = 'post' OR post_type = 'page')";
	}

	// where
	$where = " WHERE post_status = 'publish'" . $sql_author  . $sql_page;

	// orderby
	$orderby = " ORDER BY post_date DESC";

	// get posts
	$post_query = "SELECT *, YEAR(post_date) AS year, MONTH(post_date) AS month FROM " . $wpdb->posts . $where . $orderby;
	$post_set = $wpdb->get_results($post_query);

	$monthly_archives = '';
	if($post_set) {
		// monthly item
		$monthly_item = '';
		// date of previous monthly item
		$pre_date = '';
		// the count of daily item
		$post_count = 0;
		$post_count_symbol = '%POSTCOUNT%';

		// loop through each month
		$preDateNum = '';
		$daylist = array();
		foreach($post_set as $post) {
			// get post date
			$date = get_the_time(__('F Y', 'wp-easyarchives'), $post);
			$month = get_the_time('m', $post);
			$yearValue = get_the_time('Y', $post);

			// if the date is diff, close previous monthly item
			if($date != $pre_date) {
				// when the first monthly item
				if($pre_date != '') {
					// set post count
					$monthly_item = str_replace($post_count_symbol, $post_count, $monthly_item);
					// ending of previous monthly item
					$monthly_item .= '</ul>';
					$monthly_item .= renderList($daylist, $preMonth);
					$daylist = array();
					$monthly_item .= '</div>';
					// push previous monthly item to archives
					$monthly_archives .= $monthly_item;
				}

				// get the url of monthly archive
				$url = get_month_link($post->year , $post->month);

				// get status
				$display = 'ea-open';
				$button = 'ea-collapse';
				$text = '折叠';
				if($mode == 'none') {
					$display = 'ea-closed';
					$button = 'ea-expand';
					$text = '展开';
				}

				// if visitor has select a year, others will be hide
				$displayStyle = '';
				if(strlen($year) > 0 && $year != $yearValue) {
					$displayStyle = 'style="display:none;"';
				}

				// begining of monthly item
				$monthly_item = '<div class="ea-month" data-year="' . $yearValue . '" ' . $displayStyle . '>'; // new item
				$monthly_item .= '<div class="ea-title">';
				$monthly_item .= '<a class="ea-detail" href="' . $url . '">' . $date . '</a>';
				$monthly_item .= '<a class="ea-button ' . $button . '" rel="nofollow">' . $text .'</a>';
				//$monthly_item .= '<span>(' . sprintf(__('%1$s Posts', 'wp-easyarchives'), $post_count_symbol) . ')</span>';
				$monthly_item .= '</div>';
				$monthly_item .= '<ul class="' . $display . '">';

				// current date becomes the previous date 
				$pre_date = $date;
				// reset post count
				$post_count = 0;
			}

			// get post title
			$post_title = $post->post_title;
			$categories = get_the_category($post->ID);
			if($post_title) {
				$title = wptexturize(strip_tags($post_title));
			} else {
				$title = $post->ID;
			}

			// get post url
			$url = get_permalink($post->ID);

			// begining of this daily item and post link
			$daily_item = '';

			$nowDay = mysql2date('d', $post->post_date);
			if ($nowDay <> $preDateNum){
				$daily_item .= '<li class="ea-gege" id="eg-'.$month.'-'.$nowDay.'"><div class="ea-daynum">' . $nowDay . '</div></li>';
				$preDateNum = $nowDay;
				array_push($daylist,$preDateNum);
			}


			$daily_item .= '<li class="eg-list"><a href="' . get_category_link($categories[0]->term_id) . '">' . $categories[0]->name . '</a><span class="spend">|</span><a href="' . $url .'" class="title">' . $title . '</a>';

			// show comment count
			if($showCommentCount) {
				$daily_item .= '<span>(' . $post->comment_count . ')</span>';
			}

			// ending of this daily item
			$daily_item .= '</li>';

			// push this daily item to its monthly item
			$monthly_item .= $daily_item;

			// increase the count of posts
			$post_count++;
			$preMonth = $month;
		}

		// set post count
		$monthly_item = str_replace($post_count_symbol, $post_count, $monthly_item);
		// ending of last monthly item
		$monthly_item .= '</ul>';
		$monthly_item .= renderList($daylist, $month);
		$daylist = array();
		$monthly_item .= '</div>';
		// push last monthly item to archives
		$monthly_archives .= $monthly_item;
	}

	return $monthly_archives;
}

/**
 * retrieve list of years.
 */
function eaGetYears($inclidePages, $authorId) {
	global $wpdb;

	// include pages
	$includes = " AND post_type='post'";
	if($inclidePages) {
		$includes = " AND (post_type = 'post' OR post_type = 'page')";
	}

	// author
	$sql_author = '';
	if(strlen($authorId) > 0) {
		$sql_author = " AND (post_author = '" . $authorId . "')";
	}

	$years_query = "SELECT DISTINCT YEAR(post_date) AS year FROM $wpdb->posts WHERE post_status = 'publish' AND post_date < '" . current_time('mysql') . "' " . $includes . $sql_private . $sql_author . " ORDER BY post_date DESC";
	$years = $wpdb->get_results($years_query);

	if(!$years || count($years) <= 1) {
		return false;
	}

	return $years;
}

/**
 * retrieve list of users who have writed a post
 */
function eaGetAuthors() {
	global $wpdb;

	$authors_query = "SELECT DISTINCT U.ID AS id, U.display_name AS name FROM $wpdb->users U, $wpdb->posts P WHERE U.ID = P.post_author ORDER BY id ASC";
	$authors = $wpdb->get_results($authors_query);

	if(!$authors || count($authors) <= 1) {
		return false;
	}

	return $authors;
}

/**
 * retrieve list of years.
 */
function eaGetYearSelect(&$selectedYear, $inclidePages, $authorId) {
	$years = eaGetYears($inclidePages, $authorId);
	if(!$years) {
		return false;
	}

	$has_selected = false;
	foreach ($years as $year) {
		$selectedAttr = '';
		if($year->year == $selectedYear) {
			$has_selected = true;
			$selectedAttr = 'selected';
			$selectedYear = $year->year;
		}
		$year_options .= '<option value="' . $year->year . '" ' . $selectedAttr . '>' . $year->year . '</option>';
	}

	// select a year
	if($has_selected) {
		$all_option .= '<option value="">' . __('All', 'wp-easyarchives') . '</option>';

	// select 'all' or the year do not exist
	} else {
		$all_option .= '<option value="" selected="selected">' . __('All', 'wp-easyarchives') . '</option>';
		$selectedYear = '';
	}

	$select = '<span class="ea-year">' . __('Year: ', 'wp-easyarchives') . '</span>';
	$select .= '<select id="ea-year-selector">';
	$select .= $all_option . $year_options;
	$select .= '</select>';

	return $select;
}

/**
 * retrieve list of years.
 */
function eaGetAuthorSelect($selectedAuthor) {
	$authors = eaGetAuthors();
	if(!$authors) {
		return false;
	}

	$has_selected = false;
	foreach ($authors as $author) {
		$selectedAttr = '';
		if($author->id == $selectedAuthor) {
			$has_selected = true;
			$selectedAttr = 'selected';
		}
		$author_options .= '<option value="' . $author->id . '" ' . $selectedAttr . '>' . $author->name . '</option>';
	}

	// select an author
	if($has_selected) {
		$all_option .= '<option value="">' . __('All', 'wp-easyarchives') . '</option>';

	// select 'all'
	} else {
		$all_option .= '<option value="" selected="selected">' . __('All', 'wp-easyarchives') . '</option>';
	}

	$select = '<span class="ea-author">' . __('Author: ', 'wp-easyarchives') . '</span>';
	$select .= '<select id="ea-author-selector">';
	$select .= $all_option . $author_options;
	$select .= '</select>';

	return $select;
}

/**
 * retrieve 'expand all' button.
 */
function eaGetExpandallButton() {
	$button = '<input id="ea-expand-all" type="button" value="' . __('Expand All', 'wp-easyarchives') . '" />';
	return $button;
}

/**
 * retrieve 'collapse all' button.
 */
function eaGetCollapseallButton() {
	$button = '<input id="ea-collapse-all" type="button" value="' . __('Collapse All', 'wp-easyarchives') . '" />';
	return $button;
}

function renderList($daylist,$month){
	$item = '<ul class="daylist">';
	foreach ($daylist as $k => $v) {
		$item .= '<li><a href="#eg-'. $month .'-' . $v . '">' . $v . '</a>';
	}
	$item .= '</ul>';
	return $item;
}

?>