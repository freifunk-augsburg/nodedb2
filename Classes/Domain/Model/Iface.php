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
 * Any node can have one or more interfaces.
 */
class Iface extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * channel
	 *
	 * @var string
	 */
	protected $channel = '';

	/**
	 * ip4addr
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $ip4addr = '';

	/**
	 * ip6addr
	 *
	 * @var string
	 */
	protected $ip6addr = '';

	/**
	 * Returns the channel
	 *
	 * @return string $channel
	 */
	public function getChannel() {
		return $this->channel;
	}

	/**
	 * Sets the channel
	 *
	 * @param string $channel
	 * @return void
	 */
	public function setChannel($channel) {
		$this->channel = $channel;
	}

	/**
	 * Returns the ip4addr
	 *
	 * @return string $ip4addr
	 */
	public function getIp4addr() {
		return $this->ip4addr;
	}

	/**
	 * Sets the ip4addr
	 *
	 * @param string $ip4addr
	 * @return void
	 */
	public function setIp4addr($ip4addr) {
		$this->ip4addr = $ip4addr;
	}

	/**
	 * Returns the ip6addr
	 *
	 * @return string $ip6addr
	 */
	public function getIp6addr() {
		return $this->ip6addr;
	}

	/**
	 * Sets the ip6addr
	 *
	 * @param string $ip6addr
	 * @return void
	 */
	public function setIp6addr($ip6addr) {
		$this->ip6addr = $ip6addr;
	}

}