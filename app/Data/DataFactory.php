<?php
namespace Schemax\App\Data;

class DataFactory
{
	/**
	 * Get the data handler based on an object type.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 *
	 * @throws \Exception
	 */
	public function getData(string $objectType, $idObject ): array {
		switch ($objectType) {
			case 'Product':
				return (new DataManager( new ProductData() ))->fetchData( $idObject );

			case 'Post':
				return (new DataManager( new PostData() ))->fetchData( $idObject );

			// Add other object types as needed (e.g., Review, Category)
			default:
				throw new \RuntimeException( "No data handler found for object type: " . $objectType);
		}
	}
}
