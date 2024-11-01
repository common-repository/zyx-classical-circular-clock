<?php
/*
Plugin Name: ZYX Classical Circular Clock
Plugin URI: http://www.web-warlocks.net/wordpress/plugins/zyx-classical-circular-clock
Description: A simple but fully customizable analog clock
Author: Xavier Faraudo, ZYX3D and the Wristwatch Web Warlocks
Version: 0.9
Author URI: http://www.web-warlocks.net/
*/

include( dirname( __FILE__ ) . '/includes/mark-flash.php' );
include( dirname( __FILE__ ) . '/includes/widget.php' );

function zyx_analog_clock_init(){
	$plugin_dir = basename( dirname( __FILE__ ) ); 
	load_plugin_textdomain( 'zyx-analog-clock' ,  'wp-content/plugins/' . $plugin_dir . '/languages', $plugin_dir . '/languages' );
	include( dirname( __FILE__ ) . '/includes/shortcodes.php');
	include( dirname( __FILE__ ) . '/includes/functions.php');
};
add_action( 'init' , 'zyx_analog_clock_init' );
?>