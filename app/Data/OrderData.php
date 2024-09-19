<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class OrderService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class OrderService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific order.
	 *
	 * @param int|object  $id The ID or Object for the order.
	 * @param string|null $key The key for the order.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the order.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$order = $this->getObject($id, 'shop_order');
		if (!$order) {
			return null;
		}
		
		$orderInfo = array(
			'order_id'              => $order->get_id(),
			'order_number'          => $order->get_order_number(),
			'order_date_created'    => $order->get_date_created(),
			'order_date_modified'   => $order->get_date_modified(),
			'order_status'          => $order->get_status(),
			'order_total'           => $order->get_total(),
			'order_currency'        => $order->get_currency(),
			'order_payment_method'  => $order->get_payment_method(),
			'order_payment_title'   => $order->get_payment_method_title(),
			'order_billing_address' => $order->get_billing_address(),
			'order_shipping_address'=> $order->get_shipping_address(),
			'order_items'           => $order->get_items(),
			'order_customer_id'     => $order->get_customer_id(),
			'order_customer_note'   => $order->get_customer_note(),
			'order_discount_total'  => $order->get_discount_total(),
			'order_discount_tax'    => $order->get_discount_tax(),
			'order_shipping_total'  => $order->get_shipping_total(),
			'order_shipping_tax'    => $order->get_shipping_tax(),
			'order_tax_total'       => $order->get_total_tax(),
			'order_meta'            => $order->get_meta_data(),
		);
		
		return $key && isset($orderInfo[$key]) ? $orderInfo[$key] : $orderInfo;
	}
	
	/**
	 * Retrieve a list of keys for the order.
	 *
	 * @return array An array of keys for the order.
	 */
	public function getKeys() {
		return array(
			'order_id'              => __('Order ID', 'wp-list-info'),
			'order_number'          => __('Order Number', 'wp-list-info'),
			'order_date_created'    => __('Order Date Created', 'wp-list-info'),
			'order_date_modified'   => __('Order Date Modified', 'wp-list-info'),
			'order_status'          => __('Order Status', 'wp-list-info'),
			'order_total'           => __('Order Total', 'wp-list-info'),
			'order_currency'        => __('Order Currency', 'wp-list-info'),
			'order_payment_method'  => __('Order Payment Method', 'wp-list-info'),
			'order_payment_title'   => __('Order Payment Title', 'wp-list-info'),
			'order_billing_address' => __('Order Billing Address', 'wp-list-info'),
			'order_shipping_address'=> __('Order Shipping Address', 'wp-list-info'),
			'order_items'           => __('Order Items', 'wp-list-info'),
			'order_customer_id'     => __('Order Customer ID', 'wp-list-info'),
			'order_customer_note'   => __('Order Customer Note', 'wp-list-info'),
			'order_discount_total'  => __('Order Discount Total', 'wp-list-info'),
			'order_discount_tax'    => __('Order Discount Tax', 'wp-list-info'),
			'order_shipping_total'  => __('Order Shipping Total', 'wp-list-info'),
			'order_shipping_tax'    => __('Order Shipping Tax', 'wp-list-info'),
			'order_tax_total'       => __('Order Tax Total', 'wp-list-info'),
			'order_meta'            => __('Order Meta', 'wp-list-info'),
		);
	}
}