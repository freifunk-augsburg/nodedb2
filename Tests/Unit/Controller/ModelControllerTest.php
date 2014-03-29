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
 * Test case for class Comuno\Nodedb2\Controller\ModelController.
 *
 * @author Manuel Munz <freifunk@somakoma.de>
 */
class ModelControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var Comuno\Nodedb2\Controller\ModelController
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMock('Comuno\\Nodedb2\\Controller\\ModelController', array('redirect', 'forward'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllModelsFromRepositoryAndAssignsThemToView() {

		$allModels = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('findAll'), array(), '', FALSE);
		$modelRepository->expects($this->once())->method('findAll')->will($this->returnValue($allModels));
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('models', $allModels);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenModelToView() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('model', $model);

		$this->subject->showAction($model);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenModelToView() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newModel', $model);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($model);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenModelToModelRepository() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('add'), array(), '', FALSE);
		$modelRepository->expects($this->once())->method('add')->with($model);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($model);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->createAction($model);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($model);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenModelToView() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('model', $model);

		$this->subject->editAction($model);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenModelInModelRepository() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('update'), array(), '', FALSE);
		$modelRepository->expects($this->once())->method('update')->with($model);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($model);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->updateAction($model);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($model);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenModelFromModelRepository() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('remove'), array(), '', FALSE);
		$modelRepository->expects($this->once())->method('remove')->with($model);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($model);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$flashMessageContainer->expects($this->once())->method('add');
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->deleteAction($model);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$model = new \Comuno\Nodedb2\Domain\Model\Model();

		$modelRepository = $this->getMock('Comuno\\Nodedb2\\Domain\\Repository\\ModelRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'modelRepository', $modelRepository);

		$flashMessageContainer = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\Controller\\FlashMessageContainer', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'flashMessageContainer', $flashMessageContainer);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($model);
	}
}
