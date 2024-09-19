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
	 * Retrieve a list of entities (posts, products, users, etc.).
	 *
	 * @param array $args The arguments for the list of entities.
	 * @return array An array of entities.
	 */
	public function getList( $args = array() );

	/**
	 * Retrieve information about a specific entity (post, product, user, etc.).
	 *  @param string|null $key The key for the entity.
	 * @param int|object  $idObject The ID or Object for the entity.
     * @return array|bool|float|int|string|WC_DateTime|null An array of all or single information about the entity.
	 */
	public function getInfo( $key, $idObject);

	/**
	 * Retrieve a list of keys for the entity.
	 *
	 * @return array An array of keys for the entity.
	 */
	public function getKeys();

}
