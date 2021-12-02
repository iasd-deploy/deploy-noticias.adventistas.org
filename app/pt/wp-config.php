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
define('DB_NAME', $_ENV['WP_DB_NAME'] . "_pt");

/** MySQL database username */
define('DB_USER', $_ENV['WP_DB_USER']);

/** MySQL database password */
define('DB_PASSWORD', $_ENV['WP_DB_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_ENV['WP_DB_HOST'] .':3306');

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
define('PA_LANG', true);

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'noticias.adventistas.org');
define('PATH_CURRENT_SITE', '/pt/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('WP_POST_REVISIONS', false);

header('X-Frame-Options: SAMEORIGIN');
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);

# define('DISABLE_WP_CRON', false);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&?gN(klKCpF H<t`3FaRh,iaHTPhbdr|vB{ShjWkL+)bRYa-=1KR8p{ +1AgJ^cN');
define('SECURE_AUTH_KEY',  'Se=[gTNGVBa+0Z,T@1hbKu,hu!lwq_?bTnZ>D]O(m|vm^[#5Pe%xKM&t+lh.+Nto');
define('LOGGED_IN_KEY',    '{@Y8Hj$?y+sg9/rgxX.qx51G|D(RKlA/q%t-5gBf.`wFZC{S:*$`U+r#1/T*FmzL');
define('NONCE_KEY',        '?.Q_h)6>(Ct#|Y:+6DmmQoiyAFE.Xkkqk4k0Y7Wq5 g8Orc_ QuQM[L77+K ]0!9');
define('AUTH_SALT',        'a:n|SRn[e@N!?U1;;n{zO0QrdGscuMqHP[{ET`dlYz3Bp Pz,!Mc3Q=<NcbO5362');
define('SECURE_AUTH_SALT', '`+->jP+LcZd*T0Fi$HlZ7<6iMv^2_@/7ir*bMxJJ[#<Ld185&x/{-k8NR4W(>oPH');
define('LOGGED_IN_SALT',   'B@0Eg0CcW}3CWv{gvw?=,dwAWmiq|B/X`-sdtg~OvwB-xIwR>IMa<B[g2eV|$lUd');
define('NONCE_SALT',       'F&Ldq.kd-8xJe:bk }FsmM&v5ur@+He92EP)-1|#.YT6GL&1u[&RfsZSj9+4Y|I9');

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
define('WPLANG', 'pt_BR');

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
