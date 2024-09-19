<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class UserService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class UserService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific user.
	 *
	 * @param int|object  $id The ID or Object for the user.
	 * @param string|null $key The key for the user.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the user.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$user = $this->getObject($id, 'user');
		if (!$user) {
			return null;
		}
		
		$userInfo = array(
			'user_id'           => $user->ID,
			'user_login'        => $user->user_login,
			'user_email'        => $user->user_email,
			'user_registered'   => $user->user_registered,
			'user_status'       => $user->user_status,
			'display_name'      => $user->display_name,
			'user_roles'        => $user->roles,
			'user_first_name'   => get_user_meta($user->ID, 'first_name', true),
			'user_last_name'    => get_user_meta($user->ID, 'last_name', true),
			'user_nickname'     => get_user_meta($user->ID, 'nickname', true),
			'user_description'  => get_user_meta($user->ID, 'description', true),
		);
		
		return $key && isset($userInfo[$key]) ? $userInfo[$key] : $userInfo;
	}
	
	/**
	 * Retrieve a list of keys for the user.
	 *
	 * @return array An array of keys for the user.
	 */
	public function getKeys() {
		return array(
			'user_id'           => __('User ID', 'wp-list-info'),
			'user_login'        => __('User Login', 'wp-list-info'),
			'user_email'        => __('User Email', 'wp-list-info'),
			'user_registered'   => __('User Registered', 'wp-list-info'),
			'user_status'       => __('User Status', 'wp-list-info'),
			'display_name'      => __('Display Name', 'wp-list-info'),
			'user_roles'        => __('User Roles', 'wp-list-info'),
			'user_first_name'   => __('User First Name', 'wp-list-info'),
			'user_last_name'    => __('User Last Name', 'wp-list-info'),
			'user_nickname'     => __('User Nickname', 'wp-list-info'),
			'user_description'  => __('User Description', 'wp-list-info'),
		);
	}
}