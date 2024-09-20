<?php
/**
 * ArticleMapping
 *
 * This class is responsible for managing the mapping of the article schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Mapping
 */

namespace Schemax\App\Mapping;

use Schemax\App\Schema\ArticleSchema;

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
class ArticleMapping extends MappingAbstract {

	/**
	 * @var array $default_mappings Default mappings for the schema.
	 */
	protected $default_mappings;

	public function __construct() {
		// Retrieve default mappings from ArticleSchema
		$articleSchema          = new ArticleSchema;
		$this->default_mappings = $articleSchema->getDefaultMappings();

		// Call the parent constructor with the default mappings
		parent::__construct( $this->default_mappings );
	}

	/**
	 * Get the current mapping for the article schema.
	 * If no custom mappings exist, fall back to the default.
	 *
	 * @param string $schema_type The schema type to get the mapping for. (e.g., 'Article')
	 * @param null   $id The ID of the article to get the mapping for.
	 *
	 * @return array The current mapping for the article schema.
	 */
	public function getMapping( string $schema_type, $id = null): array { //phpcs:ignore
		// If an ID is provided, get the mapping for that specific article meta
		if ( $id ) {
			$customMapping = get_post_meta( $id, 'article_schema_mapping', true );

			return $customMapping ?: $this->default_mappings;
		}
		// Get the user-defined mapping from the database
		$customMapping = get_option( 'schemax_article_mappings', array() );

		// Merge user mapping with default mapping (user mappings override defaults)
		return array_merge( $this->default_mappings, $customMapping );
	}

	/**
	 * Save the custom mapping provided by the user.
	 *
	 * @param array $userMapping The user-defined mapping to save.
	 */
	public function saveMapping( array $userMapping, $id=null ): bool {
		// Save the user-defined mapping to the database
		return update_option( 'schemax_article_mappings', $userMapping );
	}

}
