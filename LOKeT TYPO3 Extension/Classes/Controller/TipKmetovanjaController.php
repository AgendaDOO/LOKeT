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
class TipKmetovanjaController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * tipKmetovanjaRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\TipKmetovanjaRepository
	 * @inject
	 */
	protected $tipKmetovanjaRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$tipKmetovanjas = $this->tipKmetovanjaRepository->findAll();
		$this->view->assign('tipKmetovanjas', $tipKmetovanjas);
	}

}
?>