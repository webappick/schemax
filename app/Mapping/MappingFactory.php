<?php
/**
 * Factory for creating mapping objects.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

/**
 * Class MappingFactory
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class MappingFactory {
	/**
	 * Get the mapping for the given object type.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 *
	 * @return array The mapping for the object.
	 * @throws \Patchwork\Exceptions\NonNullToVoid
	 */
	public static function getMapping( string $objectType ): array {
		switch ( $objectType ) {
			case 'Product':
				$productMapping = new ProductMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( 'Product', $productMapping );

				return $mappingManager->getMapping( 'Product' );

			case 'Article':
				$articleMapping = new ArticleMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( 'Article', $articleMapping );

				return $mappingManager->getMapping( 'Article' );

			default:
				return [];
		}
	}

}
