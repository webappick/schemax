<?php

namespace WebAppick\WPListInfo\Middleware\Mapping;


/**
 * Class MappingManager
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Mapping;

class MappingManager
{
	protected $mappings = [];
	
	/**
	 * Register a mapping class for a specific schema type.
	 *
	 * @param string $schemaType
	 * @param MappingInterface $mappingClass
	 */
	public function registerMapping(string $schemaType, MappingInterface $mappingClass)
	{
		$this->mappings[$schemaType] = $mappingClass;
	}
	
	/**
	 * Retrieve the mapping for a specific schema type.
	 * Falls back to the default mapping if no custom mapping is set.
	 *
	 * @param string $schemaType
	 * @return array
	 */
	public function getMapping(string $schemaType): array
	{
		if (!isset($this->mappings[$schemaType])) {
			throw new \Exception("No mapping registered for schema type: " . $schemaType);
		}
		
		return $this->mappings[$schemaType]->getMapping($schemaType);
	}
	
	/**
	 * Save a new mapping for a specific schema type.
	 *
	 * @param string $schemaType
	 * @param array $mappingData
	 */
	public function saveMapping(string $schemaType, array $mappingData): void
	{
		if (!isset($this->mappings[$schemaType])) {
			throw new \Exception("No mapping registered for schema type: " . $schemaType);
		}
		
		$this->mappings[$schemaType]->setMapping($schemaType, $mappingData);
	}
	
	/**
	 * Reset the mapping for a specific schema type to the default mapping.
	 *
	 * @param string $schemaType
	 */
	public function resetMappingToDefault(string $schemaType): void
	{
		if (!isset($this->mappings[$schemaType])) {
			throw new \Exception("No mapping registered for schema type: " . $schemaType);
		}
		
		// Reset the mapping to its default state
		$defaultMapping = $this->mappings[$schemaType]->getDefaultMappings();
		$this->mappings[$schemaType]->setMapping($schemaType, $defaultMapping);
	}
}
