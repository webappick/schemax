<?php
/**
 * DataAbstract
 *
 * This class is responsible for managing the data for the schema.
 *
 * @package    Schemax
 * @subpackage Schemax\App\Data
 */

namespace Schemax\App\Data;


/**
 * Class DataAbstract
 *
 * @package    Schemax;
 * @subpackage Schemax\App\Data;
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
abstract class DataAbstract implements DataInterface { //phpcs:ignore

	/**
	 * Prepare the data for the given object.
	 *
	 * @param array  $array The array of mappings.
	 * @param object $post  The post object.
	 *
	 * @return array The prepared data.
	 */
	public function prepareData( array $array, object $post ): array {
		$mapping_values = [];

		foreach ( $array as $key => $value ) {
			// If the value is an array, recursively search it
			if ( is_array( $value ) ) {
				// Check if the 'mapping' key exists and add its value
				if ( isset( $value['mapping'] ) ) {
					$mapping_values[ $value['mapping'] ] = $this->getValue( $value['mapping'], $post );
				}

				// Recursively search nested arrays and append the result directly to the current array
				$nested_values = $this->prepareData( $value, $post );
				foreach ( $nested_values as $nested_value ) {
					$mapping_values[ $value['mapping'] ] = $this->getValue( $nested_value, $post );
				}
			}
		}

		return $mapping_values;
	}

	/**
	 * Prepare the value for the given key.
	 *
	 * @param string $key    The key to prepare.
	 * @param object $object The object.
	 *
	 * @return string The prepared value.
	 */
	public function getValue( string $key, object $object ): string {
		$dataType  = explode( '_', $key );
		$dataClass = 'Schemax\App\Data\\'.ucfirst( $dataType[0] ) . 'Data';

		// Check if the data class exists
		if ( class_exists( $dataClass ) ) {
			$data   = new $dataClass;
			$method = 'get_' . $key;

			// Check if the method exists
			if ( method_exists( $data, $method ) ) {
				return $data->$method( $object );
			}
		}

		// If the method does not exist, return an empty string
		return '';
	}
}
