<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class TermService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class TermService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific term.
	 *
	 * @param int|object  $id The ID or Object for the term.
	 * @param string|null $key The key for the term.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the term.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$term = $this->getObject($id, 'term');
		if (!$term) {
			return null;
		}
		
		$termInfo = array(
			'term_id'          => $term->term_id,
			'term_name'        => $term->name,
			'term_slug'        => $term->slug,
			'term_description' => $term->description,
			'term_count'       => $term->count,
		);
		
		return $key && isset($termInfo[$key]) ? $termInfo[$key] : $termInfo;
	}
	
	/**
	 * Retrieve a list of keys for the term.
	 *
	 * @return array An array of keys for the term.
	 */
	public function getKeys() {
		return array(
			'term_id'          => __('Term ID', 'wp-list-info'),
			'term_name'        => __('Term Name', 'wp-list-info'),
			'term_slug'        => __('Term Slug', 'wp-list-info'),
			'term_description' => __('Term Description', 'wp-list-info'),
			'term_count'       => __('Term Count', 'wp-list-info'),
		);
	}
}