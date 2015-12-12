<?php

/**
 * Filter added to WP_Query to filter by title with like
 */
add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, &$wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}

// Post list from ajax request only for admin
if (is_admin ()) {
	add_action ( 'wp_ajax_lougeact_get_post', 'lougeact_get_post' );
	function lougeact_get_post() {
		$response = array (
				"results" => array (),
				"more" => true
		);

		if ( ! isset (  $_GET ['title'] ) ||  $_GET ['title'] == "") {
			wp_send_json ( $response );
		}

		$title = $_GET ['title'];

		$args = array (
				'post_title_like' => $title,
				'orderby' => 'title',
				'order' => 'DESC',
				'post_status' => 'publish',
				'post_type' => 'any',
				'suppress_filters' => false,
				'posts_per_page'=> 100,
				'nopaging' => true
		);
		if ( isset (  $_GET ['type'] ) &&  $_GET ['type'] != "") {
			$args["post_type"] = explode ( ",", $_GET ['type']);
		}

		$query = new WP_Query ( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$response ["results"] [] = array (
						"id" => get_the_ID(),
						"text" => "[". get_post_type() . "] " . get_the_title()
				);
			}
		}
		wp_reset_postdata();
		wp_send_json ( $response );
	}
}

function hex2rgba($hex, $opacity = 1) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b, $opacity);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}
