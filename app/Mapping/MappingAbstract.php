<?php
/**
 * AbstractMapping
 *
 * This class is responsible for managing the mapping of the schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

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
abstract class MappingAbstract implements MappingInterface {

	/**
	 * @var array $default_mappings Default mappings for the schema.
	 */
	protected $default_mappings;

	public function __construct( array $default_mappings ) {
		$this->default_mappings = $default_mappings;
	}

	public function getMapping( string $schema_type ): array {
		// Return default mappings or custom ones from the database
		return get_option( "schemax_{$schema_type}_mappings", $this->default_mappings );
	}

	public function setMapping( string $schema_type, array $mappingData ): bool {
		return update_option( "schemax_{$schema_type}_mappings", $mappingData );
	}

}
