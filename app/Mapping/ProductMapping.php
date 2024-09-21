<?php
/**
 * ProductMapping
 *
 * This class is responsible for managing the mapping of the product schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

use Schemax\App\Schema\ProductSchema;

/**
 * Class ProductMapping
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class ProductMapping extends MappingAbstract {

	/**
	 * @var array $default_mappings Default mappings for the schema.
	 */
	protected $default_mappings;

	public function __construct() {
		// Retrieve default mappings from ProductSchema
		$productSchema          = new ProductSchema;
		$this->default_mappings = $productSchema->getDefaultMappings();

		// Call the parent constructor with the default mappings
		parent::__construct( $this->default_mappings );
	}

	/**
	 * Get the current mapping for the product schema.
	 * If no custom mappings exist, fall back to the default.
	 *
	 * @param int    $id          The ID of the product to get the mapping for.
	 * @return array The current mapping for the product schema.
	 */
	public function getMapping( $id = null ): array { //phpcs:ignore

		// If an ID is provided, get the mapping for that specific product meta
		if ( $id ) {
			$customMapping = get_post_meta( $id, 'schemax_product_schema_mapping', true );

			return $customMapping ?: $this->default_mappings;
		}

		// Get the user-defined mapping from the database
		$customMapping = get_option( 'schemax_product_schema_mapping', array() );

		// Merge user mapping with default mapping (user mappings override defaults)
		return array_merge( $this->default_mappings, $customMapping );
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param array $userMapping The user-defined mapping to save.
	 */
	public function setMapping( array $userMapping, $id = null ): bool {
		// If an ID is provided, save the mapping to the post meta
		if ( $id ) {
			return update_post_meta( $id, 'schemax_product_schema_mapping', $userMapping );
		}

		// Save the user-defined mapping to the database
		return update_option( 'schemax_product_schema_mapping', $userMapping );
	}

}
