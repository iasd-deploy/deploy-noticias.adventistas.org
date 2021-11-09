<?php
/**
Plugin Name: Tempo Ral - Portal Adventista
Description: Série de widgets e ferramentas usadas pelo Portal Adventista.
Author: Web Internet DSA
Version: 1.2.1
*/

require_once("classes/TempoReal_TemplateFiles.class.php");
require_once("classes/TempoReal_ACF.class.php");
require_once("classes/TempoReal_FieldsACF.class.php");
require_once("classes/TempoReal_CSS.class.php");

class RealTimeController {
	
	public static function Init() {
		// Registrando uma sidebar exclusiva para o Tempo Real
		do_action('iasd_register_sidebar', 
			array('name' => __('Tempo Real', 'iasd'),
				'id' => 'news-real-time',
				'col_class' => 'col-md-4',
				'description' => __('Sidebar de colunagem 1/3', 'iasd')
			)
		);
	}	

	public static function CheckDependence() {
		if( ! function_exists('acf') )
		    echo '<div class="error notice is-dismissible"><p>' . __( 'Aviso: O tema precisa do plugin') . ' <a href="http://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Fields PRO</a> ' . __('ativo para funcionar corretamente.', 'iasd' ) . '</p></div>';
	}

	public static function Scripts() {

		if( is_page_template( 'page-tempo-real.php' ) ) {
			// JS
			$src = plugin_dir_url( __FILE__ ) . 'custom_static/real-time/js/real-time.js';
			wp_enqueue_script( 'real-time-js', $src, array( 'jquery' ), '1.0.0', true );

			// CSS
			$src = plugin_dir_url( __FILE__ ) . 'custom_static/real-time/css/tempo-real.css';
			wp_enqueue_style( 'real-time-styles', $src, array(), '1.0.1', 'screen' );

			//AngularJS
			wp_enqueue_script( 'angular', "//ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.min.js", '1.4.9', true );
			wp_enqueue_script( 'angular-sanitize', "//ajax.googleapis.com/ajax/libs/angularjs/1.4.11/angular-sanitize.js", '1.4.11', true );
		}
	}

	public static function BodyClass($classes) {

		if( get_field('bg_image') && 
			is_page_template( 'page-tempo-real.php' )){

			$classes[] = 'custom_bg';

		}
		return $classes;
	}

	public static function PreFetch() {
		echo '<link rel="prefetch" href="'. RealTimeController::JsonUrl() .'" />';
	}

	public static function JsonUrl() {
		$post_id = get_the_ID();
		$json_url = get_field('json_url', $post_id);
		return $json_url;
	}
}

add_action( 'init', array('RealTimeController', 'Init') );
add_filter( 'body_class', array('RealTimeController', 'BodyClass') );
add_action( 'admin_notices', array('RealTimeController', 'CheckDependence') );
add_action( 'wp_enqueue_scripts', array('RealTimeController', 'Scripts') );
add_action( 'wp_head', array('RealTimeController', 'PreFetch') );