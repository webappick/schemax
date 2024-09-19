<?php
/**
 * DataAbstract
 *
 * This class is responsible for managing the data for the schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Data
 */

namespace Schemax\App\Data;


/**
 * Class DataAbstract
 *
 * @package    Schemax;
 * @subpackage Schemax\App\Data;
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
abstract class DataAbstract implements DataInterface { //phpcs:ignore

	/**
	 * Get the data for the schema.
	 *
	 * @param \WC_Product|\WC_Product_Variable $product The ID of the product or post to get the data for.
	 *
	 * @return array The data for the schema.
	 */
	public function getOffers( \WC_Product $product ): array {

		if ( $product->is_type( 'variable' ) ) {
			$variation = $product->get_available_variations();
			$min_price = $product->get_variation_price( 'min', true );
			$max_price = $product->get_variation_price( 'max', true );

			return [
				'offer_price'         => $min_price,
				'offer_currency'  => get_woocommerce_currency(),
				'offer_low_price'      => $min_price,
				'offer_high_price'     => $max_price,
			];
		}

		return [
			'offer_price'    => $product->get_price(),
			'offer_currency' => get_woocommerce_currency(),
		];

	}
}
