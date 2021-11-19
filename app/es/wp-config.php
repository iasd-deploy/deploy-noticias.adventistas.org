<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $_ENV['WP_DB_NAME'] . "_es");

/** MySQL database username */
define('DB_USER', $_ENV['WP_DB_USER']);

/** MySQL database password */
define('DB_PASSWORD', $_ENV['WP_DB_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_ENV['WP_DB_HOST'] . ':3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8mb4_unicode_ci');

define('AS3CF_SETTINGS', serialize(array(
	'provider' => 'aws',
	'access-key-id' => $_ENV['WP_S3_ACCESS_KEY'],
	'secret-access-key' => $_ENV['WP_S3_SECRET_KEY'],
	'bucket' => $_ENV['WP_S3_BUCKET']
)));

/** configuracoes personalizadas */
define('WP_MAX_MEMORY_LIMIT', '512M');
define('SITE', 'noticias');
define('DISALLOW_FILE_EDIT', true);
define('WP_AUTO_UPDATE_CORE', false);
define('FORCE_SSL', true);
define('FORCE_SSL_ADMIN', true);
$_SERVER['HTTPS'] = 'on';

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'noticias.adventistas.org');
define('PATH_CURRENT_SITE', '/es/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('WP_POST_REVISIONS', false);

header('X-Frame-Options: SAMEORIGIN');
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);


# define('DISABLE_WP_CRON', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(nnOrlhWYR{,_PMnf=O|&q,4Zv}[Y2ky:+ AUVYB#J.Pos/D&;4cO6cg]~v(()j?');
define('SECURE_AUTH_KEY',  '%-)q0.Y!~c1qK0~6sj{1Te)}^:%%[{WflRmO-GUos{L#_+&?|/Y|4C4p<N-CBgca');
define('LOGGED_IN_KEY',    ':-445P|4_sn0sT6lT2h7!-Fen|Pl$<$1gA|o=nlwR;tQUkS(@JCS,f|IXnY=!TC|');
define('NONCE_KEY',        '<Ka*xga95XkU=W?Ja{K~o+~%G[$q`I<hC|nKGgY+F!wFla~Y}QxtU:c-7slFv3n_');
define('AUTH_SALT',        'E!7g|(KvPn;/rNgkj>}~k#`)C5zYmYJI0JMamO+oTaqBLMeuzQEf/uN!#FqemijA');
define('SECURE_AUTH_SALT', 'U^6.{<=lqY(UryQ3V|/V,?<Z:8`<vHs/g(ZSo+l80dNdu62&B.8J-&<`1Gcqmf0>');
define('LOGGED_IN_SALT',   '{pMMfQBsw*3lmSP%zh{]M7x>-=2[2~bl~^]ayqkr@gpvQW-Q6[o$rYjpFK[`!FYZ');
define('NONCE_SALT',       '7(>AIi(da-nW~o;=`d(-<>E-3e<<COZH,,%^d=0PMEs.B!B %j{gS}{depK3+mv+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'es_ES');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/** Enable Cache */
// Added by WP Rocket

//define( 'PB_BACKUPBUDDY_MULTISITE_EXPERIMENT', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
