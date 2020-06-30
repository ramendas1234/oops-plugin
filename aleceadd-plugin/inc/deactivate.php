<?php
/*
* @package AlecaddPlugin
*/

class AlecaddPluginDeactivate{

	public static function deactivate(){
		flush_rewrite_rules();
	}
}