<?php

namespace Schemax\App\Services;

use Schemax\App\Mapping\MappingInterface;

/**
 * Class MappingService
 *
 * @package    Schemax
 * @subpackage Schemax\App\Services
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */

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
