<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class CouponService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class CouponService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific coupon.
	 *
	 * @param int|object  $id The ID or Object for the coupon.
	 * @param string|null $key The key for the coupon.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the coupon.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$coupon = $this->getObject($id, 'shop_coupon');
		if (!$coupon) {
			return null;
		}
		
		$couponInfo = array(
			'coupon_id'                 => $coupon->get_id(),
			'coupon_code'               => $coupon->get_code(),
			'coupon_amount'             => $coupon->get_amount(),
			'coupon_date_created'       => $coupon->get_date_created(),
			'coupon_date_modified'      => $coupon->get_date_modified(),
			'coupon_date_expires'       => $coupon->get_date_expires(),
			'coupon_usage_count'        => $coupon->get_usage_count(),
			'coupon_individual_use'     => $coupon->get_individual_use(),
			'coupon_product_ids'        => $coupon->get_product_ids(),
			'coupon_excluded_product_ids' => $coupon->get_excluded_product_ids(),
			'coupon_usage_limit'        => $coupon->get_usage_limit(),
			'coupon_usage_limit_per_user' => $coupon->get_usage_limit_per_user(),
			'coupon_limit_usage_to_x_items' => $coupon->get_limit_usage_to_x_items(),
			'coupon_free_shipping'      => $coupon->get_free_shipping(),
			'coupon_product_categories' => $coupon->get_product_categories(),
			'coupon_excluded_product_categories' => $coupon->get_excluded_product_categories(),
			'coupon_exclude_sale_items' => $coupon->get_exclude_sale_items(),
			'coupon_minimum_amount'     => $coupon->get_minimum_amount(),
			'coupon_maximum_amount'     => $coupon->get_maximum_amount(),
			'coupon_email_restrictions' => $coupon->get_email_restrictions(),
			'coupon_used_by'            => $coupon->get_used_by(),
		);
		
		return $key && isset($couponInfo[$key]) ? $couponInfo[$key] : $couponInfo;
	}
	
	/**
	 * Retrieve a list of keys for the coupon.
	 *
	 * @return array An array of keys for the coupon.
	 */
	public function getKeys() {
		return array(
			'coupon_id'                 => __('Coupon ID', 'wp-list-info'),
			'coupon_code'               => __('Coupon Code', 'wp-list-info'),
			'coupon_amount'             => __('Coupon Amount', 'wp-list-info'),
			'coupon_date_created'       => __('Coupon Date Created', 'wp-list-info'),
			'coupon_date_modified'      => __('Coupon Date Modified', 'wp-list-info'),
			'coupon_date_expires'       => __('Coupon Date Expires', 'wp-list-info'),
			'coupon_usage_count'        => __('Coupon Usage Count', 'wp-list-info'),
			'coupon_individual_use'     => __('Coupon Individual Use', 'wp-list-info'),
			'coupon_product_ids'        => __('Coupon Product IDs', 'wp-list-info'),
			'coupon_excluded_product_ids' => __('Coupon Excluded Product IDs', 'wp-list-info'),
			'coupon_usage_limit'        => __('Coupon Usage Limit', 'wp-list-info'),
			'coupon_usage_limit_per_user' => __('Coupon Usage Limit Per User', 'wp-list-info'),
			'coupon_limit_usage_to_x_items' => __('Coupon Limit Usage To X Items', 'wp-list-info'),
			'coupon_free_shipping'      => __('Coupon Free Shipping', 'wp-list-info'),
			'coupon_product_categories' => __('Coupon Product Categories', 'wp-list-info'),
			'coupon_excluded_product_categories' => __('Coupon Excluded Product Categories', 'wp-list-info'),
			'coupon_exclude_sale_items' => __('Coupon Exclude Sale Items', 'wp-list-info'),
			'coupon_minimum_amount'     => __('Coupon Minimum Amount', 'wp-list-info'),
			'coupon_maximum_amount'     => __('Coupon Maximum Amount', 'wp-list-info'),
			'coupon_email_restrictions' => __('Coupon Email Restrictions', 'wp-list-info'),
			'coupon_used_by'            => __('Coupon Used By', 'wp-list-info'),
		);
	}
}