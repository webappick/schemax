<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class PaymentService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class PaymentService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific payment.
	 *
	 * @param int|object  $id The ID or Object for the payment.
	 * @param string|null $key The key for the payment.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the payment.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$payment = $this->getObject($id, 'payment');
		if (!$payment) {
			return null;
		}
		
		$paymentInfo = array(
			'payment_id'          => $payment->get_id(),
			'payment_method'      => $payment->get_method(),
			'payment_total'       => $payment->get_total(),
			'payment_currency'    => $payment->get_currency(),
			'payment_status'      => $payment->get_status(),
			'payment_date'        => $payment->get_date(),
			'payment_transaction_id' => $payment->get_transaction_id(),
			'payment_meta'        => $payment->get_meta_data(),
		);
		
		return $key && isset($paymentInfo[$key]) ? $paymentInfo[$key] : $paymentInfo;
	}
	
	/**
	 * Retrieve a list of keys for the payment.
	 *
	 * @return array An array of keys for the payment.
	 */
	public function getKeys() {
		return array(
			'payment_id'          => __('Payment ID', 'wp-list-info'),
			'payment_method'      => __('Payment Method', 'wp-list-info'),
			'payment_total'       => __('Payment Total', 'wp-list-info'),
			'payment_currency'    => __('Payment Currency', 'wp-list-info'),
			'payment_status'      => __('Payment Status', 'wp-list-info'),
			'payment_date'        => __('Payment Date', 'wp-list-info'),
			'payment_transaction_id' => __('Payment Transaction ID', 'wp-list-info'),
			'payment_meta'        => __('Payment Meta', 'wp-list-info'),
		);
	}
}