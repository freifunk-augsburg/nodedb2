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
 * Test case for class Comuno\Nodedb2\Controller\IfaceController.
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class IfaceControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Comuno\Nodedb2\Controller\IfaceController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Comuno\\Nodedb2\\Controller\\IfaceController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllIfacesFromRepositoryAndAssignsThemToView() {

		$allIfaces = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('findAll'), array(), '', FALSE);
		$ifaceRepository->expects($this->once())->method('findAll')->will($this->returnValue($allIfaces));
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('ifaces', $allIfaces);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenIfaceToView() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('iface', $iface);

		$this->subject->showAction($iface);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenIfaceToView() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newIface', $iface);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($iface);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenIfaceToIfaceRepository() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('add'), array(), '', FALSE);
		$ifaceRepository->expects($this->once())->method('add')->with($iface);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($iface);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($iface);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($iface);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenIfaceToView() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('iface', $iface);

		$this->subject->editAction($iface);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenIfaceInIfaceRepository() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('update'), array(), '', FALSE);
		$ifaceRepository->expects($this->once())->method('update')->with($iface);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($iface);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($iface);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($iface);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenIfaceFromIfaceRepository() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('remove'), array(), '', FALSE);
		$ifaceRepository->expects($this->once())->method('remove')->with($iface);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($iface);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($iface);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$iface = new \Comuno\Nodedb2\Domain\Model\Iface();

		$ifaceRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\IfaceRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'ifaceRepository', $ifaceRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($iface);
	}
}
