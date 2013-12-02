<?php
namespace Agenda\AgLoket\Controller;

use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\DebugUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility as GeneralUtility;
use \Agenda\AgLoket\Domain\Model\Kmetija as Kmetija;
use \Agenda\AgLoket\Domain\Model\Lokacija;
use \TYPO3\CMS\Core\Messaging\FlashMessage as FlashMessage;

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
class KmetijaController extends GeneralController{

	/**
	 * kmetijaRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\KmetijaRepository
	 * @inject
	 */
	protected $kmetijaRepository;

    /**
     * velikostKmetijeRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\VelikostKmetijeRepository
     * @inject
     */
    protected $velikostKmetijeRepository;

    /**
	 * tipKmetijeRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\TipKmetijeRepository
	 * @inject
	 */
	protected $tipKmetijeRepository;

	/**
	 * tipPridelaveRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\TipPridelaveRepository
	 * @inject
	 */
	protected $tipPridelaveRepository;

	/**
	 * tipKmetovanjaRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\TipKmetovanjaRepository
	 * @inject
	 */
	protected $tipKmetovanjaRepository;

    /**
     * pridelovalecRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\PridelovalecRepository
     * @inject
     */
    protected $pridelovalecRepository;


    /**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
        $kmetije = $this->kmetijaRepository->findAll();
		$this->view->assign('kmetije', $kmetije);
    }

	/**
	 * action show
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Kmetija $kmetija
	 * @return void
	 */
	public function showAction(Kmetija $kmetija) {
        $this->view->assign('kmetija', $kmetija);
		$this->view->assign('slike', $kmetija->getSlike()->toArray());
	}

	/**
	 * action show
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Kmetija $kmetija
	 * @return void
	 */
	public function showSingleAction(Kmetija $kmetija) {
		$this->view->assign('kmetija', $kmetija);
        $this->view->assign('pridelovalec', $this->pridelovalecRepository->findOneByKmetija($kmetija));
	}

    public function ajaxShowLokacijeAction(){

        $kmetije = $this->kmetijaRepository->findAll();

        $lokacije = array();

        /**
         * @var Kmetija $kmetija
         */
        foreach($kmetije as $kmetija){

            /**
             * @var Lokacija $lokacija
             */
            $lokacija = $kmetija->getLokacija();

            if( $lokacija instanceof Lokacija){

                $tempLokacija = array();
                $tempLokacija['uid'] = $kmetija->getUid();
                $tempLokacija['name'] = $kmetija->getNaziv();
//                $tempLokacija['address'] = $lokacija->getNaslov();
//                $tempLokacija['post'] = $lokacija->getPosta();
//                $tempLokacija['city'] = $lokacija->getKraj();
                $tempLokacija['form_loc'] = $this->getFormattedAddress($lokacija);
                $tempLokacija['enc_loc'] = urlencode($tempLokacija['form_loc']);
                $tempLokacija['latitude'] = $lokacija->getLatitude();
                $tempLokacija['longitude'] = $lokacija->getLongitude();

                $lokacije[] = $tempLokacija;
            }
        }

        $this->JSONSuccess(array("lokacije"=>$lokacije));
    }
}
?>