<?php

namespace Schemax\App\Schema;

class ProductSchema extends AbstractSchema {
	protected $schemaType = 'Product';

	public function getDefaultMappings(): array {
		return [
			'name'        => [ 'mapping' => 'product_name' ],
			'description' => [ 'mapping' => 'product_description' ],
			'sku'         => [ 'mapping' => 'product_sku' ],
			'offers'      => [
				'mapping'       => 'product_offers',
				'lowPrice'      => [ 'mapping' => 'offer_low_price', 'required' => true,'data_type'=>'number' ],
				'highPrice'     => [ 'mapping' => 'offer_high_price', 'required' => true,'data_type'=>'number' ],
				'offerCount'    => [ 'mapping' => 'offer_count' ],
				'availability'  => 'product_stock_status',     // Availability status
				'itemCondition' => 'product_condition',        // Item condition
				'instances'     => [
					'Offer' => [
						'mapping'               => 'offer_variations',
						'@type'                 => 'Offer',
						'price'                 => [ 'mapping' => 'offer_price' ],
						'priceCurrency'         => [ 'mapping' => 'offer_currency' ],
						'acceptedPaymentMethod' => [ 'mapping' => 'offer_payment_methods' ],
						'availability'          => 'product_stock_status',
						'itemCondition'         => 'product_condition',
						'addOn'                 => [ 'mapping' => 'offer_add_ons' ],
						'additionalProperty'    => [
							'mapping'   => 'offer_additional_properties',
							'instances' => [
								[
									'@type'      => 'PropertyValue',
									'propertyID' => [ 'mapping' => 'offer_additional_property_id' ],
									'value'      => [ 'mapping' => 'offer_additional_property_value' ],
								]
							],
							'seller'    => [
								'mapping' => 'offer_seller',
								'@type'   => 'Organization',
								'name'    => [ 'mapping' => 'offer_seller_name' ],
								'url'     => [ 'mapping' => 'offer_seller_url' ],
							],
						]
					]
				],
			]
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
