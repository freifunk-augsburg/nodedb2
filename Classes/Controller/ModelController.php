<?php
namespace Comuno\Nodedb2\Controller;


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
 * ModelController
 */
class ModelController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * modelRepository
	 *
	 * @var \Comuno\Nodedb2\Domain\Repository\ModelRepository
	 * @inject
	 */
	protected $modelRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$models = $this->modelRepository->findAll();
		$this->view->assign('models', $models);
	}

	/**
	 * action show
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $model
	 * @return void
	 */
	public function showAction(\Comuno\Nodedb2\Domain\Model\Model $model) {
		$this->view->assign('model', $model);
	}

	/**
	 * action new
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $newModel
	 * @ignorevalidation $newModel
	 * @return void
	 */
	public function newAction(\Comuno\Nodedb2\Domain\Model\Model $newModel = NULL) {
		$this->view->assign('newModel', $newModel);
	}

	/**
	 * action create
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $newModel
	 * @return void
	 */
	public function createAction(\Comuno\Nodedb2\Domain\Model\Model $newModel) {
		$this->modelRepository->add($newModel);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $model
	 * @ignorevalidation $model
	 * @return void
	 */
	public function editAction(\Comuno\Nodedb2\Domain\Model\Model $model) {
		$this->view->assign('model', $model);
	}

	/**
	 * action update
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $model
	 * @return void
	 */
	public function updateAction(\Comuno\Nodedb2\Domain\Model\Model $model) {
		$this->modelRepository->update($model);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Model $model
	 * @return void
	 */
	public function deleteAction(\Comuno\Nodedb2\Domain\Model\Model $model) {
		$this->modelRepository->remove($model);
		$this->redirect('list');
	}

}