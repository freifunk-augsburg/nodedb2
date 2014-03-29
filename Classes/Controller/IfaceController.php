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
 * IfaceController
 */
class IfaceController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * ifaceRepository
	 *
	 * @var \Comuno\Nodedb2\Domain\Repository\IfaceRepository
	 * @inject
	 */
	protected $ifaceRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$ifaces = $this->ifaceRepository->findAll();
		$this->view->assign('ifaces', $ifaces);
	}

	/**
	 * action show
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $iface
	 * @return void
	 */
	public function showAction(\Comuno\Nodedb2\Domain\Model\Iface $iface) {
		$this->view->assign('iface', $iface);
	}

	/**
	 * action new
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $newIface
	 * @ignorevalidation $newIface
	 * @return void
	 */
	public function newAction(\Comuno\Nodedb2\Domain\Model\Iface $newIface = NULL) {
		$this->view->assign('newIface', $newIface);
	}

	/**
	 * action create
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $newIface
	 * @return void
	 */
	public function createAction(\Comuno\Nodedb2\Domain\Model\Iface $newIface) {
		$this->ifaceRepository->add($newIface);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $iface
	 * @ignorevalidation $iface
	 * @return void
	 */
	public function editAction(\Comuno\Nodedb2\Domain\Model\Iface $iface) {
		$this->view->assign('iface', $iface);
	}

	/**
	 * action update
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $iface
	 * @return void
	 */
	public function updateAction(\Comuno\Nodedb2\Domain\Model\Iface $iface) {
		$this->ifaceRepository->update($iface);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Comuno\Nodedb2\Domain\Model\Iface $iface
	 * @return void
	 */
	public function deleteAction(\Comuno\Nodedb2\Domain\Model\Iface $iface) {
		$this->ifaceRepository->remove($iface);
		$this->redirect('list');
	}

}