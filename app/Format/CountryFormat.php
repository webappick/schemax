<?php

namespace WebAppick\WPListInfo\Format;

use WebAppick\WPListInfo\Abstracts\FormattingAbstract;

/**
 * Class CountryFormat
 *
 * @package WPListInfo
 * @subpackage WebAppick\WPListInfo\Format
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Library
 */
class CountryFormat extends FormattingAbstract {
	
	/**
	 * Format the list of countries and states based on the provided format.
     *
	 * @param array  $data List of countries with their states or states of a country
	 *                     Example: [
	 *                        ['id' => 'US', 'name' => 'United States', 'states' => ['AL' => 'Alabama', 'NY' => 'New York']],
	 *                        ['id' => 'CA', 'name' => 'Canada', 'states' => ['AB' => 'Alberta', 'BC' => 'British Columbia']]
	 *                     ]
	 *
	 * @param string $format Output format. Default is 'country'
	 *                       Example formats:
	 *                       'country': 'United States'
	 *                       'country, state': 'United States, Alabama'
	 *                       'code_country country': 'US United States'
	 *                       'code_country country state': 'US United States, Alabama'
	 *                       'code_country:code_state state - country ': 'US:AL Alabama - United States'
	 *
	 *                       Available variables: code_country, code_state, country, state
	 *                       You can use any of the available variables in the format string to get the desired output.
	 * @return array Formatted list of countries and states
	 *               Examples:
	 *               [ ['id' => 'US', 'name' => 'United States'] ] if no states are present or state not exist in format
	 *               [ ['id' => 'US:NY', 'name' => 'New York, United States'] ] if state is present in format
	 */
	public function format( $data, $format) {
		$formattedList = [];
		
		// If there is no data, return an empty list
		if ( empty( $data ) ) {
			return $formattedList;
		}
		
		// Loop through the list of countries and their states
		foreach ( $data as $country ) {
			$countryCode = $country['id'];           // Country code (e.g., 'US')
			$countryName = $country['name'];         // Country name (e.g., 'United States')
			$states      = $country['states'] ?? [];      // States array (e.g., ['AL' => 'Alabama'])
		
			// If there are no states, format the country only
			if ( strpos( $format, 'state' ) === false ) {
				$formattedList[] = [
					'id'   => $countryCode,
					'name' => $this->applyFormat( $format, $countryCode, $countryName, null, null ),
				];
			} else {
				// Skip countries with no states if the format includes states
				if ( empty( $states ) ) {
					continue;
				}

				// Format each state in the country
				foreach ( $states as $stateCode => $stateName ) {
					$formattedList[] = [
						'id'   => $this->applyFormat( 'code_country:code_state', $countryCode, $countryName, $stateCode, $stateName ),
						'name' => $this->applyFormat( $format, $countryCode, $countryName, $stateCode, $stateName ),
					];
				}
			}
		}
		
		return $formattedList;
	}
	
	/**
	 * Apply the given format to the provided country and state data.
	 *
	 * @param string      $format       The format string (e.g., 'code_country:code_state state - country').
	 * @param string      $countryCode  The country code (e.g., 'US').
	 * @param string      $countryName  The country name (e.g., 'United States').
	 * @param string|null $stateCode The state code (e.g., 'AL') or null if no state.
	 * @param string|null $stateName The state name (e.g., 'Alabama') or null if no state.
     * @return string The formatted string based on the provided format.
	 */
	protected function applyFormat( $format, $countryCode, $countryName, $stateCode, $stateName ) {
		// Replace variables in the format string with actual values
		$formatted = $format;
		$formatted = str_replace(
            array( 'code_country', 'country', 'code_state', 'state' ),
            [
				$countryCode,
				$countryName,
				$stateCode ?? '',
				$stateName ?? '',
			],
            $formatted
            );
		
		// Clean up any leftover formatting (e.g., if state-related placeholders are used but no state is present)
		$formatted = trim( preg_replace( '/\s*,\s*/', ', ', $formatted ) ); // Clean up extra commas
		$formatted = preg_replace( '/\s+/', ' ', $formatted ); // Remove extra spaces
		// Remove trailing commas
		// Return the formatted string exactly as specified in the format string
		return rtrim( $formatted, ',' );
	}

}
