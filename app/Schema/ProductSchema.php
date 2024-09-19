<?php

namespace Schemax\App\Schema;

class ProductSchema extends AbstractSchema
{
	protected $schemaType = 'Product';

	public function getDefaultMappings(): array
	{
		return [
			'name' => ['label' => 'Product Name', 'mapping' => 'product_name'],
			'description' => ['label' => 'Product Description', 'mapping' => 'product_description'],
			'sku' => ['label' => 'Product SKU', 'mapping' => 'product_sku'],
			'offers' => [
				'label' => 'Offers',
				'multiple' => true,
				'instances' => [
					'price' => ['label' => 'Offer Price', 'mapping' => 'offer_price'],
					'priceCurrency' => ['label' => 'Price Currency', 'mapping' => 'offer_currency'],
				]
			],
		];
	}

	/**
	 * Get schema property configurations (optional).
	 * This can include labels, descriptions, required properties, etc.
	 *
	 * @return array The configuration data for the Product schema properties.
	 */
	public static function getPropertyConfigurations(): array
	{
		return [
			'name' => [
				'label' => 'Product Name',
				'description' => 'The name of the product.',
				'required' => true
			],
			'description' => [
				'label' => 'Product Description',
				'description' => 'A detailed description of the product.',
				'required' => true
			],
			'sku' => [
				'label' => 'Product SKU',
				'description' => 'The unique identifier for the product.',
				'required' => false
			],
			// Add more configurations as needed
		];
	}
}
