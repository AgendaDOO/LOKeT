<?php
namespace Agenda\AgLoket\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use \Agenda\AgLoket\Domain\Model\Slike;
use \Agenda\AgLoket\Domain\Model\Kmetija;
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;

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
class Produkt extends AbstractEntity {

    /**
     * enotaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\EnotaProduktaRepository
     * @inject
     */
    protected $enotaProduktaRepository;

    /**
	 * Naziv produkta
	 *
	 * @var \string
	 */
	protected $naziv;

	/**
	 * Opis produkta
	 *
	 * @var \string
	 */
	protected $opis;

	/**
	 * Slike produkta
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Slike>
	 */
	protected $slike;

    /**
	 * vrstaprodukta
	 *
	 * @var \Agenda\AgLoket\Domain\Model\VrstaProdukta
	 */
	protected $vrstaprodukta;

    /**
     * enotaprodukta
     *
     * @var \Agenda\AgLoket\Domain\Model\EnotaProdukta
     */
    protected $enotaprodukta;

	/**
	 * Cena produkta
	 *
	 * @var \float
	 */
	protected $cena;

	/**
	 * Ali je izdelek na zalogi
	 *
	 * @var boolean
	 */
	protected $naZalogi = FALSE;

    /**
     * Kolicina po kateri se produkt prodaja
     *
     * @var \integer
     */
    protected $kolicina;

	/**
	 * Letni pridelekt
	 *
	 * @var \string
	 */
	protected $letniPridelek;

    /**
     * kmetija
     *
     * @var \Agenda\AgLoket\Domain\Model\Kmetija
     */
    protected $kmetija;

    /**
     * razdalja
     *
     * @var \float
     */
    protected $razdalja;


    /**
	 * __construct
	 *
	 * @return Produkt
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->slike = new ObjectStorage();
	}

	/**
	 * Returns the naziv
	 *
	 * @return \string $naziv
	 */
	public function getNaziv() {
		return $this->naziv;
	}

    /**
     * Sets the naziv
     *
     * @param string $naziv
     * @return string
     */
	public function setNaziv($naziv) {
		$this->naziv = $naziv;
	}

	/**
	 * Returns the opis
	 *
	 * @return string $opis
     */
	public function getOpis() {
		return $this->opis;
	}

	/**
	 * Sets the opis
	 *
	 * @param \string $opis
	 * @return void
	 */
	public function setOpis($opis) {
		$this->opis = $opis;
	}

	/**
	 * Adds a Slike
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Slike $slike
	 * @return void
	 */
	public function addSlike(Slike $slike) {
		$this->slike->attach($slike);
	}

    /**
     * Removes a Slike
     *
     * @param Slike $slikeToRemove
     * @param \Agenda\AgLoket\Domain\Model\Slike $slikeToRemove The Slike to be removed
     * @return \Agenda\AgLoket\Domain\Model\Slike
     */
	public function removeSlike(Slike $slikeToRemove) {
		$this->slike->detach($slikeToRemove);
	}

	/**
	 * Returns the slike
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Slike> $slike
	 */
	public function getSlike() {
		return $this->slike;
	}

    /**
     * Sets the slike
     *
     * @param $slike \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Slike>
     * @return void
     */
	public function setSlike(ObjectStorage $slike) {
		$this->slike = $slike;
	}

	/**
	 * Returns the vrstaprodukta
	 *
	 * @return \Agenda\AgLoket\Domain\Model\VrstaProdukta $vrstaprodukta
	 */
	public function getVrstaprodukta() {
		return $this->vrstaprodukta;
	}

	/**
	 * Sets the vrstaprodukta
	 *
	 * @param int|string|\Agenda\AgLoket\Domain\Model\VrstaProdukta $vrstaprodukta
	 * @return void
	 */
	public function setVrstaprodukta(VrstaProdukta $vrstaprodukta) {


        if( $vrstaprodukta instanceof VrstaProdukta)
            $this->vrstaprodukta = $vrstaprodukta;
        else if( is_int($vrstaprodukta)||is_string($vrstaprodukta) ){

            $vrstaProduktaRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\VrstaProduktaRepository');

            if($vrstaprodukta = $vrstaProduktaRepository->findByUid($vrstaprodukta))
                $this->vrstaprodukta = $vrstaprodukta;
        }
	}


    /**
     * Returns the enotaprodukta
     *
     * @return \Agenda\AgLoket\Domain\Model\EnotaProdukta $enotaprodukta
     */
    public function getEnotaprodukta() {
        return $this->enotaprodukta;
    }

    /**
     * Sets the enotaprodukta
     *
     * @param int|string|\Agenda\AgLoket\Domain\Model\EnotaProdukta $enotaprodukta
     * @return void
     */
    public function setEnotaprodukta(EnotaProdukta $enotaprodukta) {

        if( $enotaprodukta instanceof EnotaProdukta)
            $this->enotaprodukta = $enotaprodukta;
        else if( is_int($enotaprodukta)||is_string($enotaprodukta) ){

            $enotaProduktaRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\EnotaProduktaRepository');

            if($newEnota = $enotaProduktaRepository->findByUid($enotaprodukta))
                $this->enotaprodukta = $newEnota;
        }
    }

	/**
	 * Returns the cena
	 *
	 * @return \float $cena
	 */
	public function getCena() {
		return $this->cena;
	}

	/**
	 * Sets the cena
	 *
	 * @param \float $cena
	 * @return void
	 */
	public function setCena($cena) {
		$this->cena = $cena;
	}

	/**
	 * Returns the naZalogi
	 *
	 * @return boolean $naZalogi
	 */
	public function getNaZalogi() {
		return $this->naZalogi;
	}

	/**
	 * Sets the naZalogi
	 *
	 * @param boolean $naZalogi
	 * @return void
	 */
	public function setNaZalogi($naZalogi) {

        if(!is_bool($naZalogi))
            $this->naZalogi = ($naZalogi == 'true') ? true : false;
        else
            $this->naZalogi = false;

        error_log($naZalogi);
	}

	/**
	 * Returns the boolean state of naZalogi
	 *
	 * @return boolean
	 */
	public function isNaZalogi() {
		return $this->getNaZalogi();
	}

    /**
     * Returns the kolicina
     *
     * @return \integer $kolicina
     */
    public function getKolicina() {
        return $this->kolicina;
    }

    /**
     * Sets the kolicina
     *
     * @param \integer $kolicina
     * @return void
     */
    public function setKolicina($kolicina) {
        $this->kolicina = $kolicina;
    }

	/**
	 * Returns the letniPridelek
	 *
	 * @return \string $letniPridelek
	 */
	public function getLetniPridelek() {
		return $this->letniPridelek;
	}

	/**
	 * Sets the letniPridelek
	 *
	 * @param \string $letniPridelek
	 * @return void
	 */
	public function setLetniPridelek($letniPridelek) {
		$this->letniPridelek = $letniPridelek;
	}


    /**
     * Returns the kmetija
     *
     * @return \Agenda\AgLoket\Domain\Model\Kmetija $kmetija
     */
    public function getKmetija() {
        return $this->kmetija;
    }


    /**
     * Sets the kmetija
     *
     * @param \Agenda\AgLoket\Domain\Model\Kmetija $kmetija
     * @return void
     */
    public function setKmetija(Kmetija $kmetija) {
        $this->kmetija = $kmetija;
    }

    /**
     * Returns the razdalja
     *
     * @return \float $razdalja
     */
    public function getRazdalja() {
        return $this->razdalja;
    }

    /**
     * Sets the razdalja
     *
     * @param \float $razdalja
     * @return void
     */
    public function setRazdalja($razdalja) {
        $this->razdalja = $razdalja;
    }

}
?>