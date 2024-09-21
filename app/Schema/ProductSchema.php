<?php

namespace Schemax\App\Schema;

class ProductSchema extends AbstractSchema {
	protected $schemaType = 'Product';

	public function getDefaultMappings(): array {
		return [
			'name'        => [ 'mapping' => 'product_name' ],
			'description' => [ 'mapping' => 'product_description' ],
			'sku'         => [ 'mapping' => 'product_sku' ],
			'offers'      => ['mapping'   => 'product_offers'],
		];
	}

	/**
	 * Get schema property configurations (optional).
	 * This can include labels, descriptions, required properties, etc.
	 *
	 * @return array The configuration data for the Product schema properties.
	 */
	public static function getPropertyConfigurations(): array {
		return [
			'name'        => [
				'label'       => 'Product Name',
				'description' => 'The name of the product.',
				'required'    => true
			],
			'description' => [
				'label'       => 'Product Description',
				'description' => 'A detailed description of the product.',
				'required'    => true
			],
			'sku'         => [
				'label'       => 'Product SKU',
				'description' => 'The unique identifier for the product.',
				'required'    => false
			],
			'offers'      => [
				'label'       => 'Offers',
				'description' => 'The price and currency of the product.',
				'required'    => true
			],
			// Add more configurations as needed
		];
	}
}
