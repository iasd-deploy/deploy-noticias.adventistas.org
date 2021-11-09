<?php

/*
Plugin Name: PA - Plugin - Admin Bar
Plugin URI: https://bitbucket.org/internetdsa/pa-plugin-admin-bar
Description: Customiza a barra administrativa dos sites vídeos/notícias/downloads do Portal Adventista.
Version: 1.0.1
Author: Eli Mendonça
*/

function add_sumtips_admin_bar_link() {
	global $wp_admin_bar;

	$lang = substr(get_locale(), 0, -3);

	$wp_admin_bar->add_menu( array(
		'id' => 'quick_access',
		'title' => __( 'Acesso rápido'),
		'meta' => array(
			'class' => 'menu_quick',),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'quick_access',
		'id' => 'downloads',
		'title' => __( 'Downloads'),
		'href' => __('http://downloads.adventistas.org/'. $lang .'/wp-admin/'),
		'meta' => array(
			'class' => 'menu_downloads',),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'quick_access',
		'id' => 'noticias',
		'title' => __( 'Notícias'),
		'href' => __('http://noticias.adventistas.org/'. $lang .'/wp-admin/'),
		'meta' => array(
			'class' => 'menu_noticias',),
	));

	$wp_admin_bar->add_menu( array(
		'parent' => 'quick_access',
		'id' => 'videos',
		'title' => __('Vídeos'),
		'href' => __('http://videos.adventistas.org/'. $lang .'/wp-admin/'),
		'meta' => array(
			'class' => 'menu_videos',),
	));
}
add_action('admin_bar_menu', 'add_sumtips_admin_bar_link', 90);

function load_custom_wp_admin_style() {
	wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) .'assets/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style');
add_action( 'wp_enqueue_scripts', 'load_custom_wp_admin_style' );