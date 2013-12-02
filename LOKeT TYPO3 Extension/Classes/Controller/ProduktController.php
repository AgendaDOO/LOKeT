<?php
namespace Agenda\AgLoket\Controller;

use Agenda\AgLoket\Domain\Model\Produkt;

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
class ProduktController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * produktRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\ProduktRepository
	 * @inject
	 */
	protected $produktRepository;


    /**
     * kmetijaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\KmetijaRepository
     * @inject
     */
    protected $kmetijaRepository;

    /**
     * kategorijaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\KategorijaProduktaRepository
     * @inject
     */
    protected $kategorijaProduktaRepository;

    /**
     * vrstaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\VrstaProduktaRepository
     * @inject
     */
    protected $vrstaProduktaRepository;


	/**
	 * action list
	 *
     * @param \Agenda\AgLoket\Domain\Model\KategorijaProdukta $category
     * @param string $sort
     * @param string $longitude
     * @param string $latitude
	 * @return void
	 */
	public function listAction(\Agenda\AgLoket\Domain\Model\KategorijaProdukta $category=null, $sort=null,
                               $longitude=null, $latitude=null) {

        if ($category) {
            $vrste = $this->vrstaProduktaRepository->findByKategorijaprodukta($category);
            $vrstearray = array();
            foreach($vrste as $vrsta)
                $vrstearray[] = $vrsta->getUid();

            $produkts = $this->produktRepository->findByVrste($vrstearray, $sort, $longitude, $latitude);
        } else if (!$category && $sort){
            $produkts = $this->produktRepository->findAndSortAll($sort, $longitude, $latitude);
        }else {
            $produkts = $this->produktRepository->findAll();
        }

        $this->view->assign('produkts', $produkts);
        $this->view->assign('vrste', $vrste);
        $this->view->assign('selectedCat', $category);
        $this->view->assign('selectedOrder', $sort);
        $this->view->assign('longitude', $longitude);
        $this->view->assign('latitude', $latitude);
        $this->view->assign('kategorije', $this->kategorijaProduktaRepository->findAll());
	}

	/**
	 * action show
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $produkt
	 * @return void
	 */
	public function showAction(\Agenda\AgLoket\Domain\Model\Produkt $produkt) {
		$this->view->assign('produkt', $produkt);
	}

	/**
	 * action new
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $newProdukt
	 * @dontvalidate $newProdukt
	 * @return void
	 */
	public function newAction(\Agenda\AgLoket\Domain\Model\Produkt $newProdukt = NULL) {
		$this->view->assign('newProdukt', $newProdukt);
	}

	/**
	 * action create
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $newProdukt
	 * @return void
	 */
	public function createAction(\Agenda\AgLoket\Domain\Model\Produkt $newProdukt) {
		$this->produktRepository->add($newProdukt);
		$this->flashMessageContainer->add('Your new Produkt was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $produkt
	 * @return void
	 */
	public function editAction(\Agenda\AgLoket\Domain\Model\Produkt $produkt) {
		$this->view->assign('produkt', $produkt);
	}

	/**
	 * action update
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $produkt
	 * @return void
	 */
	public function updateAction(\Agenda\AgLoket\Domain\Model\Produkt $produkt) {
		$this->produktRepository->update($produkt);
		$this->flashMessageContainer->add('Your Produkt was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $produkt
	 * @return void
	 */
	public function deleteAction(\Agenda\AgLoket\Domain\Model\Produkt $produkt) {
		$this->produktRepository->remove($produkt);
		$this->flashMessageContainer->add('Your Produkt was removed.');
		$this->redirect('list');
	}
}
?>