<?php

namespace Schemax\App\Schema;


class ArticleSchema extends AbstractSchema {
	protected $schemaType = 'Article';

	/**
	 * Get the default mappings for the Article schema.
	 * This can include the mapping of schema properties to post meta keys.
	 * The mappings should be in the format
	 *                  [
	 *                  'schema_property' =>[
	 *                      'mapping' => 'post_title',
	 *                      'instances'=> false or [] //If the property can have multiple instances,
	 *                   ].
	 *
	 * @return array The default mappings for the Article schema.
	 */
	public function getDefaultMappings(): array {
		return [
			'headline'      => [
				'mapping'   => 'post_title',
				'instances' => false,
			],
			'description'   => [
				'mapping' => 'post_excerpt',
			],
			'author'        => [
				'mapping' => 'post_author',
			],
			'datePublished' => [
				'mapping' => 'post_date',
			],
		];
	}

	/**
	 * Get schema property configurations (optional).
	 * This can include labels, descriptions, required properties, etc.
	 *
	 * @return array The configuration data for the Article schema properties.
	 */
	public static function getPropertyConfigurations(): array {
		// List of properties for the Article schema
		return [
			'headline'      => [
				'label'       => 'Article Headline',
				'description' => 'The headline of the article.',
				'required'    => true
			],
			'description'   => [
				'label'       => 'Article Description',
				'description' => 'A brief description of the article.',
				'required'    => true
			],
			'author'        => [
				'label'       => 'Author',
				'description' => 'The author of the article.',
				'required'    => true
			],
			'datePublished' => [
				'label'       => 'Date Published',
				'description' => 'The date the article was published.',
				'required'    => true
			],
			// Add more configurations as needed
		];
	}
}
