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
define('DB_NAME', 'pwug');
/** MySQL database username */
define('DB_USER', 'kollin');
/** MySQL database password */
define('DB_PASSWORD', 'ultimate012');
/** MySQL hostname */
define('DB_HOST', 'localhost');
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
define('AUTH_KEY',         ';mHK%+#,8L|+@Y?yeXQzyWMzCq_iK@:erB!=8cD/nZS%OI@A)+k|e#0)8Xt#..uj');
define('SECURE_AUTH_KEY',  '.WKM{6J@$oRnEF}deB:T`9st dL?9e+>::|<A-k31njP=$u3+g]w0s1sX|zpPO(#');
define('LOGGED_IN_KEY',    'i-^NtpTHY#_Z|ulL+!K4QpTC3+zeH,H5)`MsfprGT^<<F,T=]Ty~+7&D!gP$fW G');
define('NONCE_KEY',        'z;nEz3%!?@I|vZo}2s$v&@(E>]tY zi18nmH3{o?N|ch%q_e!#jr3$j|Z&L,iupX');
define('AUTH_SALT',        'XU7=o?3Pcw,[j{QAS7TV:[_Ix/]vz$vv;[n5_{TT6Z<uqBwx;Gc}5-@~-&-XMF6A');
define('SECURE_AUTH_SALT', 'e!l,Xb^@-6G?x}@=nhB0jW~%cx^r]=(sJw`[FWj,#X+~bFdV||Q,gOtzIul!#C;3');
define('LOGGED_IN_SALT',   '.4w.Ck,n#OT(JCm)YMKpdJB?Ue1+^bwI0cBc/!yNjj_H~hw43.$Kg1m:/WeT.f2M');
define('NONCE_SALT',       '`>+$~#x4=awHx(CuUWs17hB+c_EBW6@B[8L5Add$J7p_RRz2:xF(DG8*Rt~UTuKY');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pwun_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
error_reporting(0);