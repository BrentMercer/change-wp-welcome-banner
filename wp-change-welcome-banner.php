<?php
/*
 * Plugin Name:	WP Change Welcome Banner
 * Description:	Chanegs WordPress's welcome banner and adds a custom title and message.
 * Plugin URI:	http://brentmercer.com/wp-change-welcome-banner-plugin/
 * Author: 		Brent Mercer
 * Author URI: 	http://brentmercer.com/
 * Version:		1.0.0
 * License:		GPLv2 or later
 * License URI:	https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:	wp-change-welcome-banner
 * Domain Path:	/languages

Perfect Portfolio is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Perfect Portfolio is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Perfect Portfolio. If not, see https://www.gnu.org/licenses/gpl-2.0.txt.
*/

// Exit is accessed directly.
if ( !defined( 'ABSPATH' ) ) exit;

class WP_Change_Welcome_Banner {
	private static $_instance = null;
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}
	private function __construct() {
		// place hooks here
		remove_action( 'welcome_panel', 'wp_welcome_panel' );
		add_action( 'welcome_panel', array( $this, 'new_welcome' ));
		add_action( 'admin_enqueue_scripts', array( $this, 'add_css') );
	}
	function new_welcome(){
		?>
		<div class="welcome-panel-content">
			<h2><?php //insert title from user input ?></h2>
			<p><?php //insert custom message from user input ?></p>
		</div>
		<?php
	}
	function add_css(){
		wp_register_style( 'wp-change-welcome-banner', plugin_dir_url(__FILE__) . 'wp-change-welcome-banner.css' );
		wp_enqueue_style( 'wp-change-welcome-banner' );
	}
}

add_action( 'plugins_loaded', 'WP_Change_Welcome_Banner::instance' );
register_activation_hook( __FILE__, 'WP_Change_Welcome_Banner::do_activate' );
register_deactivation_hook( __FILE__, 'WP_Change_Welcome_Banner::do_deactivate' );
register_uninstall_hook( __FILE__, 'WP_Change_Welcome_Banner::do_uninstall' );
		