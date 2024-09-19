<?php

namespace Schemax\App\Mapping;


/**
 * Class MappingFactory
 *
 * @package    CTXFeed
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
class MappingFactory {
	/**
	 * Get the mapping for the given object type.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 *
	 * @return array The mapping for the object.
	 */
	public static function getMapping( string $objectType): array {
		switch ($objectType) {
			case 'Product':
				return ( new MappingManager() )->getMapping( 'Product' );

			case 'Post':
				return ( new MappingManager() )->getMapping( 'Post' );

			default:
				return [];
		}
	}

}
