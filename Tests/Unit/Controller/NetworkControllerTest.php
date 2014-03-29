<?php
namespace \Tests\Unit\Controller;
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
 * Test case for class Comuno\Nodedb2\Controller\NetworkController.
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class NetworkControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Comuno\Nodedb2\Controller\NetworkController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Comuno\\Nodedb2\\Controller\\NetworkController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllNetworksFromRepositoryAndAssignsThemToView() {

		$allNetworks = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('findAll'), array(), '', FALSE);
		$networkRepository->expects($this->once())->method('findAll')->will($this->returnValue($allNetworks));
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('networks', $allNetworks);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenNetworkToView() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('network', $network);

		$this->subject->showAction($network);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenNetworkToView() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newNetwork', $network);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($network);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenNetworkToNetworkRepository() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('add'), array(), '', FALSE);
		$networkRepository->expects($this->once())->method('add')->with($network);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($network);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($network);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($network);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenNetworkToView() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('network', $network);

		$this->subject->editAction($network);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenNetworkInNetworkRepository() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('update'), array(), '', FALSE);
		$networkRepository->expects($this->once())->method('update')->with($network);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($network);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($network);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($network);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenNetworkFromNetworkRepository() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('remove'), array(), '', FALSE);
		$networkRepository->expects($this->once())->method('remove')->with($network);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($network);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($network);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$network = new \Comuno\Nodedb2\Domain\Model\Network();

		$networkRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NetworkRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'networkRepository', $networkRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($network);
	}
}
