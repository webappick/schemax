<?php

namespace Schemax\App\Services;

use Schemax\App\Data\DataFactory;
use Schemax\App\Mapping\MappingFactory;
use Spatie\SchemaOrg\Schema;

/**
 * Class SchemaGenerationService
 */
class SchemaGenerationService {

	private $mappingFactory;

	public function __construct() {
		$this->mappingFactory = new MappingFactory();
	}

	/**
	 * Generate the schema for a given object type.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 * @param mixed  $object   The ID of the object to generate the schema for.
	 *
	 * @return \Spatie\SchemaOrg\BaseType|null
	 * @throws \Exception
	 */
	public function generateSchema( string $objectType, $object ): ?\Spatie\SchemaOrg\BaseType {
		// Fetch data using the DataFactory based on the object type.
		$data = DataFactory::getData( $objectType, $object );

		if ( empty( $data ) ) {
			throw new \RuntimeException( "No data found for the object type: " . $objectType );
		}

		// Fetch mappings from the MappingFactory.
		$mapping = $this->mappingFactory->getMapping( $objectType );

		if ( empty( $mapping ) ) {
			throw new \RuntimeException( "No mapping found for the object type: " . $objectType );
		}

		// Initialize the schema dynamically
		$schema = $this->initializeSchema( $objectType, $data, $mapping );

		// Process reviews or other complex attributes if applicable
		if ( ! empty( $data['reviews'] ) ) {
			$this->addReviewsToSchema( $schema, $data['reviews'] );
		}

		return $schema;
	}

	/**
	 * Initialize the schema dynamically based on mappings.
	 *
	 * @param string $objectType The type of object.
	 * @param array  $data       The data array for the object.
	 * @param array  $mapping    The mapping array for the object.
	 *
	 * @return \Spatie\SchemaOrg\BaseType
	 * @throws \Exception
	 */
	protected function initializeSchema( string $objectType, array $data, array $mapping ): \Spatie\SchemaOrg\BaseType {
		// Create a base schema object depending on the object type
		$schema = $this->getSchemaObject( $objectType );

		// Loop through the mapping to dynamically set schema properties
		foreach ( $mapping as $property => $mapConfig ) {
			$dataKey = $mapConfig['mapping'] ?? null;

			if ( ! empty( $dataKey ) && isset( $data[ $dataKey ] ) ) {
				// Dynamically call the schema method
				$method = $property;  // e.g., 'name', 'description', etc.

				if ( method_exists( $schema, $method ) ) {
					// Dynamically call the method with the data value
					$schema->$method( $data[ $dataKey ] );
				}
			}
		}

		return $schema;
	}

	/**
	 * Get the schema object based on an object type.
	 *
	 * @param string $objectType
	 *
	 * @return \Spatie\SchemaOrg\BaseType
	 * @throws \Exception
	 */
	protected function getSchemaObject( string $objectType ): \Spatie\SchemaOrg\BaseType {
		switch ( $objectType ) {
			case 'Product':
				return Schema::product();
			case 'Article':
				return Schema::article();
			// Add other cases for different object types if needed
			default:
				throw new \RuntimeException( "Unsupported object type: " . $objectType );
		}
	}

	/**
	 * Add reviews to the schema if they exist.
	 *
	 * @param \Spatie\SchemaOrg\BaseType $schema  The schema object.
	 * @param array                      $reviews Array of reviews to add to the schema.
	 */
	protected function addReviewsToSchema( $schema, array $reviews ): void {
		foreach ( $reviews as $reviewData ) {
			$review = Schema::review()
			                ->author( Schema::person()->name( $reviewData['review_author_name'] ?? '' ) )
			                ->reviewBody( $reviewData['review_body'] ?? '' )
			                ->reviewRating( Schema::rating()
			                                      ->ratingValue( $reviewData['review_rating'] ?? null )
			                                      ->bestRating( 5 )
			                )
			                ->datePublished( $reviewData['review_date'] ?? null );

			// Attach the review to the schema
			$schema->review( $review );
		}
	}
}

