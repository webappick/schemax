<?php

namespace Schemax\App\Mapping;


/**
 * Class AbstractMapping
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */


abstract class AbstractMapping implements MappingInterface
{
	protected $defaultMappings;

	public function __construct(array $defaultMappings)
	{
		$this->defaultMappings = $defaultMappings;
	}

	public function getMapping(string $schemaType): array
	{
		// Return default mappings or custom ones from the database
		return get_option("{$schemaType}_mappings", $this->defaultMappings);
	}

	public function setMapping(string $schemaType, array $mappingData): void
	{
		update_option("{$schemaType}_mappings", $mappingData);
	}
}
