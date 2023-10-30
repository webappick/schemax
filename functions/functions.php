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

/**
 * Get the settings of the plugin in a filterable way
 *
 * @since 1.0.0
 * @return array
 */
function s_get_settings() {
	return apply_filters( 's_get_settings', get_option( SMAX_TEXTDOMAIN . '-settings' ) );
}
