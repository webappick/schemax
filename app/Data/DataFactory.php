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
	public static function getData(string $objectType, $object ): array {
		switch ($objectType) {
			case 'Product':
				return (new DataManager( new ProductData() ))->fetchData( $object );

			case 'Article':
				return (new DataManager( new PostData() ))->fetchData( $object );

			// Add other object types as needed (e.g., Review, Category)
			default:
				throw new \RuntimeException( "No data handler found for object type: " . $objectType);
		}
	}
}
