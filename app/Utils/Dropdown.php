<?php

namespace Schemax\App\Utils;


/**
 * Class Dropdown
 *
 * @package    Schemax
 * @subpackage Schemax\App\Utils
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class Dropdown {

	public static function SchemaTypes(  ): array {
		return [
			'article' => 'Article',
			'product' => 'Product',
		];
	}

}
