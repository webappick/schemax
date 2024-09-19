<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class SiteService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class SiteService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about the site.
	 *
	 * @param int|object  $id The ID or Object for the site (not used in this context).
	 * @param string|null $key The key for the site information.
	 * @return array|bool|float|int|string|null An array of all or single information about the site.
	 */
	public function getInfo($id, $key = null) {
		$siteInfo = array(
			'site_name'        => get_bloginfo('name'),
			'site_description' => get_bloginfo('description'),
			'site_url'         => get_bloginfo('url'),
			'site_wp_version'  => get_bloginfo('version'),
			'site_language'    => get_bloginfo('language'),
			'site_charset'     => get_bloginfo('charset'),
			'site_admin_email' => get_bloginfo('admin_email'),
			'site_timezone'    => get_option('timezone_string'),
			'site_permalink_structure' => get_option('permalink_structure'),
		);
		
		return $key && isset($siteInfo[$key]) ? $siteInfo[$key] : $siteInfo;
	}
	
	/**
	 * Retrieve a list of keys for the site.
	 *
	 * @return array An array of keys for the site.
	 */
	public function getKeys() {
		return array(
			'site_name'        => __('Site Name', 'wp-list-info'),
			'site_description' => __('Site Description', 'wp-list-info'),
			'site_url'         => __('Site URL', 'wp-list-info'),
			'site_wp_version'  => __('WordPress Version', 'wp-list-info'),
			'site_language'    => __('Site Language', 'wp-list-info'),
			'site_charset'     => __('Site Charset', 'wp-list-info'),
			'site_admin_email' => __('Admin Email', 'wp-list-info'),
			'site_timezone'    => __('Site Timezone', 'wp-list-info'),
			'site_permalink_structure' => __('Permalink Structure', 'wp-list-info'),
		);
	}
}