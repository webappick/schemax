<?php

namespace WebAppick\WPListInfo\Middleware\Services;


/**
 * Class SchemaGenerationService
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Services
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Services;

use MyPlugin\Schema\SchemaInterface;

class SchemaGenerationService
{
	public function generateSchema(SchemaInterface $schemaClass, array $data): array
	{
		return $schemaClass->generateSchema($data);
	}
}
