<?php
/**
 * GoCache Manager
 *
 * @package GoCache
 * @version 1.0
 */
namespace GoCache;

// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) {
	exit(0);
}

//Core
App::uses( 'utils', 'Helper' );
App::uses( 'l10n', 'Helper' );
App::uses( 'view', 'View' );
App::uses( 'settings', 'Controller' );
App::uses( 'requests', 'Controller' );
App::uses( 'cache', 'Controller' );

class Core
{
	/**
	 * Pages Enqueue Media
	 *
	 * @since 1.1
	 * @var array
	 */
	public $pages_enqueue_media = array(
		'post.php',
		'post-new.php',
		'themes.php',
	);

	/**
	 * Namespace
	 *
	 * @since 1.1
	 * @var string
	 */
	public $namespace = 'GoCache';

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 1.0
	 */
	public function __construct()
	{
		// Generic hooks
		add_action( 'plugins_loaded', array( 'GoCache\App', 'load_textdomain' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'scripts_admin' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'styles_admin' ) );

		$this->load_controllers(
			array(
				'Settings',
				'Requests',
				'Cache'
			)
		);
	}

	public function activate()
	{

	}

	public function load_controllers( $controllers, $activate = false )
	{
		foreach ( $controllers as $name ) {
			$class = sprintf( "{$this->namespace}\%s_Controller", $name );
			$this->_handle_instance( $class, $activate );
		}
	}

	public function load_wp_media()
	{
		global $pagenow;

		if ( did_action( 'wp_enqueue_media' ) ) {
			return;
		}

		if ( in_array( $pagenow, $this->pages_enqueue_media ) ) {
			wp_enqueue_media();
		}
	}

	public function scripts_admin()
	{
		wp_enqueue_script(
			'admin-script-' . App::PLUGIN_SLUG,
			App::plugins_url( '/assets/javascripts/built.js' ),
			array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable' ),
			App::filemtime( 'assets/javascripts/built.js' ),
			true
		);

		wp_localize_script(
			'admin-script-' . App::PLUGIN_SLUG,
			'AdminGlobalVars',
			array(
				'urlAjax' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	public function styles_admin()
	{
		wp_enqueue_style(
			'admin-css-' . App::PLUGIN_SLUG,
			App::plugins_url( 'assets/stylesheets/style.css' ),
			array(),
			App::filemtime( 'assets/stylesheets/style.css' )
		);
	}

	private function _handle_instance( $class, $activate = false )
	{
		if ( ! $activate ) {
			$instance = new $class();
			return;
		}

		$instance = new $class( true );
		$instance->add_capabilities( array( 'administrator', 'editor' ) );
		unset( $instance );
	}
}
