<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
define('WP_HOME', 'http://contentsphere.webhop.me');
define('WP_SITEURL', 'http://contentsphere.webhop.me');

define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', '70$U0jVmoH' );

/** Database hostname */
define( 'DB_HOST', 'wordpress.ce5466gmm759.us-east-1.rds.amazonaws.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '|Ef%NC>iuE`yy<Ak&j6zO+*[!-`gDY/&lM0;S |1=1;(/le2bJ7I#[ mM0z-2cfm' );
define( 'SECURE_AUTH_KEY',  '=D^Wrv;,JG*BsfZe0Gv2BH06MtAm!O/24IQd-Q%<m8sl0*JMst>qN4X/-/e<Q0!I' );
define( 'LOGGED_IN_KEY',    'jysbquQWDyye#oz.pI1V]1)@FzS0(;IzP?~V=%/;!R*Um+XOmcXUFv9HC*Xq mW3' );
define( 'NONCE_KEY',        't{xjO6Y8kl?X[;^Rl ,9WW?oS1*)1] 4?9VEniK[_:a*9G]K?-+p.E*N>w$83@B8' );
define( 'AUTH_SALT',        '#VP55C<9*h9DVMR(3r]z#jge[_c@v>HP/O U,#8]2Y0+uv|s!FhtNaP6.OK_,mtK' );
define( 'SECURE_AUTH_SALT', '$LOly//(>w+OAj5<_a7DCBkViP.>oelr~FZ^LzB%ynm,]1rC$3W[z3w-C><%Amb ' );
define( 'LOGGED_IN_SALT',   'MLum@@$x13rCt!clvS!HD?%jw6[9pyKTg!ey|J4{iB/$zC]V1<48f3Re2Q~%DHGl' );
define( 'NONCE_SALT',       'ix%xe |V6Fa{kfd*YCO0bzg>:d&Ol|>c>8U<Q>&X08 HUKRzo]Lu47Hqv?bv+p?E' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

