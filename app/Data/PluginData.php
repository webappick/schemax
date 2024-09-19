<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class PluginService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class PluginService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific plugin.
	 *
	 * @param int|object  $id The ID or Object for the plugin.
	 * @param string|null $key The key for the plugin.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the plugin.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$plugin = get_plugin_data(WP_PLUGIN_DIR . '/' . $id);
		if (!$plugin) {
			return null;
		}
		
		$pluginInfo = array(
			'plugin_name'        => $plugin['Name'],
			'plugin_version'     => $plugin['Version'],
			'plugin_author'      => $plugin['Author'],
			'plugin_author_uri'  => $plugin['AuthorURI'],
			'plugin_description' => $plugin['Description'],
			'plugin_text_domain' => $plugin['TextDomain'],
			'plugin_domain_path' => $plugin['DomainPath'],
			'plugin_network'     => $plugin['Network'],
			'plugin_title'       => $plugin['Title'],
			'plugin_uri'         => $plugin['PluginURI'],
		);
		
		return $key && isset($pluginInfo[$key]) ? $pluginInfo[$key] : $pluginInfo;
	}
	
	/**
	 * Retrieve a list of keys for the plugin.
	 *
	 * @return array An array of keys for the plugin.
	 */
	public function getKeys() {
		return array(
			'plugin_name'        => __('Plugin Name', 'wp-list-info'),
			'plugin_version'     => __('Plugin Version', 'wp-list-info'),
			'plugin_author'      => __('Plugin Author', 'wp-list-info'),
			'plugin_author_uri'  => __('Plugin Author URI', 'wp-list-info'),
			'plugin_description' => __('Plugin Description', 'wp-list-info'),
			'plugin_text_domain' => __('Plugin Text Domain', 'wp-list-info'),
			'plugin_domain_path' => __('Plugin Domain Path', 'wp-list-info'),
			'plugin_network'     => __('Plugin Network', 'wp-list-info'),
			'plugin_title'       => __('Plugin Title', 'wp-list-info'),
			'plugin_uri'         => __('Plugin URI', 'wp-list-info'),
		);
	}
}