<?php

namespace WebAppick\WPListInfo\Middleware\Schema;


/**
 * Class AbstractSchema
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Schema;

abstract class AbstractSchema implements SchemaInterface
{
	protected $schemaType;
	
	public function getSchemaType(): string
	{
		return $this->schemaType;
	}
	
	// Default implementation for generating schema, can be overridden in specific schema classes
	public function generateSchema(array $data): array
	{
		$schema = [];
		$mappings = $this->getDefaultMappings();
		
		foreach ($mappings as $property => $mapping) {
			$schema[$property] = $data[$mapping['mapping']] ?? null;
		}
		
		return $schema;
	}
}
