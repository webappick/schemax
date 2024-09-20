<?php
/**
 * Settings
 *
 * This class is responsible for handling the settings of the Schemax plugin.
 */

namespace Schemax\App\Utils;

/**
 * Class Settings
 *
 * This class is responsible for handling the settings of the Schemax plugin.
 */
class Settings {
	// The name of the option where settings will be stored
	protected static $optionName = 'schemax_settings';

	// Default settings for the plugin
	protected static $defaultSettings = [
		'enable_schema'    => true,
		'schema_type'      => 'product',
		'auto_update'      => false,
		'default_language' => 'en',
	];

	/**
	 * Get all settings, merging user settings with the default ones.
	 *
	 * @return array The merged settings array.
	 */
	public static function getAllSettings(): array {
		// Get saved settings from the options table
		$savedSettings = get_option( self::$optionName, [] );

		// Merge with default settings
		return wp_parse_args( $savedSettings, self::$defaultSettings );
	}

	/**
	 * Get a single or multiple settings by key(s).
	 *
	 * @param string|array $keys The setting key(s) to retrieve.
	 *
	 * @return mixed The setting value(s) or null if not found.
	 */
	public static function getSettings( $keys ) {
		// Fetch all settings
		$allSettings = self::getAllSettings();

		// If a single key is requested
		if ( is_string( $keys ) ) {
			return $allSettings[ $keys ] ?? null;
		}

		// If multiple keys are requested, return an array of values
		if ( is_array( $keys ) ) {
			return array_intersect_key( $allSettings, array_flip( $keys ) );
		}

		return null;
	}

	/**
	 * Save or update settings by merging with existing ones.
	 *
	 * @param array $newSettings The new settings to be saved.
	 *
	 * @return bool True if saved successfully, false otherwise.
	 */
	public static function saveSettings( array $newSettings ): bool {
		// Get current saved settings
		$currentSettings = self::getAllSettings();

		// Merge new settings with the existing ones
		$mergedSettings = wp_parse_args( $newSettings, $currentSettings );

		// Save the merged settings to the options table
		return update_option( self::$optionName, $mergedSettings );
	}

	/**
	 * Update specific settings without overriding others.
	 *
	 * @param array $updatedSettings The settings to update (key => value).
	 *
	 * @return bool True if updated successfully, false otherwise.
	 */
	public static function updateSettings( array $updatedSettings ): bool {
		// Fetch existing settings
		$existingSettings = self::getAllSettings();

		// Merge the updated settings with the existing ones
		$newSettings = array_merge( $existingSettings, $updatedSettings );

		// Save the new settings
		return update_option( self::$optionName, $newSettings );
	}

	/**
	 * Reset settings to default values.
	 *
	 * @return bool True if reset successfully, false otherwise.
	 */
	public static function resetSettings(): bool {
		// Save the default settings
		return update_option( self::$optionName, self::$defaultSettings );
	}
}
