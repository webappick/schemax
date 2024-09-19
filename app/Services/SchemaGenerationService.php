<?php

namespace Schemax\App\Services;

use Spatie\SchemaOrg\BaseType;
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
	 * @return BaseType
	 */
	public function generateSchema($idObject)
	{
		// Fetch the product data from Data Library
		$productData = [
			'product_name' => 'Product Name',
			'product_description' => 'Product Description',
			'product_sku' => 'Product SKU',
			'product_reviews' => [
				[
					'review_author_name' => 'John Doe',
					'review_body' => 'This is a great product!',
					'review_rating' => 5,
					'review_date' => '2021-01-01'
				],
				[
					'review_author_name' => 'Jane Doe',
					'review_body' => 'This product is terrible!',
					'review_rating' => 1,
					'review_date' => '2021-01-02'
				]
			]
		];

		// Get the user-defined or default mapping for Product
		$productMapping = $this->mappingManager->getMapping('Product');

		// Initialize the product schema using Spatie Schema.org
		$schema = Schema::product()
			->name($productData[$productMapping['name']['mapping']])
			->description($productData[$productMapping['description']['mapping']])
			->sku($productData[$productMapping['sku']['mapping']]);

		// Add reviews if they exist
		if (!empty($productData['product_reviews'])) {
			foreach ($productData['product_reviews'] as $reviewData) {
				$review = Schema::review()
					->author(Schema::person()->name($reviewData['review_author_name']))
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

