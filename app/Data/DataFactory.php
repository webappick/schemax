<?php

namespace Schemax\App\Data;

class DataFactory {
	/**
	 * Get the data handler based on an object type.
	 *
	 * @param array  $mapping    The mapping for the object.
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 *
	 * @throws \Exception
	 */
	public static function getData( array $mapping, string $objectType, $object ): array {
		$dataHandler = self::getDataHandler( $objectType );

		return ( new DataManager( new $dataHandler() ) )->fetchData( $mapping, $object );

	}

	/**
	 * Get the data keys for the given object type.
	 *
	 * @param string $objectType The type of object (e.g., 'Product', 'Post').
	 *
	 * @return array The data keys for the object.
	 * @throws \Exception
	 */
	public static function getDataKeys( string $objectType ): array {

		$dataHandler = self::getDataHandler( $objectType );

		return ( new DataManager( new $dataHandler() ) )->dataKeys();
	}

	/**
	 * Get the data value for the given object type by key.
	 *
	 * @param string $objectType The type of object (e.g., 'product', 'article').
	 * @param string $key        The key for the data value.
	 * @param object $object     The object to get the value from.
	 *
	 * @return string The data handler for the object type.
	 * @throws \Exception
	 */
	public static function getValue( string $objectType, string $key, object $object ): string {

		$dataHandler = self::getDataHandler( $objectType );

		return ( new DataManager( new $dataHandler() ) )->getValue( $key, $object );
	}

	/**
	 * Get the data handler based on an object type.
	 *
	 * @param string $objectType The type of object (e.g., 'product', 'article').
	 *
	 * @return string The data handler for the object type.
	 * @throws \Exception
	 */
	public static function getDataHandler( string $objectType ): string {
		$nameSpace = 'Schemax\App\Data\\';
		switch ( $objectType ) {
			case 'product':
				return ProductData::class;

			case 'article':
				return PostData::class;

			// Add other object types as needed (e.g., Review, Category)
			default:
				throw new \RuntimeException( "No data handler found for object type: " . $objectType );
		}
	}
}
