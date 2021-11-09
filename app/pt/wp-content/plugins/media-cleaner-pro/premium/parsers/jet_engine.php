<?php

add_action( 'wpmc_scan_once', 'wpmc_scan_once_jet_engine', 10, 0 );

function wpmc_scan_once_jet_engine() {
  global $wpdb;
  $wpmc_jet_engine_post_types = array();
  $wpmc_jet_engine_post_types_def = array();
  $jet_post_types_table = $wpdb->prefix . "jet_post_types";
	$jet_post_types = $wpdb->get_results( "SELECT slug, meta_fields FROM {$jet_post_types_table} 
    WHERE status = 'publish'", ARRAY_A );
	foreach ( $jet_post_types as $jet_post_type ) {
    $slug = $jet_post_type['slug'];
    array_push( $wpmc_jet_engine_post_types, $slug );
    $wpmc_jet_engine_post_types_def[$slug] = array();
    $meta_fields = unserialize( $jet_post_type['meta_fields'] );
    foreach ( $meta_fields as $meta_field ) {
      if ( $meta_field['type'] === 'media' || $meta_field['type'] === 'gallery' ) {
        array_push( $wpmc_jet_engine_post_types_def[$slug], 
          array(
            'name' => $meta_field['name'],
            'type' => $meta_field['type']
            )
          );
      }
    }
	}
  set_transient( 'wpmc_jet_engine_post_types', $wpmc_jet_engine_post_types, MONTH_IN_SECONDS );
  set_transient( 'wpmc_jet_engine_post_types_def', $wpmc_jet_engine_post_types_def, MONTH_IN_SECONDS );
}	

add_action( 'wpmc_scan_postmeta', 'wpmc_scan_postmeta_jet_engine', 10, 1 );

function wpmc_scan_postmeta_jet_engine( $id ) {
  global $wpmc;

  $wpmc_jet_engine_post_types = get_transient( 'wpmc_jet_engine_post_types' );
  $wpmc_jet_engine_post_types_def = get_transient( 'wpmc_jet_engine_post_types_def' );

  $type = get_post_type( $id );
  if ( !in_array( $type, $wpmc_jet_engine_post_types ) ) {
    return;
  }

  $jet_engine_post_type_def = $wpmc_jet_engine_post_types_def[$type];
  foreach ( $jet_engine_post_type_def as $field ) {
    $value = get_post_meta( $id, $field['name'], true );
    if ( $field['type'] === 'gallery' ) {
      $value = explode( ',', $value );
      $value = array_map( 'intval', $value );
    }
    else {
      $value = (int)$value;
    }
    $wpmc->add_reference_id( $value, 'JET ENGINE META (ID)' );
  }
}

?>