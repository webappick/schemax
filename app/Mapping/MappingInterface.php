<?php
/**
 * MappingInterface
 *
 * This class is responsible for managing the mapping of the schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

/**
 * Class MappingInterface
 *
 * @package    Schemax\App\Mapping
 * @subpackage Schemax\App\Mapping
 */
interface MappingInterface { //phpcs:ignore

	public function getMapping($id=null): array;// phpcs:ignore

	public function setMapping(array $userMapping, $id=null): bool;// phpcs:ignore

}
