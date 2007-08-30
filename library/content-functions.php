<?php // content-functions.php - Content formatting for Tarski

// Multiple user check
$count_users = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->usermeta WHERE `meta_key` = '" . $wpdb->prefix . "user_level' AND `meta_value` > 1");
	if ($count_users > 1) { $multipleAuthors = 1; }

// Clean page linkage
function link_pages_without_spaces() {
	ob_start();
	link_pages('<p class="pagelinks"><strong>Pages</strong>', '</p>', 'number', '', '', '%', '');
	$text = ob_get_contents();
	ob_end_clean();
	
	$text = str_replace(' <a href', '<a href', $text);
	$text = str_replace('> ', '>', $text);
	echo $text;
}

function tarski_next_previous() {
	global $wp_query;
	$wp_query->is_paged = true;
	
	// Current, hackish code
	if(is_paged() && get_tarski_option('use_pages')) {
		echo '<p class="pagination">'."\n";
		if(is_search() || $_GET['s']) {
			$prev_page_text = __('Previous results','tarski');
			$next_page_text = __('More results','tarski');
			$prev_page = '';
			$next_page = '';
			$prev_page = tarski_get_output("posts_nav_link('','&laquo; $prev_page_text', '');");
			$next_page = tarski_get_output("posts_nav_link('','','$next_page_text &raquo; ');");

			if(strip_tags($prev_page) && strip_tags($next_page)) {
				echo $prev_page . " &sect; " . $next_page;
			} else {
				echo $prev_page . $next_page;
			}
		} else {
			$prev_page_text = __('Older entries','tarski');
			$next_page_text = __('Newer entries','tarski');
			$prev_page = '';
			$next_page = '';
			$prev_page = tarski_get_output("posts_nav_link('','','&laquo; $prev_page_text');");
			$next_page = tarski_get_output("posts_nav_link('','$next_page_text &raquo;','');");

			if(strip_tags($prev_page) && strip_tags($next_page)) {
				echo $prev_page . " &sect; " . $next_page;
			} else {
				echo $prev_page . $next_page;
			}

		} echo "</p>\n";
	}
	
	/* Experimental code, not currently functioning
	if(is_paged() && get_tarski_option('use_pages')) {
		$prev_page = false;
		$next_page = false;
		if(is_search()) {
			if(clean_url(get_previous_posts_page_link())) {
				$prev_page = '<a href="' . clean_url(get_previous_posts_page_link()) . '">&laquo; ' . __('Previous results','tarski') . '</a>';
			}
			if(clean_url(get_next_posts_page_link())) {
				$next_page = '<a href="' . clean_url(get_next_posts_page_link()) . '">' . __('More results','tarski') . ' &raquo;</a>';
			}
		} else {
			if(clean_url(get_previous_posts_page_link())) {
				$prev_page = '<a href="' . clean_url(get_previous_posts_page_link()) . '">&laquo; ' . __('Older entries','tarski') . '</a>';
			}
			if(clean_url(get_next_posts_page_link())) {
				$next_page = '<a href="' . clean_url(get_next_posts_page_link()) . '">' . __('Newer entries','tarski') . ' &raquo;</a>';
			}
		}
		echo '<p class="pagination">'."\n";
		if($prev_page && $next_page) {
			echo $prev_page . " &sect; " . $next_page;
		} else {
			echo $prev_page . $next_page;
		}
		echo "</p>\n";
	}
	*/
}

// A better the_date() function
function tarski_date() {
	global $post;
	return mysql2date(get_settings('date_format'), $post->post_date);
}

// Tarski excerpts
// Code shamelessly borrowed from http://guff.szub.net/2005/02/26/the-excerpt-reloaded/
function tarski_excerpt($excerpt_length = 120, $allowedtags = '', $filter_type = 'none', $use_more_link = 1, $more_link_text = '(more...)', $force_more = 1, $fakeit = 1, $no_more = 0, $more_tag = 'div', $more_link_title = 'Continue reading this entry', $showdots = 1) {
	global $post;

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password) { // and it doesn't match cookie
			if(is_feed()) { // if this runs in a feed
				$output = __('This entry is protected.','tarski');
			} else {
				$output = get_the_password_form();
			}
		}
		return $output;
	}

	if($fakeit == 2) { // force content as excerpt
		$text = $post->post_content;
	} elseif($fakeit == 1) { // content as excerpt, if no excerpt
		$text = (empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { // excerpt no matter what
		$text = $post->post_excerpt;
	}

	if($excerpt_length < 0) {
		$output = $text;
	} else {
	if(!$no_more && strpos($text, '<!--more-->')) {
		$text = explode('<!--more-->', $text, 2);
			$l = count($text[0]);
			$more_link = 1;
		} else {
			$text = explode(' ', $text);
			if(count($text) > $excerpt_length) {
				$l = $excerpt_length;
				$ellipsis = 1;
			} else {
				$l = count($text);
				$more_link_text = '';
				$ellipsis = 0;
			}
		}
		for ($i=0; $i<$l; $i++)
			$output .= $text[$i] . ' ';
	}

	if('all' != $allowed_tags) {
		$output = strip_tags($output, $allowedtags);
	}

	$output = rtrim($output, "\s\n\t\r\0\x0B");
	$output = ($fix_tags) ? $output : balanceTags($output);
	$output .= ($showdots && $ellipsis) ? '...' : '';

	switch($more_tag) {
		case('div') :
			$tag = 'div';
			break;
		case('span') :
			$tag = 'span';
			break;
		case('p') :
			$tag = 'p';
			break;
		default :
			$tag = 'span';
			break;
	}

	if ($use_more_link && $more_link_text) {
		if($force_more) {
			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '#more-' . $post->ID .'" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
		} else {
			$output .= ' <' . $tag . ' class="more-link"><a href="'. get_permalink($post->ID) . '" title="' . $more_link_title . '">' . $more_link_text . '</a></' . $tag . '>' . "\n";
		}
	}

	$output = apply_filters($filter_type, $output);
	return $output;
}

// ~fin~ ?>