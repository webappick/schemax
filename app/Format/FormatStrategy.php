<?php

namespace WebAppick\WPListInfo\Strategies;


use WebAppick\WPListInfo\Abstracts\FormattingAbstract;

/**
 * Class FormatStrategy
 *
 * @package CTXFeed
 * @subpackage WebAppick\WPListInfo\Strategies
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 *@license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category MyCategory
 */
class FormatStrategy {
	private $format;
	
	public function __construct(FormattingAbstract $format) {
		$this->format = $format;
	}
	
	public function format($data, $format, $output) {
		return $this->format->format($data, $format, $output);
	}
	

}