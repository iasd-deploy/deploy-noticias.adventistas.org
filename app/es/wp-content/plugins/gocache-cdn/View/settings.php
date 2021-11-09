<?php
namespace GoCache;

if ( ! function_exists( 'add_action' ) ) {
	exit(0);
}

class Settings_View extends View
{
	public static function render_start_page()
	{
		?>

		<div id="gocache-admin" class="wrap gocache-settings">

			<div class="row">

				<div class="main-content">

					<div class="gocache-logo">
						<img src="<?php echo App::plugins_url( 'assets/images/logo-gocache.png' ); ?>">
					</div>

					<h3><?php _e( 'Start', App::TEXTDOMAIN ); ?></h3>

					<p>
						Conecta seu WordPress com a GoCache, CDN de última geração, que acelera de forma inteligente as páginas e arquivos estáticos do site, reduzindo o consumo de recursos no servidor web e banco de dados.

						Para mais informações sobre a instalação e configuração do plugin, <a target="_blank" href="https://gocache.zendesk.com/hc/pt-br/articles/226255027">clique aqui</a>.
					</p>

				</div>

			</div>

		</div>

		<?php
	}
	public static function render_authenticate_page()
	{
		$setting   = new Setting();
		$request   = new Request();
		$response  = $request->verify_connection( true );
		$connected = ( $response && $response->status_code == 1 ) ? true : false;

		self::_render_notice( $connected, $response );

		?>

		<div id="gocache-admin" class="wrap gocache-settings">

			<div class="row">

				<div class="main-content">

					<div class="gocache-logo">
						<img src="<?php echo App::plugins_url( 'assets/images/logo-gocache.png' ); ?>">
					</div>

					<form action="options.php" method="post">
						<?php settings_fields( 'gocache-manager-settings' ); ?>
						<?php do_settings_sections( 'gocache-manager-settings' ); ?>

						<div class="form-header">
							<h3 class="title-form">
								<?php _e( 'API Settings', App::TEXTDOMAIN ); ?>
							</h3>
							<span class="help-link">
								<a target="_blank" title="Ajuda?" href="https://gocache.zendesk.com/hc/pt-br/articles/115001264228">?</a>
							</span>
						</div>

						<table class="form-table">

							<tr valign="top">
								<th scope="row">
									<?php _e( 'Status', App::TEXTDOMAIN ); ?>
								</th>
								<td>
									<?php if ( $connected ) : ?>
										<span class="status positive"><?php _e( 'CONNECTED' , App::TEXTDOMAIN ); ?></span>
									<?php else : ?>
										<span class="status neutral"><?php _e( 'NOT CONNECTED', App::TEXTDOMAIN ); ?></span>
									<?php endif; ?>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><label for="gocache_api_key"><?php _e( 'API Key', App::TEXTDOMAIN ); ?></label></th>
								<td>
									<input type="password" class="regular-text"
										   placeholder="<?php _e( 'Your GoCache API key', App::TEXTDOMAIN ); ?>"
										   id="gocache_api_key"
										   name="<?php echo $setting->get_option_name( 'api_key' ); ?>"
										   value="<?php echo $setting->api_key; ?>" />
									<p class="help">
										Digite sua API Token(Chave da API) para conectar com a sua conta na GoCache.
										<a target="_blank" href="https://gocache.zendesk.com/hc/pt-br/articles/115001135087)">Ajuda?</a>
									</p>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row"><label for="gocache_domain"><?php _e( 'Domain', App::TEXTDOMAIN ); ?></label></th>
								<td>
									<?php $domain = preg_replace( '(https?://)', '', Utils::get_domain() ); ?>
									<p class="description"><?php echo ! $domain ? '—' : $domain; ?></p>

									<input type="hidden"
										   name="<?php echo $setting->get_option_name( 'domain' ); ?>"
										   value="<?php echo $domain ?>" />
								</td>
						</table>

						<?php submit_button(); ?>

					</form>

				</div>

			</div>

		</div>

		<?php
	}

	public static function render_general_page()
	{
		$setting = new Setting();
		$request = new Request();

		$connected = $request->verify_connection();
		$configs   = get_option( 'gocache_option-external_configs' );

		?>
		<div id="gocache-admin" class="wrap gocache-settings">

			<div class="main-content">

				<div class="gocache-logo">
					<img src="<?php echo App::plugins_url( 'assets/images/logo-gocache.png' ); ?>">
				</div>

				<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
					  data-extend="gocache-ajax"
					  data-component="gocache-update">

					<div class="form-header">
						<h3 class="title-form">
							<?php _e( 'General Settings', App::TEXTDOMAIN ); ?>
						</h3>
						<span class="help-link">
							<a target="_blank" title="Ajuda?" href="https://gocache.zendesk.com/hc/pt-br/articles/115001216367">?</a>
						</span>
					</div>

					<table class="form-table">

						<tr valign="top">
							<th scope="row"><label for="gocache_smart_cache"><?php _e( 'SmartCache for WordPress', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<input type="checkbox"
									   id="gocache_smart_cache"
									   name="smart_status"
									   value="true"
									   <?php checked( $configs->response->smart_status, 'true' ); ?> />

								<p class="description">​Marque para habilitar o cache de conteúdo dinâmico</p>
							</td>
						</tr>
						<?php
							$cache_options = array(
								-1     => __( 'Disabled', App::TEXTDOMAIN ),
								604800 => __( '7 days', App::TEXTDOMAIN ),
								172800 => __( '2 days', App::TEXTDOMAIN ),
								86400  => __( '1 day', App::TEXTDOMAIN ),
								14400  => __( '4 hours', App::TEXTDOMAIN ),
								7200   => __( '2 hours', App::TEXTDOMAIN ),
								3600   => __( '1 hour', App::TEXTDOMAIN ),
								1800   => __( '30 minutes', App::TEXTDOMAIN ),
								900    => __( '15 minutes', App::TEXTDOMAIN ),
								600    => __( '10 minutes', App::TEXTDOMAIN ),
								300    => __( '5 minutes', App::TEXTDOMAIN ),
							);
						?>
						<tr valign="top">
							<th scope="row"><label for="gocache_expiration_cache"><?php _e( 'Cache expiration time', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<select name="smart_ttl" id="gocache_expiration_cache">
								<?php
									foreach ( $cache_options as $time => $text ) :
										printf( '<option %s value="%d">%s</option>', selected( $configs->response->smart_ttl, $time, false ), $time, $text );
									endforeach;
								?>
								</select>
								<p class="description">​​Defina o tempo de expiração de cache na CDN</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="gocache_gzip"><?php _e( 'GZIP Compression', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<input type="checkbox"
									   id="gocache_gzip"
									   name="gzip_status"
									   value="true"
									   <?php checked( $configs->response->gzip_status, 'true' ); ?> />
								<p class="description">​​Marque para habilitar a compressão GZIP</p>
							</td>
						</tr>
						<?php
							$browser_options = array(
								-1       => __( 'Disabled', App::TEXTDOMAIN ),
								3600     => __( '1 hour', App::TEXTDOMAIN ),
								7200     => __( '2 hours', App::TEXTDOMAIN ),
								14400    => __( '4 hours', App::TEXTDOMAIN ),
								43200    => __( '12 hours', App::TEXTDOMAIN ),
								86400    => __( '1 day', App::TEXTDOMAIN ),
								172800   => __( '2 days', App::TEXTDOMAIN ),
								345600   => __( '4 days', App::TEXTDOMAIN ),
								604800   => __( '7 days', App::TEXTDOMAIN ),
								1296000  => __( '15 days', App::TEXTDOMAIN ),
								2592000  => __( '30 days', App::TEXTDOMAIN ),
								15552000 => __( '6 months', App::TEXTDOMAIN ),
								31536000 => __( '1 year', App::TEXTDOMAIN ),
							);
						?>

						<tr valign="top">
							<th scope="row"><label for="gocache_browsercache"><?php _e( 'Browser Cache', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<select name="expires_ttl" id="gocache_browsercache">
								<?php
									foreach ( $browser_options as $time => $text ) :
										printf( '<option %s value="%d">%s</option>', selected( $configs->response->expires_ttl, $time, false ), $time, $text );
									endforeach;
								?>
								</select>
								<p class="description">​​​Defina o tempo de cache no navegador</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="gocache_debug_mode"><?php _e( 'Development Mode', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<input type="checkbox"
									   id="gocache_debug_mode"
									   name="deploy_mode"
									   value="true"
									   <?php checked( $configs->response->deploy_mode, 'true' ); ?> />
								<p class="description">​​Marque para habilitar o modo de desenvolvimento</p>
							</td>
						</tr>

					</table>

					<p class="submit">
						<?php $setting->the_nonce_field(); ?>
						<input type="hidden" name="action" value="CBS93bVqAwWnVFHw">
						<input type="submit" class="button button-primary" value="<?php _e( 'Save settings', App::TEXTDOMAIN ); ?>" data-element="submit">
					</p>

				</form>

			</div>

		</div>
		<?php
	}

	public static function render_cache_page()
	{
		$setting = new Setting();

		?>
		<div id="gocache-admin" class="wrap gocache-settings">

			<div class="main-content">

				<div class="gocache-logo">
					<img src="<?php echo App::plugins_url( 'assets/images/logo-gocache.png' ); ?>">
				</div>

				<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" data-component="gocache-ajax">

					<div class="form-header">
						<h3 class="title-form">
							<?php _e( 'Cache Settings', App::TEXTDOMAIN ); ?>
						</h3>
						<span class="help-link">
							<a target="_blank" title="Ajuda?" href="https://gocache.zendesk.com/hc/pt-br/articles/115001264428">?</a>
						</span>
					</div>

					<table data-component="clear" class="form-table">

						<tr valign="top">
							<th scope="row"><label for="gocache_clear_cache"><?php _e( 'Automatically clean cache for each published content', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<input type="radio"
									   id="gocache_clear_cache_yes"
									   name="<?php echo $setting->get_option_name( 'auto_clear_cache' ); ?>"
									   value="yes"
									   <?php checked( $setting->auto_clear_cache, 'yes' ); ?> />
								<label for="gocache_clear_cache_yes"><?php _e( 'Yes', App::TEXTDOMAIN ); ?>&nbsp;&nbsp;</label>

								<input type="radio"
									   id="gocache_clear_cache_no"
									   name="<?php echo $setting->get_option_name( 'auto_clear_cache' ); ?>"
									   value="no"
									   <?php checked( $setting->auto_clear_cache, 'no' ); ?> />
								<label for="gocache_clear_cache_no"><?php _e( 'No', App::TEXTDOMAIN ); ?></label>

								<p class="help">
									<a target="_blank" href="https://gocache.zendesk.com/hc/pt-br/articles/224896487-Por-que-%C3%A9-importante-limpar-o-cache-automaticamente-"><?php _e( 'Why it is important to automatically clear the cache?', App::TEXTDOMAIN ); ?></a>
								</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="gocache_clear_strings">Customizar chave de cache com uma string</label></th>
							<td>
								<textarea class="large-text"
										  name="<?php echo $setting->get_option_name( 'clear_cache_strings' ); ?>"
										  id="gocache_clear_strings" rows="5"><?php echo $setting->clear_cache_strings; ?></textarea>
								<p class="description">Insira uma string por linha (máximo de 3)</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><?php _e( 'Clear all cache', App::TEXTDOMAIN ); ?></th>
							<td>
								<input type="button" class="button button-secondary" data-action="all" value="<?php _e( 'Clear', App::TEXTDOMAIN ); ?>"/>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="gocache_clear_by_url"><?php _e( 'Clear by URL', App::TEXTDOMAIN ); ?></label></th>
							<td>
								<textarea class="large-text" placeholder="http://www.example.com" data-element="textarea" id="gocache_clear_by_url" rows="5"></textarea>
								<p class="description"><?php _e( 'Enter one URL per line', App::TEXTDOMAIN );  ?></p>
								<p>
									<input type="button" class="button button-secondary" data-action="by-url" value="<?php _e( 'Clear', App::TEXTDOMAIN ); ?>"/>
								</p>
							</td>
						</tr>

					</table>

					<p class="submit">
						<?php $setting->the_nonce_field(); ?>
						<input type="hidden" name="action" value="settings_gocache_save">
						<input type="submit" class="button button-primary" value="<?php _e( 'Save settings', App::TEXTDOMAIN ); ?>" data-element="submit">
					</p>

					<script type="text/javascript">
						jQuery('document').ready(function(){
							jQuery('#gocache_clear_strings').on( 'keyup', function(e){
								if ( this.value ) {
									var pieces = this.value.split('\n');
									pieces = pieces.slice(0,3);
									pieces = pieces.map(function(text){
										return text.substring(0, 20);
									});
									this.value = pieces.join('\n');
								}
							});
						});
					</script>

				</form>

			</div>

		</div>
		<?php
	}

	private static function _render_notice( $connected, $response )
	{
		if ( ! $response  || ! isset( $_REQUEST['settings-updated'] ) ) {
			return;
		}

		if ( $connected ) {
			$type    = 'notice-success';
			$message = 'Conexão realizada com sucesso.';
		} else {
			$type    = 'notice-error';
			$message = isset( $response->msg ) ? ucfirst( $response->msg ) : '';
		}

		?>
		<div id="message" class="notice <?php echo $type; ?> is-dismissible">
			<p><?php echo esc_html( $message ); ?></p>
			<button type="button" class="notice-dismiss">
			<span class="screen-reader-text">Dispensar este aviso.</span>
			</button>
		</div>
		<?php
	}
}