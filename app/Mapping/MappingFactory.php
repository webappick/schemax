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
	 * @throws \Patchwork\Exceptions\NonNullToVoid
	 */
	private function registerMapping($objectType) {
		switch ( $objectType ) {
			case 'product':
				$productMapping = new ProductMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( $objectType, $productMapping );

				return $mappingManager;

			case 'article':
				$articleMapping = new ArticleMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( $objectType, $articleMapping );

				return $mappingManager;

			default:
				return [];
		}
	}

	/**
	 * Get the mapping for the given object type.
	 *
	 * @param null $id Get mapping for a specific object.
	 *
	 * @return array The mapping for the object.
	 * @throws \Exception
	 */
	public function getMapping( $objectType, $id = null ): array {
		$mappingManager = $this->registerMapping( $objectType );
		return $mappingManager->getMapping( $objectType, $id );
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param null  $id          Save mapping for a specific object.
	 * @param array $userMapping The user-defined mapping to save.
	 *
	 * @throws NonNullToVoid
	 */
	public function saveMapping( array $userMapping, $id = null ): void {
		$this->mappingManager->saveMapping( $this->objectType, $userMapping, $id );
	}

	/**
	 * Reset the mapping for the given object type to the default mapping.
	 *
	 * @param null $id Reset mapping for a specific object.
	 */
	public function resetMappingToDefault( $id = null ): void {
		$this->mappingManager->resetMappingToDefault( $this->objectType, $id );
	}

}
