<?php
/**
 * Product Info Service
 *
 * This file contains the ProductService class.
 *
 * @package    Schemax;
 * @subpackage WebAppick\WPListInfo\Services
 */

namespace Schemax\App\Data;


use WC_Product;

/**
 * Class ProductService
 *
 * @package    Schemax;
 * @subpackage WebAppick\WPListInfo\Services
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class ProductData extends DataAbstract {



	/**
	 * Get the data for the given object type.
	 *
	 * @param object $object The ID or Object for the entity.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData( object $object ): array {
		// Validate the id or object first.
		if (! $object instanceof WC_Product) {
			return [];
		}

		$product = $object;

		// If the product type is variation, get the parent product
		$parent = $product;
		if ($product->is_type('variation')) {
			$parent = wc_get_product($product->get_parent_id());
		}

		$productInfo = array(
			'product_id'                 => $product->get_id(),
			'product_name'               => $product->get_name(),
			'product_sku'                => $product->get_sku(),
			'product_offers'             => $this->getOffers($product), // Get the offer data
		);

		return apply_filters( 'schemax_product_data', $productInfo, $product );
	}

	/**
	 * Get the keys for the product data.
	 *
	 * @return array The keys for the product data.
	 */
	public function dataKeys(): array {
		$productDataKeys = array( // List of keys for the product and their names for dropdowns, etc.
			'product_id'                 => __( 'Product ID', 'schemax' ),
			'product_name'               => __( 'Product Name', 'schemax' ),
			'product_sku'                => __( 'Product SKU', 'schemax' ),
			'product_offers'             => __( 'Product Offers', 'schemax' ),
		);

		return apply_filters( 'schemax_product_data_key', $productDataKeys );
	}

	private function product_id()
	{

	}
}
