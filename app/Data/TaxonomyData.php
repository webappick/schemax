<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class TaxonomyService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class TaxonomyService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific taxonomy.
	 *
	 * @param int|object  $id The ID or Object for the taxonomy.
	 * @param string|null $key The key for the taxonomy.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the taxonomy.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$taxonomy = $this->getObject($id, 'taxonomy');
		if (!$taxonomy) {
			return null;
		}
		
		$taxonomyInfo = array(
			'taxonomy_id'          => $taxonomy->term_id,
			'taxonomy_name'        => $taxonomy->name,
			'taxonomy_slug'        => $taxonomy->slug,
			'taxonomy_description' => $taxonomy->description,
			'taxonomy_count'       => $taxonomy->count,
		);
		
		return $key && isset($taxonomyInfo[$key]) ? $taxonomyInfo[$key] : $taxonomyInfo;
	}
	
	/**
	 * Retrieve a list of keys for the taxonomy.
	 *
	 * @return array An array of keys for the taxonomy.
	 */
	public function getKeys() {
		return array(
			'taxonomy_id'          => __('Taxonomy ID', 'wp-list-info'),
			'taxonomy_name'        => __('Taxonomy Name', 'wp-list-info'),
			'taxonomy_slug'        => __('Taxonomy Slug', 'wp-list-info'),
			'taxonomy_description' => __('Taxonomy Description', 'wp-list-info'),
			'taxonomy_count'       => __('Taxonomy Count', 'wp-list-info'),
		);
	}
}