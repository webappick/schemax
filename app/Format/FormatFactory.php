<?php

namespace WebAppick\WPListInfo\Factories;

use WebAppick\WPListInfo\Formatters\CountryFormat;
use WebAppick\WPListInfo\Formatters\PostFormat;
use WebAppick\WPListInfo\Strategies\FormatStrategy;

/**
 * Class FormatFactory
 *
 * @package WPListInfo
 * @subpackage WebAppick\WPListInfo\Factories
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Library
 */
class FormatFactory {

	/**
	 * @throws \Exception
	 */
	public static function format( $source, $data, $format, $output ) {
		$class = 'WebAppick\WPListInfo\Format\\' . ucfirst( strtolower($source) ) . 'Format';
		
		if ( ! class_exists( $class ) ) {
			throw new \RuntimeException( "Invalid source provided. Formatting source ". $class ." does not exist." );
		}
		
		return (new FormatStrategy( new $class ))->format( $data, $format, $output );
	}

}
