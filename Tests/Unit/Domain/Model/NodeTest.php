<?php

namespace \Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Manuel Munz <freifunk@somakoma.de>, comuno.net
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Comuno\Nodedb2\Domain\Model\Node.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class NodeTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Comuno\Nodedb2\Domain\Model\Node
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Comuno\Nodedb2\Domain\Model\Node();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getHostNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHostName()
		);
	}

	/**
	 * @test
	 */
	public function setHostNameForStringSetsHostName() {
		$this->subject->setHostName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hostName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLocation()
		);
	}

	/**
	 * @test
	 */
	public function setLocationForStringSetsLocation() {
		$this->subject->setLocation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'location',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLatitudeReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getLatitude()
		);
	}

	/**
	 * @test
	 */
	public function setLatitudeForFloatSetsLatitude() {
		$this->subject->setLatitude(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'latitude',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getLongitudeReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getLongitude()
		);
	}

	/**
	 * @test
	 */
	public function setLongitudeForFloatSetsLongitude() {
		$this->subject->setLongitude(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'longitude',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getLastSeenReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getLastSeen()
		);
	}

	/**
	 * @test
	 */
	public function setLastSeenForDateTimeSetsLastSeen() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setLastSeen($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'lastSeen',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAdminsReturnsInitialValueForFrontendUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAdmins()
		);
	}

	/**
	 * @test
	 */
	public function setAdminsForObjectStorageContainingFrontendUserSetsAdmins() {
		$admin = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
		$objectStorageHoldingExactlyOneAdmins = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAdmins->attach($admin);
		$this->subject->setAdmins($objectStorageHoldingExactlyOneAdmins);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAdmins,
			'admins',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAdminToObjectStorageHoldingAdmins() {
		$admin = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
		$adminsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$adminsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($admin));
		$this->inject($this->subject, 'admins', $adminsObjectStorageMock);

		$this->subject->addAdmin($admin);
	}

	/**
	 * @test
	 */
	public function removeAdminFromObjectStorageHoldingAdmins() {
		$admin = new \TYPO3\CMS\Extbase\Domain\Model\FrontendUser();
		$adminsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$adminsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($admin));
		$this->inject($this->subject, 'admins', $adminsObjectStorageMock);

		$this->subject->removeAdmin($admin);

	}

	/**
	 * @test
	 */
	public function getInterfacesReturnsInitialValueForIface() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getInterfaces()
		);
	}

	/**
	 * @test
	 */
	public function setInterfacesForObjectStorageContainingIfaceSetsInterfaces() {
		$interface = new \Comuno\Nodedb2\Domain\Model\Iface();
		$objectStorageHoldingExactlyOneInterfaces = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneInterfaces->attach($interface);
		$this->subject->setInterfaces($objectStorageHoldingExactlyOneInterfaces);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneInterfaces,
			'interfaces',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addInterfaceToObjectStorageHoldingInterfaces() {
		$interface = new \Comuno\Nodedb2\Domain\Model\Iface();
		$interfacesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$interfacesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($interface));
		$this->inject($this->subject, 'interfaces', $interfacesObjectStorageMock);

		$this->subject->addInterface($interface);
	}

	/**
	 * @test
	 */
	public function removeInterfaceFromObjectStorageHoldingInterfaces() {
		$interface = new \Comuno\Nodedb2\Domain\Model\Iface();
		$interfacesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$interfacesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($interface));
		$this->inject($this->subject, 'interfaces', $interfacesObjectStorageMock);

		$this->subject->removeInterface($interface);

	}

	/**
	 * @test
	 */
	public function getNetworksReturnsInitialValueForNetwork() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getNetworks()
		);
	}

	/**
	 * @test
	 */
	public function setNetworksForObjectStorageContainingNetworkSetsNetworks() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();
		$objectStorageHoldingExactlyOneNetworks = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneNetworks->attach($network);
		$this->subject->setNetworks($objectStorageHoldingExactlyOneNetworks);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneNetworks,
			'networks',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addNetworkToObjectStorageHoldingNetworks() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();
		$networksObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$networksObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($network));
		$this->inject($this->subject, 'networks', $networksObjectStorageMock);

		$this->subject->addNetwork($network);
	}

	/**
	 * @test
	 */
	public function removeNetworkFromObjectStorageHoldingNetworks() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();
		$networksObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$networksObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($network));
		$this->inject($this->subject, 'networks', $networksObjectStorageMock);

		$this->subject->removeNetwork($network);

	}

	/**
	 * @test
	 */
	public function getModelReturnsInitialValueForModel() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getModel()
		);
	}

	/**
	 * @test
	 */
	public function setModelForObjectStorageContainingModelSetsModel() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();
		$objectStorageHoldingExactlyOneModel = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneModel->attach($model);
		$this->subject->setModel($objectStorageHoldingExactlyOneModel);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneModel,
			'model',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addModelToObjectStorageHoldingModel() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();
		$modelObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$modelObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($model));
		$this->inject($this->subject, 'model', $modelObjectStorageMock);

		$this->subject->addModel($model);
	}

	/**
	 * @test
	 */
	public function removeModelFromObjectStorageHoldingModel() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();
		$modelObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$modelObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($model));
		$this->inject($this->subject, 'model', $modelObjectStorageMock);

		$this->subject->removeModel($model);

	}

	/**
	 * @test
	 */
	public function getCreatedByReturnsInitialValueForFrontendUser() {	}

	/**
	 * @test
	 */
	public function setCreatedByForFrontendUserSetsCreatedBy() {	}
}
