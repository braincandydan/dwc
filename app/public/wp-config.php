<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'T`nmpte?&J>(1Mv PD ,1.2TA^_2Sy9X&HBttHs8J3iT)LA}yR25(b@g)Ic~~_Nd' );
define( 'SECURE_AUTH_KEY',   'i,<<&B(#&3bP5d8bE<3xF)/_!Q&V4UKK8jxiGi r10cq:zH$lA4dIL4&_k=L;:Mm' );
define( 'LOGGED_IN_KEY',     '0I-lPG6({A!LwwA9[(nR{S$U[i9d|[!SJecIE;6XV:HD[{8kZK0s9d_7?Rt/|Jk6' );
define( 'NONCE_KEY',         '[B~#|F[,d|[=OUs2&MiEZ9{a1RgTM0GiFmT~G^R$U`XyaC)QGXd.yf#*vMTp?zBs' );
define( 'AUTH_SALT',         '}wH)D8m*CY rWs!3nOiVb^+p^sG/|l2is5 (~61Oeo;z/PI>m;7l{8#?8+k|:]:s' );
define( 'SECURE_AUTH_SALT',  '/;G@Szb]A-MhAmtDlmB^7 14<kX.VloQs&fu^Ym_*$6nr+p>xa@D-(zoSq_,{yWm' );
define( 'LOGGED_IN_SALT',    '+;R{tE.)oj6@)HlnQhc%PD Y$a?KLXjev:w`Z$6$1Ai)LWW7wYQLy2`3Qo9[=2=/' );
define( 'NONCE_SALT',        'lz_0/cc>]V?|Sjx&-n0]#u.+vMiAnbT@?OZrm4QaVVu>VJl$4zNKxtv~H!wzBWtH' );
define( 'WP_CACHE_KEY_SALT', 'aM?_V1QMFtVsHthcf6o/l>2_b8SHRxY:=,O=2s(W]?fGqpgu~/0@:!I~}XVR8GEK' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
