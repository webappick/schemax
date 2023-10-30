<?php
/**
 * Schemax
 *
 * @package   Schemax
 * @author    Ohidul Islam <wahid0003@gmail.com>
 * @copyright 2023 WebAppick
 * @license   GPL 2.0+
 * @link      https://webappick.com
 */

$s_debug = new WPBP_Debug( __( 'Schemax', SMAX_TEXTDOMAIN ) );

/**
 * Log text inside the debugging plugins.
 *
 * @param string $text The text.
 * @return void
 */
function s_log( string $text ) {
	global $s_debug;
	$s_debug->log( $text );
}
