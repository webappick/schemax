<?php

namespace Schemax\App\Schema;


use Schemax\App\Schema\AbstractSchema;

/**
 * Class OffersSchema
 *
 * @package    CTXFeed
 * @subpackage Schemax\App\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
class OffersSchema extends AbstractSchema {
	protected $schemaType = 'Offers';
	public function getDefaultMappings(): array {
		return [
			'lowPrice' => ['mapping' => 'offers_low_price'],
			'highPrice' => ['mapping' => 'offers_high_price'],
			'offerCount' => ['mapping' => 'offers_count'],
			'availability' => ['mapping' => 'offers_availability'],
			'condition' => ['mapping' => 'offers_condition'],
		];
	}
}
