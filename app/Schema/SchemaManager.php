<?php

namespace Schemax\App\Schema;


/**
 * Class SchemaManager
 *
 * @package    Schemax
 * @subpackage Schemax\App\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */

class SchemaManager
{
	protected $schemas = [];

	public function registerSchema(SchemaInterface $schema)
	{
		$this->schemas[$schema->getSchemaType()] = $schema;
	}

	public function getSchema(string $schemaType): ?SchemaInterface
	{
		return $this->schemas[$schemaType] ?? null;
	}
}
