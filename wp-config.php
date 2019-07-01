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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D~Mr+3yO7}9FQ5Cz=qEb2iSshL.*qHQ00oen0M/c&rXMFh&~`#7*M{v1fBPR$9p;' );
define( 'SECURE_AUTH_KEY',  'pq}+^%qo!5r+,`7Z9qa}mKBX[!b484Lv7Z4SV?$SxiwGyaj?:zN[7zEs~pnzB#[4' );
define( 'LOGGED_IN_KEY',    'z*iI$K.}}%1z~w,aiX|Ui9vmwqctYA9y-(*ZBnEYmh[foHmtsY*UnL5][,TuY^T6' );
define( 'NONCE_KEY',        '203qa~7@$Z;$Ve 6K=jYp[Mx8t7!0sS{X2Cqt`QbV,=3#N7>.AltVvm)Z)+lEP^D' );
define( 'AUTH_SALT',        'J]NgJ8Qs>38HN*1h:m<4(A~6Jh]PUMZ@JCrqnR=Qrrc?~+b|G&~, g~kN}+8.hN[' );
define( 'SECURE_AUTH_SALT', 'o|@.:/|dr]nvd>2VxY~)6gaV`HVllRQ]__KVcn>>E_hX,.uv@T2z_7+iFu8/Zh+a' );
define( 'LOGGED_IN_SALT',   ';,rL-yfTOU{lb;!#F?KqmQlW.ru6JyrAB#O&nPUz kj0qqfA*2v<U]A4xY1?hjD}' );
define( 'NONCE_SALT',       ']1M.eP.k!=a;m%^$sFn2,JFB)xb[Wb$zcVX#IEHd@3^hTt{ TAabc7z/`NP.QkIx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
