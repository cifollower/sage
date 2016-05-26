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

// $onGae is true on production.
if (isset($_SERVER['SERVER_SOFTWARE'])
    && strpos($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') !== false) {
    $onGae = true;
} else {
    $onGae = false;
}

// Cache settings
define('WP_CACHE', $onGae);
$batcache = [
    'seconds' => 0,
    'max_age' => 30 * 60, // 30 minutes
    'debug' => false
];

// Disable pseudo cron behavior
define('DISABLE_WP_CRON', true);

// Determine HTTP or HTTPS, then set WP_SITEURL and WP_HOME
if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) {
    $protocol_to_use = 'https://';
} else {
    $protocol_to_use = 'http://';
}
if (isset($_SERVER['HTTP_HOST'])) {
    define('HTTP_HOST', $_SERVER['HTTP_HOST']);
} else {
    define('HTTP_HOST', 'localhost');
}
define('WP_SITEURL', $protocol_to_use . HTTP_HOST);
define('WP_HOME', $protocol_to_use . HTTP_HOST);

// ** MySQL settings - You can get this info from your web host ** //
if ($onGae) {
    /** The name of the Cloud SQL database for WordPress */
    define('DB_NAME', 'wp');
    /** Production login info */
    define('DB_HOST', ':/cloudsql/links-test-project:wp');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'p@ssword');
} else {
    /** The name of the local database for WordPress */
    define('DB_NAME', 'wp');
    /** Local environment MySQL login info */
    define('DB_HOST', '127.0.0.1');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'p@ssword');
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rbnIHApp6qzmCciOFfl9+X5iGbKaqriomzwd2b2EVTVKzFrsAMPmCD4UHzNeuq5MYcve4rGb9JpdctBL');
define('SECURE_AUTH_KEY',  '9svmteZjyy1AnQWqfXORPkJmFloCExHB07WgyksTDIs8ek1RmEVe4e26c6afBL2kd8JaZU7YJw1cxlzP');
define('LOGGED_IN_KEY',    'Y69PE94ykVzfZjgylbGv8sVOv3VsBAsTXjqb/h5BosmTWPC+xuO+w6i0AxiayI4MIEiEraq1qFTfh59B');
define('NONCE_KEY',        'WkppmskUcwyRChi/bTBe7CrXawoGRiaPGGjkPG0QqrzSc6LvsKxkhQ/+bbztch8JOxuwkzGsrulxnYHZ');
define('AUTH_SALT',        'xTaKZCcz6sW8XZCWeuM3ENpUVsSaScJpgdg3HhTEN2j6aSIjKFXhKt7OSucuaHDVcD6OBodpleeBWONP');
define('SECURE_AUTH_SALT', 'bgFBDTxo0fJkRy2AX5QSdVeyBZ3rP5hwGvVF39dJ9n2iBUpiXMD3L/HytqB3+xfobWadHnQWKykcMYc0');
define('LOGGED_IN_SALT',   '7MRQuTDyzFT9sheYdJLRWuFaQNKXr03c3Nf1M6E0e1mCgZ9YN8NpL83KNOYmFNmgRJk27X3fgUZyP/wW');
define('NONCE_SALT',       '+SOofAfM2GjMkXG5lbG/fNiR8+ZoR5jb0nzWD0rzsCotbLVPVbCS3Ho3RLETnPgybATWfNt6MJrNbjwd');

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
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', !$onGae);

/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/wordpress/');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
