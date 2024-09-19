<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class ShippingService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class ShippingService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific shipping method.
	 *
	 * @param int|object  $id The ID or Object for the shipping method.
	 * @param string|null $key The key for the shipping method.
	 * @return array|bool|float|int|string|null An array of all or single information about the shipping method.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$shipping = $this->getObject($id, 'shipping_method');
		if (!$shipping) {
			return null;
		}
		
		$shippingInfo = array(
			'shipping_id'          => $shipping->get_id(),
			'shipping_method'      => $shipping->get_method_title(),
			'shipping_cost'        => $shipping->get_cost(),
			'shipping_tax_status'  => $shipping->get_tax_status(),
			'shipping_instance_id' => $shipping->get_instance_id(),
		);
		
		return $key && isset($shippingInfo[$key]) ? $shippingInfo[$key] : $shippingInfo;
	}
	
	/**
	 * Retrieve a list of keys for the shipping method.
	 *
	 * @return array An array of keys for the shipping method.
	 */
	public function getKeys() {
		return array(
			'shipping_id'          => __('Shipping ID', 'wp-list-info'),
			'shipping_method'      => __('Shipping Method', 'wp-list-info'),
			'shipping_cost'        => __('Shipping Cost', 'wp-list-info'),
			'shipping_tax_status'  => __('Shipping Tax Status', 'wp-list-info'),
			'shipping_instance_id' => __('Shipping Instance ID', 'wp-list-info'),
		);
	}
}