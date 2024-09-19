<?php
/**
 * Product Info Service
 *
 * This file contains the ProductService class.
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 */

namespace Schemax\App\Data;

use WC_Product_Query;
use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class ProductService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Library
 */
class ProductData extends AbstractData implements DataInterface {

	/**
	 * Get a list of WooCommerce products based on provided arguments.
	 *
	 * @param array $args Optional arguments for querying products.
	 *                    Example: [
	 *                        'limit' => 20,
	 *                        'orderby'=> 'date',
	 *                        'order' => 'DESC',
	 *                        'status'=> 'publish'
	 *                    ].
	 * @return array List of products, formatted if necessary.
	 */
	public function getList( $args = array() ) {
		// Define default arguments
		$defaults = array(
			'limit'   => 20,            // Fetch all products by default
			'orderby' => 'date',        // Order by date by default
			'order'   => 'DESC',        // Order in descending order by default
			'status'  => 'publish',     // Only fetch published products by default
		);

		// Merge provided arguments with the defaults
		$queryArgs = wp_parse_args( $args, $defaults );

		// Use WC_Product_Query with the merged arguments
		$query = new WC_Product_Query( $queryArgs );

		// Get the list of products
		$products = $query->get_products();

		// Check if products are found and return formatted output if needed
		if ( ! empty( $products ) ) {
			return $products;
		}

		// Return an empty array if no products are found
		return array();
	}

	/**
	 * Retrieve information about a specific product.
	 *
	 * @param string|null $key The key for the product.
	 * @param int|object  $idObject The ID or Object for the product.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the product.
	 */
	public function getInfo( $key, $idObject ) { // phpcs:ignore

		// Validate the id or object first.
		if ( !$this->validate( $idObject ) ) {
			return null;
		}

        $product = $this->getObject( $idObject, 'product' );

		if ( ! $product ) {
			return null;
		}

		// If the product type is variation, get the parent product
		$parent = $this->getParentObject( $product, 'product' );

		$productInfo = array(
			'product_id'                 => $product->get_id(),
			'product_parent_id'          => $product->get_parent_id(),
			'product_name'               => $product->get_name(),
			'product_sku'                => $product->get_sku(),
			'product_parent_sku'         => $product->is_type( 'variation' ) ? $parent->get_sku() : null,
			'product_url'                => $product->get_permalink(),
			'product_parent_url'         => $product->is_type( 'variation' ) ? $parent->get_permalink() : null,
			'product_price'              => $product->get_price(),
			'product_sale_price'         => $product->get_sale_price(),
			'product_regular_price'      => $product->get_regular_price(),
			'product_stock_quantity'     => $product->get_stock_quantity(),
			'product_stock_status'       => $product->get_stock_status(),
			'product_weight'             => $product->get_weight(),
			'product_length'             => $product->get_length(),
			'product_width'              => $product->get_width(),
			'product_height'             => $product->get_height(),
			'product_dimensions'         => $product->get_dimensions(),
			'product_categories'         => $product->get_category_ids(),
			'product_tags'               => $product->get_tag_ids(),
			'product_attributes'         => $product->get_attributes(),
			'product_variations'         => $product->get_children(),
			'product_upsell_ids'         => $product->get_upsell_ids(),
			'product_cross_sell_ids'     => $product->get_cross_sell_ids(),
			'product_type'               => $product->get_type(),
			'product_status'             => $product->get_status(),
			'product_date_created'       => $product->get_date_created(),
			'product_date_modified'      => $product->get_date_modified(),
			'product_date_on_sale_from'  => $product->get_date_on_sale_from(),
			'product_date_on_sale_to'    => $product->get_date_on_sale_to(),
			'product_purchasable'        => $product->is_purchasable(),
			'product_virtual'            => $product->is_virtual(),
			'product_downloadable'       => $product->is_downloadable(),
			'product_featured'           => $product->is_featured(),
			'product_visible'            => $product->is_visible(),
			'product_on_sale'            => $product->is_on_sale(),
			'product_taxable'            => $product->is_taxable(),
			'product_shipping_required'  => $product->needs_shipping(),
			'product_shipping_taxable'   => $product->is_shipping_taxable(),
			'product_reviews_allowed'    => $product->get_reviews_allowed(),
			'product_rating_counts'      => $product->get_rating_counts(),
			'product_average_rating'     => $product->get_average_rating(),
			'product_review_count'       => $product->get_review_count(),
			'product_gallery_image_ids'  => $product->get_gallery_image_ids(),
			'product_image_id'           => $product->get_image_id(),
			'product_image'              => $product->get_image(),
			'product_catalog_visibility' => $product->get_catalog_visibility(),
			'product_description'        => $product->get_description(),
			'product_short_description'  => $product->get_short_description(),
			'product_meta'               => $product->get_meta_data(),
			'product_permalink'          => $product->get_permalink(),
			'product_add_to_cart_url'    => $product->add_to_cart_url(),
			'product_add_to_cart_text'   => $product->add_to_cart_text(),
			'product_tax_class'          => $product->get_tax_class(),
			'product_manage_stock'       => $product->managing_stock(),
			'product_downloads'          => $product->get_downloads(),
			'product_download_limit'     => $product->get_download_limit(),
			'product_total_sales'        => $product->get_total_sales(),
			'product_backorders'         => $product->get_backorders(),
			'product_is_on_sale'         => $product->is_on_sale(),
			'product_purchase_note'      => $product->get_purchase_note(),
			'product_sold_individually'  => $product->is_sold_individually(),
			'product_is_virtual'         => $product->is_virtual(),
			'product_is_downloadable'    => $product->is_downloadable(),
			'product_is_featured'        => $product->is_featured(),
			'product_is_visible'         => $product->is_visible(),
		);

		if ( ! empty( $key ) && isset( $productInfo[ $key ] ) ) {
			return $productInfo[$key];
		}

		return $productInfo;
	}

	/**
	 * Retrieve a list of keys for the product.
	 *
	 * @return array An array of keys for the product.
	 * @throws \Exception If the translation is not found.
	 */
	public function getKeys() { // phpcs:ignore
		return array( // List of keys for the product and their names for dropdowns, etc.
			'product_id'                 => __( 'Product ID', 'wp-list-info' ),
			'product_parent_id'          => __( 'Parent Product ID', 'wp-list-info' ),
			'product_name'               => __( 'Product Name', 'wp-list-info' ),
			'product_sku'                => __( 'Product SKU', 'wp-list-info' ),
			'product_parent_sku'         => __( 'Parent Product SKU', 'wp-list-info' ),
			'product_url'                => __( 'Product URL', 'wp-list-info' ),
			'product_parent_url'         => __( 'Parent Product URL', 'wp-list-info' ),
			'product_price'              => __( 'Product Price', 'wp-list-info' ),
			'product_sale_price'         => __( 'Product Sale Price', 'wp-list-info' ),
			'product_regular_price'      => __( 'Product Regular Price', 'wp-list-info' ),
			'product_stock_quantity'     => __( 'Product Stock Quantity', 'wp-list-info' ),
			'product_stock_status'       => __( 'Product Stock Status', 'wp-list-info' ),
			'product_weight'             => __( 'Product Weight', 'wp-list-info' ),
			'product_length'             => __( 'Product Length', 'wp-list-info' ),
			'product_width'              => __( 'Product Width', 'wp-list-info' ),
			'product_height'             => __( 'Product Height', 'wp-list-info' ),
			'product_dimensions'         => __( 'Product Dimensions', 'wp-list-info' ),
			'product_categories'         => __( 'Product Categories', 'wp-list-info' ),
			'product_tags'               => __( 'Product Tags', 'wp-list-info' ),
			'product_attributes'         => __( 'Product Attributes', 'wp-list-info' ),
			'product_variations'         => __( 'Product Variations', 'wp-list-info' ),
			'product_upsell_ids'         => __( 'Product Upsell IDs', 'wp-list-info' ),
			'product_cross_sell_ids'     => __( 'Product Cross-Sell IDs', 'wp-list-info' ),
			'product_type'               => __( 'Product Type', 'wp-list-info' ),
			'product_status'             => __( 'Product Status', 'wp-list-info' ),
			'product_date_created'       => __( 'Product Date Created', 'wp-list-info' ),
			'product_date_modified'      => __( 'Product Date Modified', 'wp-list-info' ),
			'product_date_on_sale_from'  => __( 'Product Date On Sale From', 'wp-list-info' ),
			'product_date_on_sale_to'    => __( 'Product Date On Sale To', 'wp-list-info' ),
			'product_purchasable'        => __( 'Product Purchasable', 'wp-list-info' ),
			'product_virtual'            => __( 'Product Virtual', 'wp-list-info' ),
			'product_downloadable'       => __( 'Product Downloadable', 'wp-list-info' ),
			'product_featured'           => __( 'Product Featured', 'wp-list-info' ),
			'product_visible'            => __( 'Product Visible', 'wp-list-info' ),
			'product_on_sale'            => __( 'Product On Sale', 'wp-list-info' ),
			'product_taxable'            => __( 'Product Taxable', 'wp-list-info' ),
			'product_shipping_required'  => __( 'Product Shipping Required', 'wp-list-info' ),
			'product_shipping_taxable'   => __( 'Product Shipping Taxable', 'wp-list-info' ),
			'product_reviews_allowed'    => __( 'Product Reviews Allowed', 'wp-list-info' ),
			'product_rating_counts'      => __( 'Product Rating Counts', 'wp-list-info' ),
			'product_average_rating'     => __( 'Product Average Rating', 'wp-list-info' ),
			'product_review_count'       => __( 'Product Review Count', 'wp-list-info' ),
			'product_gallery_image_ids'  => __( 'Product Gallery Image IDs', 'wp-list-info' ),
			'product_image_id'           => __( 'Product Image ID', 'wp-list-info' ),
			'product_image'              => __( 'Product Image', 'wp-list-info' ),
			'product_catalog_visibility' => __( 'Product Catalog Visibility', 'wp-list-info' ),
			'product_description'        => __( 'Product Description', 'wp-list-info' ),
			'product_short_description'  => __( 'Product Short Description', 'wp-list-info' ),
			'product_meta'               => __( 'Product Meta', 'wp-list-info' ),
			'product_permalink'          => __( 'Product Permalink', 'wp-list-info' ),
			'product_add_to_cart_url'    => __( 'Product Add to Cart URL', 'wp-list-info' ),
			'product_add_to_cart_text'   => __( 'Product Add to Cart Text', 'wp-list-info' ),
			'product_tax_class'          => __( 'Product Tax Class', 'wp-list-info' ),
			'product_manage_stock'       => __( 'Product Manage Stock', 'wp-list-info' ),
			'product_downloads'          => __( 'Product Downloads', 'wp-list-info' ),
			'product_download_limit'     => __( 'Product Download Limit', 'wp-list-info' ),
			'product_total_sales'        => __( 'Product Total Sales', 'wp-list-info' ),
			'product_backorders'         => __( 'Product Backorders', 'wp-list-info' ),
			'product_is_on_sale'         => __( 'Product Is On Sale', 'wp-list-info' ),
			'product_purchase_note'      => __( 'Product Purchase Note', 'wp-list-info' ),
			'product_sold_individually'  => __( 'Product Sold Individually', 'wp-list-info' ),
			'product_is_virtual'         => __( 'Product Is Virtual', 'wp-list-info' ),
			'product_is_downloadable'    => __( 'Product Is Downloadable', 'wp-list-info' ),
			'product_is_featured'        => __( 'Product Is Featured', 'wp-list-info' ),
			'product_is_visible'         => __( 'Product Is Visible', 'wp-list-info' ),
		);
	}

}
