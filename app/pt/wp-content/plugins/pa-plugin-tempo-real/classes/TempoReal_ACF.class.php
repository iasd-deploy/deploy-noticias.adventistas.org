<?php class TempoReal_ACF {

	public static function init(){
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
			add_filter('acf/settings/path', array('TempoReal_ACF', 'acf_settings_path') );
			add_filter('acf/settings/dir', array('TempoReal_ACF', 'acf_settings_dir') );
		}
	}

	public static function acf_settings_path( $path ) {
		$path = WP_PLUGIN_DIR . '/pa-plugin-tempo-real/advanced-custom-fields-pro/';
		return $path; 
	}

	public static function acf_settings_dir( $dir ) {
 		$dir = plugin_dir_url( __FILE__ ) . '../advanced-custom-fields-pro/';
		return $dir;
	}
}

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	add_filter('acf/settings/show_admin', '__return_false');
	add_action( 'admin_init', array('TempoReal_ACF', 'init') );
} 

include_once( WP_PLUGIN_DIR . '/pa-plugin-tempo-real/advanced-custom-fields-pro/acf.php' );
