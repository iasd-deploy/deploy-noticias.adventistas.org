<?php
namespace GoCache;

if ( ! function_exists( 'add_action' ) ) {
	exit(0);
}

class Request
{
	public $header  = null;
	public $domain  = null;
	public $setting = null;

	public function __construct()
	{
		$this->setting = new Setting();

		if ( $this->setting->api_key == '' ) {
			return false;
		}

		$this->header = array( 'GoCache-Token:' . $this->setting->api_key );
		$this->domain = $this->setting->domain;
	}

	public function verify_connection( $show_message = false )
	{
		if ( ! $this->header ) {
			return;
		}

		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_URL, 'https://api.gocache.com.br/v1/domain/' . $this->domain );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->header );

		$result = curl_exec( $curl );

		curl_close( $curl );

		$result = json_decode( $result );

		if ( $result->status_code == 1 ) {
			update_option( $this->setting->get_option_name( 'external_configs' ), $result );
			update_option( $this->setting->get_option_name( 'status' ), true );
			return $show_message ? $result : true;
		}

		update_option( $this->setting->get_option_name( 'status' ), false );

		if ( $show_message ) {
			return $result;
		}

		return false;
	}

	public function update_remote_configs( $configs )
	{
		if ( ! $this->header ) {
			return;
		}

		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_URL, 'https://api.gocache.com.br/v1/domain/' . $this->domain );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'PUT' );
		curl_setopt( $curl, CURLOPT_HEADER, false ) ;
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->header );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $configs ) );

		$result = curl_exec( $curl );

		curl_close( $curl );

		return json_decode( $result );
	}

	public function delete_all_cache()
	{
		$domain = $this->domain;
		$curl   = curl_init();

		curl_setopt( $curl, CURLOPT_URL, "https://api.gocache.com.br/v1/cache/{$domain}/all" );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'DELETE' );
		curl_setopt( $curl, CURLOPT_HEADER, false ) ;
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->header );

		$result = curl_exec( $curl );

		curl_close( $curl );

		return json_decode( $result );
	}

	public function delete_cache( $urls, $append_custom_strings = false )
	{
		if ( empty( $urls ) || ! $this->header ) {
			return;
		}

		$data = array();

		foreach ( $urls as $key => $url ) {
			$data['urls'][] = esc_url( trim( $url ) );
		}

		if ( $append_custom_strings ) {
			$data['urls'] = $this->append_custom_strings( $data['urls'] );
		}

		$domain = $this->domain;
		$curl   = curl_init();

		curl_setopt( $curl, CURLOPT_URL, "https://api.gocache.com.br/v1/cache/{$domain}" );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'DELETE' );
		curl_setopt( $curl, CURLOPT_HEADER, false ) ;
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->header );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query( $data ) );

		$result = curl_exec( $curl );

		curl_close( $curl );

		return json_decode( $result );
	}

	public function append_custom_strings( $urls )
	{
		$strings       = $this->setting->clear_cache_strings;
		$modified_urls = array();

		if ( empty( $strings ) ) {
			return $urls;
		}

		$list = preg_split( "/\\r\\n|\\r|\\n/", $strings );

		if ( ! is_array( $list ) ) {
			return $urls;
		}
		
		foreach( $list as $string ) {
			foreach ( $urls as $url ) {
				array_push( $modified_urls, $url . substr( $string, 0, 20 ) );
			}
		}

		return array_merge( $urls, $modified_urls );
	}
}