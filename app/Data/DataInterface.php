<?php

namespace Schemax\App\Data;

use WC_DateTime;

/**
 * Class ServiceInterface
 *
 * @package WebAppick\WPListInfo\Interfaces
 * @subpackage WebAppick\WPListInfo\Interfaces
 */
interface DataInterface {

	/**
	 * Fetch data for the given object by ID.
	 *
	 * @param object $object The ID of the object to fetch data for.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData( object $object): array;


	/**
	 * Retrieve a list of keys for the entity.
	 *
	 * @return array An array of keys for the entity.
	 */
	public function dataKeys(): array;

}
