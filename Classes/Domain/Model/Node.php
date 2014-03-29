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
 * Node
 */
class Node extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * A unique hostname.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $hostName = '';

	/**
	 * The location of this node (street, city)
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $location = '';

	/**
	 * latitude
	 *
	 * @var float
	 */
	protected $latitude = 0.0;

	/**
	 * longitude
	 *
	 * @var float
	 */
	protected $longitude = 0.0;

	/**
	 * Timestamp when the node was last seen.
	 *
	 * @var \DateTime
	 */
	protected $lastSeen;

	/**
	 * Admins of this node
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser>
	 */
	protected $admins;

	/**
	 * Admins of this node
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Iface>
	 */
	protected $interfaces;

	/**
	 * Admins of this node
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Network>
	 */
	protected $networks;

	/**
	 * Admins of this node
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Model>
	 */
	protected $model;

	/**
	 * The owner of this node. This is usually the one who registered it.
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $createdBy;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->admins = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->interfaces = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->networks = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->model = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the hostName
	 *
	 * @return string $hostName
	 */
	public function getHostName() {
		return $this->hostName;
	}

	/**
	 * Sets the hostName
	 *
	 * @param string $hostName
	 * @return void
	 */
	public function setHostName($hostName) {
		$this->hostName = $hostName;
	}

	/**
	 * Returns the location
	 *
	 * @return string $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param string $location
	 * @return void
	 */
	public function setLocation($location) {
		$this->location = $location;
	}

	/**
	 * Returns the latitude
	 *
	 * @return float $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param float $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return float $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param float $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * Returns the lastSeen
	 *
	 * @return \DateTime $lastSeen
	 */
	public function getLastSeen() {
		return $this->lastSeen;
	}

	/**
	 * Sets the lastSeen
	 *
	 * @param \DateTime $lastSeen
	 * @return void
	 */
	public function setLastSeen(\DateTime $lastSeen) {
		$this->lastSeen = $lastSeen;
	}

	/**
	 * Adds a FrontendUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $admin
	 * @return void
	 */
	public function addAdmin(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $admin) {
		$this->admins->attach($admin);
	}

	/**
	 * Removes a FrontendUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $adminToRemove The FrontendUser to be removed
	 * @return void
	 */
	public function removeAdmin(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $adminToRemove) {
		$this->admins->detach($adminToRemove);
	}

	/**
	 * Returns the admins
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $admins
	 */
	public function getAdmins() {
		return $this->admins;
	}

	/**
	 * Sets the admins
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUser> $admins
	 * @return void
	 */
	public function setAdmins(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $admins) {
		$this->admins = $admins;
	}

	/**
	 * Adds a Iface
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $interface
	 * @return void
	 */
	public function addInterface(\Comuno\Nodedb2\Domain\Model\Iface $interface) {
		$this->interfaces->attach($interface);
	}

	/**
	 * Removes a Iface
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $interfaceToRemove The Iface to be removed
	 * @return void
	 */
	public function removeInterface(\Comuno\Nodedb2\Domain\Model\Iface $interfaceToRemove) {
		$this->interfaces->detach($interfaceToRemove);
	}

	/**
	 * Returns the interfaces
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Iface> $interfaces
	 */
	public function getInterfaces() {
		return $this->interfaces;
	}

	/**
	 * Sets the interfaces
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Iface> $interfaces
	 * @return void
	 */
	public function setInterfaces(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $interfaces) {
		$this->interfaces = $interfaces;
	}

	/**
	 * Adds a Network
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Network $network
	 * @return void
	 */
	public function addNetwork(\Comuno\Nodedb2\Domain\Model\Network $network) {
		$this->networks->attach($network);
	}

	/**
	 * Removes a Network
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Network $networkToRemove The Network to be removed
	 * @return void
	 */
	public function removeNetwork(\Comuno\Nodedb2\Domain\Model\Network $networkToRemove) {
		$this->networks->detach($networkToRemove);
	}

	/**
	 * Returns the networks
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Network> $networks
	 */
	public function getNetworks() {
		return $this->networks;
	}

	/**
	 * Sets the networks
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Network> $networks
	 * @return void
	 */
	public function setNetworks(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $networks) {
		$this->networks = $networks;
	}

	/**
	 * Adds a Model
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $model
	 * @return void
	 */
	public function addModel(\Comuno\Nodedb2\Domain\Model\Model $model) {
		$this->model->attach($model);
	}

	/**
	 * Removes a Model
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $modelToRemove The Model to be removed
	 * @return void
	 */
	public function removeModel(\Comuno\Nodedb2\Domain\Model\Model $modelToRemove) {
		$this->model->detach($modelToRemove);
	}

	/**
	 * Returns the model
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Model> $model
	 */
	public function getModel() {
		return $this->model;
	}

	/**
	 * Sets the model
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Comuno\Nodedb2\Domain\Model\Model> $model
	 * @return void
	 */
	public function setModel(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $model) {
		$this->model = $model;
	}

	/**
	 * Returns the createdBy
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $createdBy
	 */
	public function getCreatedBy() {
		return $this->createdBy;
	}

	/**
	 * Sets the createdBy
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $createdBy
	 * @return void
	 */
	public function setCreatedBy(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $createdBy) {
		$this->createdBy = $createdBy;
	}

}