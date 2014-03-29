<?php
namespace Comuno\Nodedb2\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Manuel Munz <freifunk@somakoma.de>, comuno.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Additional network blocks a node might have.
 */
class Network extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * Network in CIDR notation
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $network = '';

	/**
	 * Returns the network
	 *
	 * @return string $network
	 */
	public function getNetwork() {
		return $this->network;
	}

	/**
	 * Sets the network
	 *
	 * @param string $network
	 * @return void
	 */
	public function setNetwork($network) {
		$this->network = $network;
	}

}