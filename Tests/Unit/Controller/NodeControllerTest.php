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
 * Test case for class Comuno\Nodedb2\Controller\NodeController.
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class NodeControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Comuno\Nodedb2\Controller\NodeController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Comuno\\Nodedb2\\Controller\\NodeController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllNodesFromRepositoryAndAssignsThemToView() {

		$allNodes = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('findAll'), array(), '', FALSE);
		$nodeRepository->expects($this->once())->method('findAll')->will($this->returnValue($allNodes));
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('nodes', $allNodes);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenNodeToView() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('node', $node);

		$this->subject->showAction($node);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenNodeToView() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newNode', $node);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($node);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenNodeToNodeRepository() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('add'), array(), '', FALSE);
		$nodeRepository->expects($this->once())->method('add')->with($node);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($node);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($node);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($node);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenNodeToView() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('node', $node);

		$this->subject->editAction($node);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenNodeInNodeRepository() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('update'), array(), '', FALSE);
		$nodeRepository->expects($this->once())->method('update')->with($node);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($node);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($node);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($node);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenNodeFromNodeRepository() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('remove'), array(), '', FALSE);
		$nodeRepository->expects($this->once())->method('remove')->with($node);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($node);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($node);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$node = new \Comuno\Nodedb2\Domain\Model\Node();

		$nodeRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\NodeRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'nodeRepository', $nodeRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($node);
	}
}
