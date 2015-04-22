<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'swebdemo_survey');

/** MySQL database username */
define('DB_USER', 'swebdemo_survey');

/** MySQL database password */
define('DB_PASSWORD', 'admin');

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
define('AUTH_KEY',         'O]HyQh/;zk%OD){d`%{I7XJ,snS?nI4C6.N2cEaoqRkfRIlW+BN%%`j,I|)qe+#k');
define('SECURE_AUTH_KEY',  '9AT%L9g+W1->q;{Euih!m<O2ofjkB_#?=g+R`E(-YjIn,-1!;+wdujc1+dv,+-ck');
define('LOGGED_IN_KEY',    '*|1GR5#GJy#p|,:O_KsKkAy#!U-DtIOa-$f]_p*SW?zc8>ZA.$IMhSP?ud[EPv:~');
define('NONCE_KEY',        '+WFwsj{N{mN. UJBwP`|~H>f%@PT <CpM&sa-M6@[P5>mz)cclg?|O>0JUK:r$lo');
define('AUTH_SALT',        ';F,~w4<=x/31 (*QK=$Ge+& *BK+jad`CcSLj2q2]3`=pkBn3wLWl^nlUU/B_jgX');
define('SECURE_AUTH_SALT', 'eGQK&^+8%>4Ug+84;%p2us I|z@sf|rI?ng.x;$<F/qU(LpD41~c!WAa+d,=xP{;');
define('LOGGED_IN_SALT',   '&RcyIFN(a-]Zv+Av~6Wa:|Ghj~GP-Pw|H+,SL<B%tl#tHSa@?qGt2_7[$9_zl~d@');
define('NONCE_SALT',       '[SGe[|_]H7-vB0a)<bY-B(-H5of$+X,;%#nBs C#+X.&_G{,GkJO4fDPKCSC`(LC');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
?>
