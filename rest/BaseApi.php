<?php

namespace Schemax\Rest;

/**
 * Class Api
 *
 * This class is responsible for initializing and registering all the REST API routes for the Schemax plugin.
 */
class BaseApi {

	/**
	 * The namespace for the REST API routes.
	 */
	public const NAMESPACE_NAME = 'schemax';

	/**
	 * The version of the REST API.
	 */
	public const VERSION = 'v1';

	/**
	 * The route names for different API functionalities.
	 */
	public const SETTINGS_ROUTE_NAME = 'settings';
	public const PRODUCT_ROUTE_NAME = 'products'; // Example: for a product API route

	/**
	 * Constructor for the Api class.
	 *
	 * Adds the 'rest_api_init' action hook which calls the 'register_rest_api' method when the REST API is initialized.
	 */
	public function __construct() {
		add_action('rest_api_init', [$this, 'register_rest_api']);
	}

	/**
	 * Method to register all the REST API routes for the Schemax plugin.
	 *
	 * This method creates instances of the SettingsApi, ProductApi, and other APIs, and calls their respective 'register_routes' methods.
	 *
	 * @return void
	 */
	public function register_rest_api(): void {
		$settingsApi = new SettingsApi();
		$settingsApi->register_routes();

//		$productApi = new ProductApi(); // Example: for a Product-related API
//		$productApi->register_routes();

		// Add other API classes as needed
	}
}


