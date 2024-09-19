<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class MetaService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class MetaService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific meta.
	 *
	 * @param int|object  $id The ID or Object for the meta.
	 * @param string|null $key The key for the meta.
	 * @return array|bool|float|int|string|null An array of all or single information about the meta.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$meta = $this->getObject($id, 'meta');
		if (!$meta) {
			return null;
		}
		
		$metaInfo = array(
			'meta_id'    => $meta->get_id(),
			'meta_key'   => $meta->get_key(),
			'meta_value' => $meta->get_value(),
			'meta_type'  => $meta->get_type(),
		);
		
		return $key && isset($metaInfo[$key]) ? $metaInfo[$key] : $metaInfo;
	}
	
	/**
	 * Retrieve a list of keys for the meta.
	 *
	 * @return array An array of keys for the meta.
	 * @throws \Exception
	 */
	public function getKeys() {
		return array(
			'meta_id'    => __('Meta ID', 'wp-list-info'),
			'meta_key'   => __('Meta Key', 'wp-list-info'),
			'meta_value' => __('Meta Value', 'wp-list-info'),
			'meta_type'  => __('Meta Type', 'wp-list-info'),
		);
	}
}