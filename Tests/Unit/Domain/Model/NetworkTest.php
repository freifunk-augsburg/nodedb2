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
 * Test case for class \Comuno\Nodedb2\Domain\Model\Network.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class NetworkTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Comuno\Nodedb2\Domain\Model\Network
	 */
	protected $subject;

	public function setUp() {
		$this->subject = new \Comuno\Nodedb2\Domain\Model\Network();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNetworkReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNetwork()
		);
	}

	/**
	 * @test
	 */
	public function setNetworkForStringSetsNetwork() {
		$this->subject->setNetwork('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'network',
			$this->subject
		);
	}
}
