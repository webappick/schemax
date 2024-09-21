<?php

namespace schemax\app\Data;

use Schemax\App\Data\DataAbstract;
use WC_Product;

class OffersData extends DataAbstract
{
	/**
	 * Get the data for the given object type.
	 *
	 * @param array  $mapping The mapping for the object.
	 * @param object $object  The ID or Object for the entity.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData(array $mapping, object $object): array
	{
		// Validate the id or object first.
		if (! $object instanceof WC_Product) {
			return [];
		}

		$product = $object;

		// Prepare the data for the given object
		$productData = $this->prepareData($mapping, $product);

		return apply_filters('schemax_offers_data', $productData, $product);
	}

	/**
	 * Get the keys for the product data.
	 *
	 * @return array The keys for the product data.
	 */
	public function dataKeys(): array
	{
		$productDataKeys = array( // List of keys for the product and their names for dropdowns, etc.
			'product_id'          => __('Product ID', 'schemax'),
			'product_name'        => __('Product Name', 'schemax'),
			'product_description' => __('Product Description', 'schemax'),
			'product_sku'         => __('Product SKU', 'schemax'),
		);

		return apply_filters('schemax_product_data_key', $productDataKeys);
	}

	/**
	 * Get the offer low price.
	 *
	 * @param WC_Product|\WC_Product_Variable $product The product object.
	 *
	 * @return string The product id.
	 */
	public function get_offers_low_price(WC_Product $product): string
	{
		if($product->is_type('variable')) {
			return $product->get_variation_price('min', true);
		}
		return $product->get_price();
	}

	/**
	 * Get the offer high price.
	 *
	 * @param WC_Product|\WC_Product_Variable $product The product object.
	 *
	 * @return string The product id.
	 */
	public function get_offers_high_price(WC_Product $product): string
	{
		if($product->is_type('variable')) {
			return $product->get_variation_price('max', true);
		}
		return $product->get_price();
	}

	/**
	 * Get the offer count.
	 *
	 * @param WC_Product|\WC_Product_Variable $product The product object.
	 *
	 * @return string The product id.
	 */
	public function get_offers_count(WC_Product $product): string
	{
		if($product->is_type('variable')) {
			return count($product->get_children());
		}
		return 1;
	}
}
