<?php
namespace Schemax\Rest;

use Schemax\App\Mapping\MappingFactory;
use WP_REST_Controller;
use WP_REST_Server;
use WP_REST_Request;
use Schemax\App\Mapping\MappingManager;

class MappingApi extends WP_REST_Controller
{


	/**
	 * Register the routes for user mappings.
	 */
	public function register_routes(): void
	{
		register_rest_route(
			'schemax/v1',
			'/mapping/(?P<schema>[a-zA-Z0-9_-]+)(?:/(?P<id>\d+))?',
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [$this, 'getMapping'],
					'permission_callback' => [$this, 'permissionsCheck'],
					'args'                => [
						'schema' => [
							'required'          => true,
							'validate_callback' => function ($param) {
								return is_string($param);
							}
						],
						'id' => [
							'required'          => false,
							'validate_callback' => function ($param) {
								return is_numeric($param);
							}
						]
					]
				],
				[
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => [$this, 'saveMapping'],
					'permission_callback' => [$this, 'permissionsCheck'],
					'args'                => $this->get_endpoint_args_for_item_schema(WP_REST_Server::EDITABLE),
				],
				[
					'methods'             => WP_REST_Server::DELETABLE,
					'callback'            => [$this, 'resetMapping'],
					'permission_callback' => [$this, 'permissionsCheck'],
					'args'                => [
						'schema' => [
							'required'          => true,
							'validate_callback' => function ($param) {
								return is_string($param);
							}
						],
						'id' => [
							'required'          => false,
							'validate_callback' => function ($param) {
								return is_numeric($param);
							}
						]
					]
				]
			]
		);
	}

	/**
	 * Get the mapping for a specific schema and optional ID.
	 *
	 * @throws \Patchwork\Exceptions\NonNullToVoid
	 * @throws \Exception
	 */
	public function getMapping(WP_REST_Request $request)
	{
		$schema = $request['schema'];
		$id = $request->get_param('id');
		$mappingRegistry = new MappingFactory( $schema );
		$mapping = $mappingRegistry->getMapping($id);

		if (empty($mapping)) {
			return new \WP_Error('rest_mapping_not_found', __('Mapping not found', 'schemax'), ['status' => 404]);
		}

		return rest_ensure_response($mapping);
	}

	/**
	 * Save the mapping for a specific schema and optional ID.
	 */
	public function saveMapping(WP_REST_Request $request)
	{
		$schema = $request['schema'];
		$id = $request->get_param('id');
		$newMapping = $request->get_json_params();

		// Validate and save mapping
		$saved = $this->mappingManager->saveMapping($schema, $newMapping, $id);

		if (!$saved) {
			return new \WP_Error('rest_mapping_not_saved', __('Failed to save mapping', 'schemax'), ['status' => 500]);
		}

		return rest_ensure_response(['message' => 'Mapping saved successfully']);
	}

	/**
	 * Reset the mapping for a specific schema and optional ID.
	 */
	public function resetMapping(WP_REST_Request $request)
	{
		$schema = $request['schema'];
		$id = $request->get_param('id');

		$reset = $this->mappingManager->resetMappingToDefault($schema, $id);

		if (!$reset) {
			return new \WP_Error('rest_mapping_not_reset', __('Failed to reset mapping', 'schemax'), ['status' => 500]);
		}

		return rest_ensure_response(['message' => 'Mapping reset successfully']);
	}
}
