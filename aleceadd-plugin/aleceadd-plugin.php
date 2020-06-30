<?php
/*
* @package AlecaddPlugin
*/
/*
Plugin Name: Aleceadd Plugin
Plugin URI: https://aleceadd.com/plugins
Description: This is my first plugin
Version: 1.0.0
Author: Ramen Das
*/



defined('ABSPATH') or die('Sorry abspath not defined');
if(!class_exists('AleceaddPlugin')){
class AleceaddPlugin{
	public $plugin;
	function __construct(){
		$this->plugin = plugin_basename(__FILE__);
	}

	function register(){
		add_action('init',array($this,'custom_post_type'));
		add_action('admin_enqueue_scripts',array($this,'enqueue'));
		add_action('admin_menu',array($this,'add_admin_pages'));

		add_filter("plugin_action_links_$this->plugin",array($this,'settings_link'));
	}
	
	public function settings_link($links){
		// add custom settings link
		$settings_link = '<a href="admin.php?page=aleceadd_plugin">Settings</a>';
		array_push($links, $settings_link);
		return $links;

	}
	public function add_admin_pages(){
		add_menu_page('Aleceadd Plugin','Aleceadd','manage_options','aleceadd_plugin',array($this,'admin_index'),'dashicons-store',110);
	}
	public function admin_index(){
		require_once plugin_dir_path(__FILE__).'templates/admin.php';
	}
	function custom_post_type(){
		register_post_type('book',['public'=>true,'label'=>'Books']);
	}
	function enqueue(){
		// enqueue all our scripts
		wp_enqueue_style('style-css',plugins_url('/assets/css/aleceadd-style.css',__FILE__));
	}
	function activate(){
		require_once plugin_dir_path(__FILE__).'inc/activate.php';
		AlecaddPluginActivate::activate();
	}
}



	$aleceaddPlugin = new AleceaddPlugin();
	$aleceaddPlugin->register();

// activate

register_activation_hook(__FILE__, array($aleceaddPlugin,'activate'));

// Deactivate
require_once plugin_dir_path(__FILE__).'inc/deactivate.php';
register_deactivation_hook(__FILE__, array('AlecaddPluginDeactivate','deactivate'));

}

?>