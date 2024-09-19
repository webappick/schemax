<?php

namespace MyPlugin\Schema;

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
}
