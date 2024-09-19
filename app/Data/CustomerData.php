<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class CustomerService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class CustomerService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific customer.
	 *
	 * @param int|object  $id The ID or Object for the customer.
	 * @param string|null $key The key for the customer.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the customer.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$customer = $this->getObject($id, 'customer');
		if (!$customer) {
			return null;
		}
		
		$customerInfo = array(
			'customer_id'           => $customer->get_id(),
			'customer_name'         => $customer->get_name(),
			'customer_email'        => $customer->get_email(),
			'customer_phone'        => $customer->get_phone(),
			'customer_billing'      => $customer->get_billing(),
			'customer_shipping'     => $customer->get_shipping(),
			'customer_orders'       => $customer->get_orders(),
			'customer_total_spent'  => $customer->get_total_spent(),
			'customer_last_order'   => $customer->get_last_order(),
			'customer_date_created' => $customer->get_date_created(),
			'customer_date_modified'=> $customer->get_date_modified(),
		);
		
		return $key && isset($customerInfo[$key]) ? $customerInfo[$key] : $customerInfo;
	}
	
	/**
	 * Retrieve a list of keys for the customer.
	 *
	 * @return array An array of keys for the customer.
	 * @throws \Exception
	 */
	public function getKeys() {
		return array(
			'customer_id'           => __('Customer ID', 'wp-list-info'),
			'customer_name'         => __('Customer Name', 'wp-list-info'),
			'customer_email'        => __('Customer Email', 'wp-list-info'),
			'customer_phone'        => __('Customer Phone', 'wp-list-info'),
			'customer_billing'      => __('Customer Billing', 'wp-list-info'),
			'customer_shipping'     => __('Customer Shipping', 'wp-list-info'),
			'customer_orders'       => __('Customer Orders', 'wp-list-info'),
			'customer_total_spent'  => __('Customer Total Spent', 'wp-list-info'),
			'customer_last_order'   => __('Customer Last Order', 'wp-list-info'),
			'customer_date_created' => __('Customer Date Created', 'wp-list-info'),
			'customer_date_modified'=> __('Customer Date Modified', 'wp-list-info'),
		);
	}
}