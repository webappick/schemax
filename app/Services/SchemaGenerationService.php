<?php

namespace Schemax\App\Services;

use Spatie\SchemaOrg\Schema;
/**
 * Class SchemaGenerationService
 *
 * @package    Schemax
 * @subpackage Schemax\App\Services
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */

class SchemaGenerationService
{
	protected $mappingManager;

	public function __construct($mappingManager)
	{
		$this->mappingManager = $mappingManager;
	}

	/**
	 * Generate the schema for a given product or post using SchemaxInfo
	 *
	 * @param mixed $idObject The ID of the product or post to generate the schema for
	 * @return \Spatie\SchemaOrg\BaseType
	 */
	public function generateSchema($idObject)
	{
		// Fetch the product data using SchemaxInfo
		$productData = SchemaxInfo::GetInfo($idObject);

		// Get the user-defined or default mapping for Product
		$productMapping = $this->mappingManager->getMapping('Product');

		// Initialize the product schema using Spatie Schema.org
		$schema = Schema::product()
			->name($productData[$productMapping['name']['mapping']])
			->description($productData[$productMapping['description']['mapping']])
			->sku($productData[$productMapping['sku']['mapping']]);

		// Add reviews if they exist
		if (!empty($productData['reviews'])) {
			foreach ($productData['reviews'] as $reviewData) {
				$review = Schema::review()
					->author(Schema::person()->name($reviewData['author_name']))
					->reviewBody($reviewData['review_body'])
					->reviewRating(Schema::rating()
						->ratingValue($reviewData['review_rating'])
						->bestRating(5)
					)
					->datePublished($reviewData['review_date']);

				// Attach the review to the product schema
				$schema->review($review);
			}
		}

		return $schema;
	}
}

