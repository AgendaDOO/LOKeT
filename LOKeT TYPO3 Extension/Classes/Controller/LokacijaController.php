<?php
namespace Agenda\AgLoket\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Agenda <programerji@agenda.si>
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
 *
 *
 * @package ag_loket
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LokacijaController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$lokacijas = $this->lokacijaRepository->findAll();
		$this->view->assign('lokacijas', $lokacijas);
	}

	/**
	 * action show
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 * @return void
	 */
	public function showAction(\Agenda\AgLoket\Domain\Model\Lokacija $lokacija) {
		$this->view->assign('lokacija', $lokacija);
	}

	/**
	 * action new
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $newLokacija
	 * @dontvalidate $newLokacija
	 * @return void
	 */
	public function newAction(\Agenda\AgLoket\Domain\Model\Lokacija $newLokacija = NULL) {
		$this->view->assign('newLokacija', $newLokacija);
	}

	/**
	 * action create
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $newLokacija
	 * @return void
	 */
	public function createAction(\Agenda\AgLoket\Domain\Model\Lokacija $newLokacija) {
		$this->lokacijaRepository->add($newLokacija);
		$this->flashMessageContainer->add('Your new Lokacija was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 * @return void
	 */
	public function editAction(\Agenda\AgLoket\Domain\Model\Lokacija $lokacija) {
		$this->view->assign('lokacija', $lokacija);
	}

	/**
	 * action update
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 * @return void
	 */
	public function updateAction(\Agenda\AgLoket\Domain\Model\Lokacija $lokacija) {
		$this->lokacijaRepository->update($lokacija);
		$this->flashMessageContainer->add('Your Lokacija was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 * @return void
	 */
	public function deleteAction(\Agenda\AgLoket\Domain\Model\Lokacija $lokacija) {
		$this->lokacijaRepository->remove($lokacija);
		$this->flashMessageContainer->add('Your Lokacija was removed.');
		$this->redirect('list');
	}

}
?>