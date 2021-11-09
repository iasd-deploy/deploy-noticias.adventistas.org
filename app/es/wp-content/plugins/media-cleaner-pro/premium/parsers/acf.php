<?php

add_action( 'wpmc_scan_once', 'wpmc_scan_once_acf', 10, 0 );
add_action( 'wpmc_scan_post', 'wpmc_scan_html_acf', 10, 2 );
add_action( 'wpmc_scan_postmeta', 'wpmc_scan_postmeta_acf' );

function wpmc_scan_once_acf() {
	$wpmc_acf_blocks = array();
	wpmc_scan_postmeta_acf( 'options' );
	wpmc_scan_once_taxonomies_acf();

	// Handle ACF Blocks
	if ( function_exists( 'acf_get_block_types' ) ) {
		$blocks = acf_get_block_types();
		foreach ( $blocks as $block ) {
			array_push( $wpmc_acf_blocks, $block['name'] );
		}
	}

	set_transient( 'wpmc_acf_blocks', $wpmc_acf_blocks, MONTH_IN_SECONDS );
}

// Analyze an ACF Block
function wpmc_scan_acf_block( $blockData, &$images_ids, &$images_urls ) {
	foreach ( $blockData as $field => $value ) {
		if ( !empty( $field ) && $field[0] === '_' ) {
			$fieldObject = get_field_object( $value );
			if ( !empty( $fieldObject ) && $fieldObject['type'] === 'image' ) {
				$realField = ltrim( $field, '_' );
				$realValue = $blockData[$realField];
				if ( !empty( $realValue ) ) {
					array_push( $images_ids, $realValue );
				}
			}
		}
	}
}

function wpmc_scan_html_acf( $html, $id ) {
	global $wpmc;
	$images_ids = array();
	$images_urls = array();

	$post = get_post( $id );
	if ( has_blocks( $post ) ) {
		$blocks = parse_blocks( $post->post_content );
		if ( !empty( $blocks ) ) {
			$wpmc_acf_blocks = get_transient( 'wpmc_acf_blocks' );
			foreach ( $blocks as $block ) {
				if ( in_array( $block['blockName'], $wpmc_acf_blocks ) ) {
					$data = $block['attrs']['data'];
					wpmc_scan_acf_block( $data, $images_ids, $images_urls );
				} 
				else if ( $block['blockName'] === 'core/block' ) {
					$block_content = parse_blocks( get_post( $block['attrs']['ref'] )->post_content );
					if ( in_array( $block_content[0]['blockName'], $wpmc_acf_blocks ) ) {
						$data = $block_content[0]['attrs']['data'];
						wpmc_scan_acf_block( $data, $images_ids, $images_urls );
					}
				}
			}
		}
	}

	$wpmc->add_reference_id( $images_ids, 'ACF BLOCK (ID)' );
	$wpmc->add_reference_url( $images_urls, 'ACF BLOCK (URL)' );
}

function wpmc_scan_once_taxonomies_acf() {
	global $wpdb;
	$terms = $wpdb->get_results( "SELECT x.term_id, x.taxonomy 
		FROM {$wpdb->term_taxonomy} x, {$wpdb->termmeta} y 
		WHERE x.term_id = y.term_id 
		GROUP BY x.term_id, x.taxonomy"
	);
	foreach ( $terms as $term ) {
		$termStr = $term->taxonomy . '_' . $term->term_id;
		$fields = get_field_objects( $termStr );
		if ( !empty( $fields ) ) {
			//error_log( 'ACF Fields found for Taxonomy+Term ' . $termStr );
			if ( is_array( $fields ) ) {
				foreach ( $fields as $field )
					wpmc_scan_postmeta_acf_field( $field, $termStr, 8 );
			}
		}
	}
}

function wpmc_scan_postmeta_acf( $id ) {
	$fields = get_field_objects( $id );
	if ( is_array( $fields ) ) {
		foreach ( $fields as $field )
			wpmc_scan_postmeta_acf_field( $field, $id, 8 );
	}
}

/**
 * Scans a single ACF field object.
 * If the specified field is a repeater or a flexible content,
 * scans each subfield recursively.
 *
 * @param array $field
 * An associative array replesenting a single ACF field.
 * The actual array must be structured like this:
 * array (
 *   'name'  => The name of the field
 *   'type'  => The field type i.e. 'text', 'object', 'repeater'
 *   'value' => The value
 *   ...
 * )
 * @param int $id The post ID
 * @param int $recursion_limit The max recursion depth. Negative number means unlimited
 *
 * @since ACF 5.6.10
 */
function wpmc_scan_postmeta_acf_field( $field, $id, $recursion_limit = -1 ) {
	if ( !isset( $field['type'] ) ) return;

	global $wpmc;

	/** Multiple Fields (Repeater or Flexible Content) **/
	static $recursives = array ( // Possibly Recursive Types
		'repeater',
		'flexible_content',
		'group'
	);

	// Test during debugging for https://secure.helpscout.net/conversation/1282938126/5688?folderId=1781329
	// It looks like have_rows doesn't retrieve the subfields. 
	// if ( $field['label'] === 'Contenu' ) {
	// 	error_log('WE ARE IN.');
	// 	$result = get_field( 'field_5ef406abe560d', $id );
	// 	$result2 = get_sub_field( 'field_5ef406abe560d', $id );
	// 	$result = get_field( 'field_5ef406a0e560c', $id );
	// 	$result2 = get_sub_field( 'field_5ef406a0e560c', $id );
	// }

	$is_recursive = in_array( $field['type'], $recursives );
	// have_rows (ACF): This function checks to see if a parent field (such as Repeater or Flexible Content) has any rows of data to loop over.
	$is_recursive_with_rows = $is_recursive && have_rows( $field['name'], $id );

	if ( $is_recursive_with_rows ) {
		if ( $recursion_limit == 0 ) return; // Too much recursion
		do { // Iterate over rows
			$row = the_row( true );
			foreach ( $row as $col => $value ) { // Iterate over columns (subfields)
				$subfield = get_sub_field_object( $col, true, true );
				if ( !is_array( $subfield ) ) 
					continue;
				// if ( WP_DEBUG ) { // XXX Debug
				// 	if ( !isset( $subfield['value'] ) )
				// 		trigger_error( 'Unexpected Situation: $subfield[value] is not set', E_USER_ERROR );
				// 	if ( $subfield['value'] != $value )
				// 		trigger_error( 'Unexpected Situation: $subfield[value] has unexpected value', E_USER_ERROR );
				// }
				wpmc_scan_postmeta_acf_field( $subfield, $id, $recursion_limit - 1 ); // Recursion
			}
		} while ( have_rows( $field['name'], $id ) );
		return;
	}
	
	/** Singular Field **/
	$postmeta_images_acf_ids = array();
	$postmeta_images_acf_urls = array();

	$format = "";
	if ( isset( $field['return_format'] ) )
		$format = $field['return_format'];
	else if ( isset( $field['save_format'] ) )
		$format = $field['save_format'];

	// ACF Image ID and URL
	if ( $field['type'] == 'image' && ( $format == 'array' || $format == 'object' ) ) {
		if ( !empty( $field['value']['id'] ) )
			array_push( $postmeta_images_acf_ids, $field['value']['id'] );
		if ( !empty( $field['value']['url'] ) )
			array_push( $postmeta_images_acf_urls, $wpmc->clean_url( $field['value']['url'] ) );
	}
	// ACF Image ID
	else if ( $field['type'] == 'image' && $format == 'id' && !empty( $field['value'] ) ) {
		array_push( $postmeta_images_acf_ids, $field['value'] );
	}
	// ACF Image URL
	else if ( $field['type'] == 'image' && $format == 'url' && !empty( $field['value'] ) ) {
		array_push( $postmeta_images_acf_urls, $wpmc->clean_url( $field['value'] ) );
	}
	// ACF Gallery
	else if ( $field['type'] == 'gallery' && !empty( $field['value'] ) ) {
		foreach ( $field['value'] as $media ) {
			if ( !empty( $media['id'] ) )
				array_push( $postmeta_images_acf_ids, $media['id'] );
		}
	}
	// ACF File
	else if ( $field['type'] == 'file' && !empty( $field['value'] ) ) {
		$value = $field['value'];
		if ( is_array( $value ) ) {
			$value = $value['url'];
		}
		array_push( $postmeta_images_acf_urls, $wpmc->clean_url( $value ) );
	}
	// ACF Aspect Ratio Crop
	else if ( $field['type'] == 'image_aspect_ratio_crop' && !empty( $field['value'] ) ) {
		$value = $field['value'];
		if ( is_array( $value ) ) {
			$id = $value['id']; // Latest crop
			array_push( $postmeta_images_acf_ids, $id );
			$id = $value['original_image']['id']; // Original image
			array_push( $postmeta_images_acf_ids, $id );
		}
	}
	// ACF Clone 
	else if ( $field['type'] === 'clone' && is_array( $field['value'] ) ) {
		if ( isset( $field['value']['media_type'] ) && $field['value']['media_type'] === 'image' ) {
			array_push( $postmeta_images_acf_ids, $field['value']['media_image']['id'] );
		}
	}
	else if ( $field['type'] === 'repeater' && is_array( $field['value'] ) ) {
		// Handle this case: https://secure.helpscout.net/conversation/1523898475/7197?folderId=1781329
		foreach ( $field['value'] as $value ) {
			if ( isset( $value['image'] ) && is_int( $value['image'] ) ) {
				array_push( $postmeta_images_acf_ids, $value['image'] );
			}
		}
	}
	else {
		if ( $field['type'] !== 'text' && $field['type'] !== 'wysiwyg' )
			// error_log( 'This ACF field is not supported by Media Cleaner: ' . 
			// 	$field['type'] . ' -> ' . $field['format'] . ' = ' . print_r( $field['value'], 1 ) );
		return;
	}

	$wpmc->add_reference_id( $postmeta_images_acf_ids, 'ACF (ID)' );
	$wpmc->add_reference_url( $postmeta_images_acf_urls, 'ACF (URL)' );
}

?>