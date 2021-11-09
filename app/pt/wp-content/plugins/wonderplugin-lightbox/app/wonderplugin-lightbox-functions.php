<?php

if ( ! defined( 'ABSPATH' ) )
	exit;
	
function wonderplugin_lightbox_wp_check_filetype_and_ext($data, $file, $filename, $mimes) {

	$filetype = wp_check_filetype( $filename, $mimes );

	return array(
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename']
	);
}
