<?php
/*
	Plugin Name: Name Support
	Description: Infrastructure plugin which adds UI support for custom post types with names instead of titles, e.g. "person" custom post types.
	Author: mitcho (Michael Yoshitaka Erlewine)
	Version: 0.1
	Author URI: http://mitcho.com/
	License: GPL v2 or later
*/

class Name_Support {
	function __construct() {
		add_action( 'wp_loaded', array($this, 'setup') );
		add_action( 'dbx_post_advanced', array($this, 'enqueue') );
		add_action( 'wp_insert_post_data', array($this, 'insert_name'), 10, 2 );
	}

	private $post_types = array();
	function setup() {
		foreach ( get_post_types( array( 'show_ui' => true ) ) as $post_type ) {
			if ( !post_type_supports( $post_type, 'name' ) )
				continue;
			$this->post_types[] = $post_type;
		}
	}
	
	function enqueue() {
		global $post_type;
		if ( in_array( $post_type, $this->post_types ) ) {
			wp_enqueue_script('name-support', plugins_url('name-support.js', __FILE__), array('jquery'), 0.1, true);
			wp_enqueue_style('name-support', plugins_url('name-support.css', __FILE__), 0.1, true);
		}
	}
	
	function insert_name($data, $postarr) {
		if ( post_type_supports( $data['post_type'], 'name' ) &&
			 isset($postarr['first_name']) && isset($postarr['last_name']) ) {
			// setup name as title
			$first_name = $this->sanitize_name($postarr['first_name']);
			$last_name = $this->sanitize_name($postarr['last_name']);
			$data['post_title'] = $last_name . ', ' . $first_name;
			
			// setup slug
			$data['post_name'] = wp_unique_post_slug( strtolower($last_name), $postarr['ID'], $data['post_status'], $data['post_type'], $data['post_parent'] );
		}
		
		return $data;
	}
	
	private function sanitize_name($name, $post_id = null, $context = 'db') {
		return str_replace(',', '', sanitize_post_field('post_title', $name, $post_id, $context) );
	}
}
new Name_Support;

function get_the_name() {
	global $post;
	$title = get_the_title();
	if ( !post_type_supports( $post->post_type, 'name' ) )
		return $title;
	if ( $names = split(',', $title) )
		return trim("{$names[1]} {$names[0]}");
}
function the_name() {
	echo get_the_name();
}