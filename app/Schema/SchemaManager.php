<?php

namespace WebAppick\WPListInfo\Middleware\Schema;


/**
 * Class SchemaManager
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Schema;

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
