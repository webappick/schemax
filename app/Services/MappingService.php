<?php

namespace WebAppick\WPListInfo\Middleware\Services;


/**
 * Class MappingService
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Services
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Services;

use MyPlugin\Mapping\MappingInterface;

class MappingService
{
	public function getSchemaMappings(MappingInterface $mappingClass, string $schemaType): array
	{
		return $mappingClass->getMapping($schemaType);
	}
	
	public function saveSchemaMappings(MappingInterface $mappingClass, string $schemaType, array $mappings): void
	{
		$mappingClass->setMapping($schemaType, $mappings);
	}
}
