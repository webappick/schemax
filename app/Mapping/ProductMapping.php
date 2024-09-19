<?php

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

class ProductMapping extends AbstractMapping
{
	protected array $defaultMappings;

	public function __construct()
	{
		// Retrieve default mappings from ProductSchema
		$productSchema = new ProductSchema();
		$this->defaultMappings = $productSchema->getDefaultMappings();

		// Call the parent constructor with the default mappings
		parent::__construct($this->defaultMappings);
	}

	/**
	 * Get the current mapping for the product schema.
	 * If no custom mappings exist, fall back to the default.
	 *
	 * @param string $schemaType
	 * @return array
	 */
	public function getMapping(string $schemaType): array
	{
		// Get the user-defined mapping from the database
		$customMapping = get_option('product_schema_mapping', []);

		// Merge user mapping with default mapping (user mappings override defaults)
		return array_merge($this->defaultMappings, $customMapping);
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param array $userMapping
	 */
	public function saveMapping(array $userMapping): void
	{
		// Save the user-defined mapping to the database
		update_option('product_schema_mapping', $userMapping);
	}
}
