<?php
namespace Schemax\App\Api;

use Schemax\App\SettingsManager;
use WP_REST_Controller;
use WP_REST_Server;
use WP_REST_Request;

class SettingsApi extends WP_REST_Controller
{
	/**
	 * Register the routes for settings.
	 */
	public function registerRoutes(): void
	{
		register_rest_route(
			'schemax/v1',
			'/settings/',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [$this, 'getAllSettings'],
					'permission_callback' => [$this, 'permissionsCheck'],
				],
				[
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => [$this, 'updateSettings'],
					'permission_callback' => [$this, 'permissionsCheck'],
					'args'                => $this->get_endpoint_args_for_item_schema(WP_REST_Server::EDITABLE),
				],
			]
		);
	}

	/**
	 * Permission callback to ensure only authorized users can access this.
	 */
	public function permissionsCheck(): bool
	{
		return current_user_can('manage_options');
	}

	/**
	 * Get all settings.
	 *
	 * @return \WP_REST_Response The response containing all settings.
	 */
	public function getAllSettings(WP_REST_Request $request): \WP_REST_Response
	{
		$settings = SettingsManager::getAllSettings();
		return rest_ensure_response($settings);
	}

	/**
	 * Update settings with validation.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return \WP_Error|\WP_REST_Response
	 */
	public function updateSettings(WP_REST_Request $request)
	{
		// Sanitize and prepare the settings
		$settings = $this->prepare_item_for_database($request);

		// Validate the settings against the schema
		$schema = $this->get_item_schema();
		$valid_settings = rest_validate_value_from_schema($settings, $schema);

		if (is_wp_error($valid_settings)) {
			return $valid_settings;
		}

		// Save the settings
		$saved = SettingsManager::saveSettings($valid_settings);
		if (!$saved) {
			return new \WP_Error('rest_not_updated', __('Settings could not be updated.', 'schemax'), ['status' => 500]);
		}

		// Fetch the updated settings
		$updated_settings = SettingsManager::getAllSettings();
		return rest_ensure_response($updated_settings);
	}

	/**
	 * Prepare item for saving to the database.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return array Prepared and sanitized settings.
	 */
	protected function prepare_item_for_database(WP_REST_Request $request): array
	{
		$prepared_settings = [];

		if (isset($request['schema_type'])) {
			$prepared_settings['schema_type'] = sanitize_text_field($request['schema_type']);
		}

		if (isset($request['enable_schema'])) {
			$prepared_settings['enable_schema'] = filter_var($request['enable_schema'], FILTER_VALIDATE_BOOLEAN);
		}

		if (isset($request['default_language'])) {
			$prepared_settings['default_language'] = sanitize_text_field($request['default_language']);
		}

		// Add more settings as needed...

		return $prepared_settings;
	}

	/**
	 * Define the settings schema for validation.
	 *
	 * @return array The schema for the settings.
	 */
	public function get_item_schema(): array
	{
		return [
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			'title'      => 'settings',
			'type'       => 'object',
			'properties' => [
				'schema_type' => [
					'description' => __('The type of schema to use.', 'schemax'),
					'type'        => 'string',
					'enum'        => ['product', 'article'],
					'context'     => ['view', 'edit'],
				],
				'enable_schema' => [
					'description' => __('Whether to enable schema functionality.', 'schemax'),
					'type'        => 'boolean',
					'context'     => ['view', 'edit'],
				],
				'default_language' => [
					'description' => __('Default language for schema.', 'schemax'),
					'type'        => 'string',
					'context'     => ['view', 'edit'],
				],
				// Add more settings properties as needed...
			],
		];
	}
}
