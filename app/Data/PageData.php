<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class PageService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class PageService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific page.
	 *
	 * @param int|object  $id The ID or Object for the page.
	 * @param string|null $key The key for the page.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the page.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$page = $this->getObject($id, 'page');
		if (!$page) {
			return null;
		}
		
		$pageInfo = array(
			'page_id'            => $page->ID,
			'page_title'         => $page->post_title,
			'page_content'       => $page->post_content,
			'page_excerpt'       => $page->post_excerpt,
			'page_status'        => $page->post_status,
			'page_author'        => $page->post_author,
			'page_date'          => $page->post_date,
			'page_modified'      => $page->post_modified,
			'page_parent'        => $page->post_parent,
			'page_template'      => get_page_template_slug($page->ID),
			'page_permalink'     => get_permalink($page->ID),
			'page_meta'          => get_post_meta($page->ID),
		);
		
		return $key && isset($pageInfo[$key]) ? $pageInfo[$key] : $pageInfo;
	}
	
	/**
	 * Retrieve a list of keys for the page.
	 *
	 * @return array An array of keys for the page.
	 */
	public function getKeys() {
		return array(
			'page_id'            => __('Page ID', 'wp-list-info'),
			'page_title'         => __('Page Title', 'wp-list-info'),
			'page_content'       => __('Page Content', 'wp-list-info'),
			'page_excerpt'       => __('Page Excerpt', 'wp-list-info'),
			'page_status'        => __('Page Status', 'wp-list-info'),
			'page_author'        => __('Page Author', 'wp-list-info'),
			'page_date'          => __('Page Date', 'wp-list-info'),
			'page_modified'      => __('Page Modified', 'wp-list-info'),
			'page_parent'        => __('Page Parent', 'wp-list-info'),
			'page_template'      => __('Page Template', 'wp-list-info'),
			'page_permalink'     => __('Page Permalink', 'wp-list-info'),
			'page_meta'          => __('Page Meta', 'wp-list-info'),
		);
	}
}