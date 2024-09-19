<?php

namespace Schemax\App\Schema;
/**
 * Class AbstractSchema
 *
 * @package    Schemax
 * @subpackage Schemax\App\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */

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
