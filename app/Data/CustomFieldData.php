<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class CustomFieldService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class CustomFieldService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific custom field.
	 *
	 * @param int|object  $id The ID or Object for the custom field.
	 * @param string|null $key The key for the custom field.
	 * @return array|bool|float|int|string|null An array of all or single information about the custom field.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$customField = $this->getObject($id, 'custom_field');
		if (!$customField) {
			return null;
		}
		
		$customFieldInfo = array(
			'custom_field_id'    => $customField->get_id(),
			'custom_field_key'   => $customField->get_key(),
			'custom_field_value' => $customField->get_value(),
			'custom_field_type'  => $customField->get_type(),
		);
		
		return $key && isset($customFieldInfo[$key]) ? $customFieldInfo[$key] : $customFieldInfo;
	}
	
	/**
	 * Retrieve a list of keys for the custom field.
	 *
	 * @return array An array of keys for the custom field.
	 */
	public function getKeys() {
		return array(
			'custom_field_id'    => __('Custom Field ID', 'wp-list-info'),
			'custom_field_key'   => __('Custom Field Key', 'wp-list-info'),
			'custom_field_value' => __('Custom Field Value', 'wp-list-info'),
			'custom_field_type'  => __('Custom Field Type', 'wp-list-info'),
		);
	}
}