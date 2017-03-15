<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'test_task' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'r)|*R-~x;iaIi[;pnY%-ZeV|LUH|Z5M9TQC,d;dsDLcgPDD$`j38L}Lv0V?]+hs~');
define('SECURE_AUTH_KEY',  'w17z,dE_PX~7xtW|D4wU5r&rQjc,fa]P&}g>F1F;s!/?.TN.bH^X-/V[v)#sOPHX');
define('LOGGED_IN_KEY',    'I5t!r(t;oXx:o8@o;Y$o`G|J1csg$,0_QPWr::stK_{|%vw8-CW<e-j;sh5.T_<b');
define('NONCE_KEY',        'N|TUhb^R#6|(zt4_y^[TmS5R*DIXK9w|+T6![-Gb/hhVxE^|#tmLB}F9~{tco-e!');
define('AUTH_SALT',        'PB.=R& HM4|n]?*gB`O3Dd5Uc7nzUJm[! s>^rP?=9aw&f4|0|_}o{QZ{NCYr6B.');
define('SECURE_AUTH_SALT', 'G_!iYjo3=+i-W(I+0mgMtl#>8)m.gd-.SHbxCP|;>mMb@3>LA+YP64 K<|sHSk 9');
define('LOGGED_IN_SALT',   'mr4fV/=5WC5-Tc]mNfy{/B&E+h{l&mO*6-=(r3Q4)z:Ea#nB3rJ*v%7-@@|wGVs+');
define('NONCE_SALT',       'GpGJDp].eW8uF3)Vr[kIjjym&>YpkSE3|f28`@9|LG*?)[6J.%HJV+Voi([{!n,G');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
