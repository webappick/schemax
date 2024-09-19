<?php

namespace WebAppick\WPListInfo\Strategies;


use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class ServiceStrategy
 *
 * @package CTXFeed
 * @subpackage WebAppick\WPListInfo\Strategies
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 *@license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category MyCategory
 */
class ServiceStrategy {
	private $info;
	
	public function __construct(ServiceInterface $info) {
		$this->info = $info;
	}
	
	public function getList($args = array()) {
		return $this->info->getList($args);
	}
	
	public function getInfo($key, $idObject) {
		return $this->info->getInfo($key, $idObject);
	}
	
	public function getKeys() {
		return $this->info->getKeys();
	}
}