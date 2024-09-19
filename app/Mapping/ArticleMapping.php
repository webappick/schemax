<?php

namespace Schemax\App\Mapping;


/**
 * Class ArticleMapping
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class ArticleMapping {

	protected $defaultMappings;

	public function __construct()
	{
		// Retrieve default mappings from ArticleSchema
		$articleSchema = new ArticleSchema();
		$this->defaultMappings = $articleSchema->getDefaultMappings();
	}

	/**
	 * Get the current mapping for the article schema.
	 * If no custom mappings exist, fall back to the default.
	 *
	 * @param string $schemaType
	 * @return array
	 */
	public function getMapping(string $schemaType): array
	{
		// Get the user-defined mapping from the database
		$customMapping = get_option('article_schema_mapping', []);

		// Merge user mapping with default mapping (user mappings override defaults)
		return array_merge($this->defaultMappings, $customMapping);
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param array $userMapping
	 */
	public function saveMapping(array $userMapping): void
	{
		// Save the user-defined mapping to the database
		update_option('article_schema_mapping', $userMapping);
	}

}
