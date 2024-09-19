<?php

namespace Schemax\App\Data;

use WC_Product;
/**
 * Class AbstractData
 *
 * @package Schemax;
 * @subpackage Schemax\App\Data;
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Library
 */
abstract class AbstractData {

	/**
	 * Check if the ID or Object is valid.
	 *
	 * @param int|object  $idObject The ID or Object for the entity.
	 * @return bool
	 */
	protected function validate( $idObject ): bool
	{
		if ( is_numeric( $idObject ) ) {
			return $idObject > 0;
		}

		return is_object( $idObject );
	}

	/**
	 * Retrieve the object for the entity.
	 *
	 * @param int|object  $id The ID or Object for the entity.
	 * @param string $objectType The type of object.
	 * @return object The object for the entity.
	 */
	protected function getObject($id, string $objectType) {
		if ( 'product'=== $objectType ) {
			if ($id instanceof WC_Product) {
				return $id;
			}
			return wc_get_product($id);
		}elseif ( 'post' === $objectType ) {
			return get_post( $id );
		}

		return $id;

	}

	// Get the parent object
	public function getParentObject( $object, $objectType ) {
		if ( 'product' === $objectType && $object->get_parent_id() ) {
			return wc_get_product( $object->get_parent_id() );
		}

		return $object;
	}

}
