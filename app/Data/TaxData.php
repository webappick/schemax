<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class TaxService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class TaxService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific tax.
	 *
	 * @param int|object  $id The ID or Object for the tax.
	 * @param string|null $key The key for the tax.
	 * @return array|bool|float|int|string|null An array of all or single information about the tax.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$tax = $this->getObject($id, 'tax');
		if (!$tax) {
			return null;
		}
		
		$taxInfo = array(
			'tax_id'          => $tax->get_id(),
			'tax_name'        => $tax->get_name(),
			'tax_rate'        => $tax->get_rate(),
			'tax_class'       => $tax->get_class(),
			'tax_priority'    => $tax->get_priority(),
			'tax_compound'    => $tax->is_compound(),
			'tax_shipping'    => $tax->is_shipping(),
			'tax_order'       => $tax->get_order(),
			'tax_label'       => $tax->get_label(),
		);
		
		return $key && isset($taxInfo[$key]) ? $taxInfo[$key] : $taxInfo;
	}
	
	/**
	 * Retrieve a list of keys for the tax.
	 *
	 * @return array An array of keys for the tax.
	 */
	public function getKeys() {
		return array(
			'tax_id'          => __('Tax ID', 'wp-list-info'),
			'tax_name'        => __('Tax Name', 'wp-list-info'),
			'tax_rate'        => __('Tax Rate', 'wp-list-info'),
			'tax_class'       => __('Tax Class', 'wp-list-info'),
			'tax_priority'    => __('Tax Priority', 'wp-list-info'),
			'tax_compound'    => __('Tax Compound', 'wp-list-info'),
			'tax_shipping'    => __('Tax Shipping', 'wp-list-info'),
			'tax_order'       => __('Tax Order', 'wp-list-info'),
			'tax_label'       => __('Tax Label', 'wp-list-info'),
		);
	}
}