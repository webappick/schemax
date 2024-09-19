<?php
/**
 * Class DataManager
 *
 * @package    Schemax
 * @subpackage Schemax\App\Data
 */

namespace Schemax\App\Data;

use Schemax\App\Data\DataInterface;
/**
 * Class DataManager
 *
 * @package    Schemax
 * @subpackage Schemax\App\Data
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   Library
 */
class DataManager
{
	/**
	 * @var DataInterface $data The data handler to use.
	 */
	protected $data;

	/**
	 * DataManager constructor.
	 *
	 * @param \Schemax\App\Data\DataInterface $data The data handler to use.
	 */
	public function __construct(DataInterface $data)
	{
		$this->data = $data;
	}

	/**
	 * Get data for the given object type and ID.
	 *
	 * @param mixed $idObject The ID of the object to retrieve data for.
	 * @return array The data retrieved for the object.
	 * @throws \Exception
	 */
	public function fetchData($idObject): array
	{
		// Get the appropriate data handler from the factory
		// to Use the handler to retrieve the data
		return $this->data->fetchData($idObject);
	}
}
