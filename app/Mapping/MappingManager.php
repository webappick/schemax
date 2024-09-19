<?php
/**
 * MappingManager
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

/**
 * Class MappingManager
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */


class MappingManager {

	/**
	 * @var array $mappings The registered mappings.
	 */
	protected $mappings = array();

	/**
	 * Register a mapping class for a specific schema type.
	 *
	 * @param string                                $schema_type The schema type to register the mapping for.
	 * @param \Schemax\App\Mapping\MappingInterface $mappingClass The mapping class to register.
	 */
	public function registerMapping( string $schema_type, MappingInterface $mappingClass ): void {
		$this->mappings[$schema_type] = $mappingClass;
	}

	/**
	 * Retrieve the mapping for a specific schema type.
	 * Falls back to the default mapping if no custom mapping is set.
	 */
	public function getMapping( string $schema_type ): array {
		if ( !isset( $this->mappings[$schema_type] ) ) {
			throw new \RuntimeException( 'No mapping registered for schema type: ' . $schema_type );
		}

		return $this->mappings[$schema_type]->getMapping( $schema_type );
	}

	/**
	 * Save a new mapping for a specific schema type.
	 */
	public function saveMapping( string $schema_type, array $mappingData ): void {
		if ( !isset( $this->mappings[$schema_type] ) ) {
			throw new \RuntimeException( 'No mapping registered for schema type: ' . $schema_type );
		}

		$this->mappings[$schema_type]->setMapping( $schema_type, $mappingData );
	}

	/**
     * Reset the mapping for a specific schema type to the default mapping.
     *
     * @throws \RuntimeException
     */
	public function resetMappingToDefault( string $schema_type ): void {
		if ( !isset( $this->mappings[$schema_type] ) ) {
			throw new \RuntimeException( 'No mapping registered for schema type: ' . $schema_type );
		}

		// Reset the mapping to its default state
		$defaultMapping = $this->mappings[$schema_type]->getDefaultMappings();
		$this->mappings[$schema_type]->setMapping( $schema_type, $defaultMapping );
	}

}
