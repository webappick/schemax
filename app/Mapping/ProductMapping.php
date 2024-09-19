<?php

namespace WebAppick\WPListInfo\Middleware\Mapping;


/**
 * Class ProductMapping
 *
 * @package    CTXFeed
 * @subpackage WebAppick\WPListInfo\Middleware\Mapping
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
namespace MyPlugin\Mapping;

class ProductMapping extends AbstractMapping
{
	public function __construct()
	{
		$defaultMappings = [
			'name' => ['label' => 'Product Name', 'mapping' => 'product_name'],
			'description' => ['label' => 'Product Description', 'mapping' => 'product_description'],
		];
		
		parent::__construct($defaultMappings);
	}
}
