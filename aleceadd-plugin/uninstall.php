<?php
/*
* Trigger this file on uninstall

*/

if(!defined('WP_UNINSTALL_PLUGIN')){
	die();
}

//clear database data
$books = get_posts(array('post_type'=>'book','numberposts'=>-1));

if(!empty($books)){
	foreach ($books as $book) {
		# code...
		wp_delete_post($book->ID,true);
	}
}

// Access the database via SQL
// global $wpdb; 
// $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book' ");
// $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN(SELECT id FROM wp_posts)");
// $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN(SELECT id FROM wp_posts)");