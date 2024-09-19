<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class ThemeService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class ThemeService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific theme.
	 *
	 * @param int|object  $id The ID or Object for the theme.
	 * @param string|null $key The key for the theme.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the theme.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$theme = wp_get_theme($id);
		if (!$theme) {
			return null;
		}
		
		$themeInfo = array(
			'theme_name'        => $theme->get('Name'),
			'theme_version'     => $theme->get('Version'),
			'theme_author'      => $theme->get('Author'),
			'theme_author_uri'  => $theme->get('AuthorURI'),
			'theme_description' => $theme->get('Description'),
			'theme_text_domain' => $theme->get('TextDomain'),
			'theme_tags'        => $theme->get('Tags'),
			'theme_template'    => $theme->get('Template'),
			'theme_stylesheet'  => $theme->get_stylesheet(),
			'theme_screenshot'  => $theme->get_screenshot(),
		);
		
		return $key && isset($themeInfo[$key]) ? $themeInfo[$key] : $themeInfo;
	}
	
	/**
	 * Retrieve a list of keys for the theme.
	 *
	 * @return array An array of keys for the theme.
	 */
	public function getKeys() {
		return array(
			'theme_name'        => __('Theme Name', 'wp-list-info'),
			'theme_version'     => __('Theme Version', 'wp-list-info'),
			'theme_author'      => __('Theme Author', 'wp-list-info'),
			'theme_author_uri'  => __('Theme Author URI', 'wp-list-info'),
			'theme_description' => __('Theme Description', 'wp-list-info'),
			'theme_text_domain' => __('Theme Text Domain', 'wp-list-info'),
			'theme_tags'        => __('Theme Tags', 'wp-list-info'),
			'theme_template'    => __('Theme Template', 'wp-list-info'),
			'theme_stylesheet'  => __('Theme Stylesheet', 'wp-list-info'),
			'theme_screenshot'  => __('Theme Screenshot', 'wp-list-info'),
		);
	}
}