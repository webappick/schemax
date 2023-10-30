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

namespace Schemax\Internals;

use DecodeLabs\Tagged as Html;
use Schemax\Engine\Base;

/**
 * Shortcodes of this plugin
 */
class Shortcode extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		\add_shortcode( 'foobar', array( $this, 'foobar_func' ) );
	}

	/**
	 * Shortcode example
	 *
	 * @param array $atts Parameters.
	 * @since 1.0.0
	 * @return string
	 */
	public static function foobar_func( array $atts ) {
		\shortcode_atts( array( 'foo' => 'something', 'bar' => 'something else' ), $atts );

		return Html::{'span.foo'}( 'foo = ' . $atts['foo'] ) . Html::{'span.bar'}( 'bar = ' . $atts['bar'] );
	}

}
