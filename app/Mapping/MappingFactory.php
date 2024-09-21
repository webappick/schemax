<?php
/**
 * Factory for creating mapping objects.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

use Patchwork\Exceptions\NonNullToVoid;

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
	 * Get the mapping for the specified object type.
	 *
	 * @param string $objectType The type of object to get the mapping for.
	 * @param null   $id         The ID of the object to get the mapping for.
	 *
	 * @return array The mapping for the specified object type.
	 */
	public static function get( string $objectType, $id = null ): array {
		$class = self::mappingHandler($objectType);
		return (new $class())->getMapping($id);
	}

	/**
	 * Save the mapping for the specified object type.
	 *
	 * @param string $objectType The type of object to save the mapping for.
	 * @param array  $userMapping The mapping data to save.
	 * @param null   $id         The ID of the object to save the mapping for.
	 *
	 * @return bool True if the mapping was saved successfully, false otherwise.
	 */
	public static function save(string $objectType,array $userMapping, $id = null ): bool {
		$class = self::mappingHandler($objectType);
		return (new $class())->setMapping($userMapping, $id);
	}

	/**
	 * Reset the mapping for the specified object type.
	 *
	 * @param string $objectType The type of object to reset the mapping for.
	 * @param null   $id         The ID of the object to reset the mapping for.
	 *
	 * @return bool True if the mapping was reset successfully, false otherwise.
	 */
	public static function reset(string $objectType, $id = null ): bool {
		$class = self::mappingHandler( $objectType );
		return ( new $class() )->resetMappingToDefault( $id );
	}

	/**
	 * Load the mapping class for the specified object type.
	 *
	 * @param string $objectType The type of object to load the mapping class for.
	 *
	 * @return object The mapping class for the specified object type.
	 */
	protected static function mappingHandler(string $objectType): object {
		$mappingClass = __NAMESPACE__ . '\\' . ucfirst($objectType) . 'Mapping';

		if (!class_exists($mappingClass)) {
			throw new \RuntimeException("No mapping class found for schema type: " . $objectType);
		}

		return new $mappingClass();
	}
}
