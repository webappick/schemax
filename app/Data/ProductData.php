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
	 * @param array  $mapping The mapping for the object.
	 * @param object $object  The ID or Object for the entity.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData( array $mapping, object $object ): array {
		// Validate the id or object first.
		if ( ! $object instanceof WC_Product ) {
			return [];
		}

		$product = $object;

		// Prepare the data for the given object
		$productData = $this->prepareData( $mapping, $product );

		return apply_filters( 'schemax_product_data', $productData, $product );
	}

	/**
	 * Get the keys for the product data.
	 *
	 * @return array The keys for the product data.
	 */
	public function dataKeys(): array {
		$productDataKeys = array( // List of keys for the product and their names for dropdowns, etc.
			'product_id'          => __( 'Product ID', 'schemax' ),
			'product_name'        => __( 'Product Name', 'schemax' ),
			'product_description' => __( 'Product Description', 'schemax' ),
			'product_sku'         => __( 'Product SKU', 'schemax' ),
		);

		return apply_filters( 'schemax_product_data_key', $productDataKeys );
	}

	/**
	 * Get the product offers.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product id.
	 */
	public function get_product_offers( WC_Product $product): string {

	}

	/**
	 * Get the product id.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product id.
	 */
	public function get_product_id( WC_Product $product): string {
		return $product->get_id();
	}

	/**
	 * Get the product name.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product name.
	 */
	public function get_product_name( WC_Product $product): string {
		return $product->get_name();
	}

	/**
	 * Get the product description.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product description.
	 */
	public function get_product_description( WC_Product $product): string {
		return $product->get_description();
	}

	/**
	 * Get the product SKU.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product SKU.
	 */
	public function get_product_sku( WC_Product $product): string {
		return $product->get_sku();
	}

	/**
	 * Get the product stock status.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product price.
	 */
	public function get_product_stock_status( WC_Product $product): string {
		$stock_status = $product->get_stock_status();

		// If stock management is disabled, the product is always in stock.
		if(!$product->get_manage_stock() ) {
			return 'https://schema.org/InStock';
		}

		// If low stock amount is set and the product is below that amount, it is a limited availability.
		if( (int)$product->get_low_stock_amount() > $product->get_stock_quantity() ) {
			return 'https://schema.org/LimitedAvailability';
		}

		// If stock status is instock, the product is in stock.
		if ( $stock_status === 'instock' ) {
			return 'https://schema.org/InStock';
		}

		// If stock status is on preorder, the product is on PreOrder.
		if ( $stock_status === 'onpreorder' ) {
			return 'https://schema.org/PreOrder';
		}

		// If stock status is onbackorder, the product is on backorder.
		if( $stock_status === 'onbackorder' ) {
			return 'https://schema.org/BackOrder';
		}

		// If stock status is outofstock, the product is out of stock.
		if ( $stock_status === 'outofstock' ) {
			return 'https://schema.org/OutOfStock';
		}

		return 'https://schema.org/Discontinued';

	}

	/**
	 * Get the product condition.
	 *
	 * @param WC_Product $product The product object.
	 *
	 * @return string The product condition.
	 */
	public function get_product_condition( WC_Product $product): string {
		// TODO: Implement get_product_condition() method.
		return 'https://schema.org/NewCondition';
	}
}
