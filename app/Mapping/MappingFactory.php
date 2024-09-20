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

	private string $objectType;

	private $mappingManager;

	/**
	 * MappingFactory constructor.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 */
	public function __construct(string $objectType)
	{
		$this->objectType = $objectType;
		$this->mappingManager = $this->registerMapping();
	}

	private function registerMapping()
	{
		switch ( $this->objectType ) {
			case 'Product':
				$productMapping = new ProductMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( $this->objectType, $productMapping );

				return $mappingManager;

			case 'Article':
				$articleMapping = new ArticleMapping();
				$mappingManager = new MappingManager();
				$mappingManager->registerMapping( 'Article', $articleMapping );

				return $mappingManager;

			default:
				return [];
		}
	}

	/**
	 * Get the mapping for the given object type.
	 *
	 * @return array The mapping for the object.
	 * @throws \Exception
	 */
	public function getMapping(): array {
		return $this->mappingManager->getMapping( $this->objectType );
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param array $userMapping The user-defined mapping to save.
	 * @throws NonNullToVoid
	 */
	public function saveMapping( array $userMapping ): void {
		$this->mappingManager->saveMapping( $this->objectType, $userMapping );
	}

	/**
	 * Reset the mapping for the given object type to the default mapping.
	 * @throws NonNullToVoid
	 */
	public function resetMappingToDefault(): void {
		$this->mappingManager->resetMappingToDefault( $this->objectType );
	}

}
