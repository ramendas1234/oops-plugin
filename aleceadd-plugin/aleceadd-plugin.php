<?php
/*
Plugin Name: Aleceadd Plugin
Plugin URI: https://aleceadd.com/plugins
Description: This is my first plugin
Version: 1.0.0
Author: Ramen Das
*/



defined('ABSPATH') or die('Sorry abspath not defined');

class AleceaddPlugin{
	function __construct(){
		add_action('init',array($this,'custom_post_type'));
	}

	function register(){
		add_action('admin_enqueue_scripts',array($this,'enqueue'));
	}
	function activate(){
		$this->custom_post_type();
		flush_rewrite_rules();
	}
	function deactivate(){
		flush_rewrite_rules();
	}

	function custom_post_type(){
		register_post_type('book',['public'=>true,'label'=>'Books']);
	}
	function enqueue(){
		// enqueue all our scripts
		wp_enqueue_style('style-css',plugins_url('/assets/css/aleceadd-style.css',__FILE__));
	}
}


if(class_exists('AleceaddPlugin')){
	$aleceaddPlugin = new AleceaddPlugin();
	$aleceaddPlugin->register();
}

// activate
register_activation_hook(__FILE__, array($aleceaddPlugin,'activate'));

// Deactivate
register_deactivation_hook(__FILE__, array($aleceaddPlugin,'deactivate'));

?>