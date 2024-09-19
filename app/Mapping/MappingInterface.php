<?php

namespace WebAppick\WPListInfo\Middleware\Mapping;


/**
 * Class MappingInterface
 *
 * @package    WebAppick\WPListInfo\Middleware\Mapping
 * @subpackage WebAppick\WPListInfo\Middleware\Mapping
 */
namespace MyPlugin\Mapping;

interface MappingInterface
{
	public function getMapping(string $schemaType): array;
	public function setMapping(string $schemaType, array $mappingData): void;
}
