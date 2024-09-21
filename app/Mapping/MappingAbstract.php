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

	abstract public function getMapping( $id = null ): array;// phpcs:ignore

	abstract public function setMapping( array $userMapping, $id = null ): bool;// phpcs:ignore

}
