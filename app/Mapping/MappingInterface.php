<?php

namespace Schemax\App\Mapping;


/**
 * Class MappingInterface
 *
 * @package    Schemax\App\Mapping
 * @subpackage Schemax\App\Mapping
 */
interface MappingInterface
{
	public function getMapping(string $schemaType): array;
	public function setMapping(string $schemaType, array $mappingData): void;
}
