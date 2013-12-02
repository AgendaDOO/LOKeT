<?php
namespace Agenda\AgLoket\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Exception;

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
class Kmetija extends AbstractEntity {

	/**
	 * Naziv kmetije
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $naziv;

	/**
	 * Opis kmetije
	 *
	 * @var \string
	 */
	protected $opis;

	/**
	 * lokacija
	 *
	 * @var \Agenda\AgLoket\Domain\Model\Lokacija
	 */
	protected $lokacija;

    /**
     * velikostkmetije
     *
     * @var \Agenda\AgLoket\Domain\Model\VelikostKmetije
     */
    protected $velikostkmetije;

    /**
	 * tipkmetije
	 *
	 * @var \Agenda\AgLoket\Domain\Model\TipKmetije
	 */
	protected $tipkmetije;

	/**
	 * tippridelave
	 *
	 * @var \Agenda\AgLoket\Domain\Model\TipPridelave
	 */
	protected $tippridelave;

	/**
	 * tipkmetovanja
	 *
	 * @var \Agenda\AgLoket\Domain\Model\TipKmetovanja
	 */
	protected $tipkmetovanja;

	/**
	 * slike
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Slike>
	 */
	protected $slike;

	/**
	 * pridelki
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Produkt>
	 */
	protected $pridelki;

	/**
	 * Odpiralni čas
	 *
	 * @var \string
	 */
	protected $odpiralniCas;

    /**
     * Telefonska št. kmetije
     *
     * @var \string
     */
    protected $tel;

    /**
     * Email kmetije
     *
     * @var \string
     */
    protected $email;

    /**
     * Spletna stran kmetije
     *
     * @var \string
     */
    protected $url;


	/**
	 * __construct
	 *
	 * @return Kmetija
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
		
		$this->pridelki = new ObjectStorage();

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
	 * @param \string $naziv
	 * @return void
	 */
	public function setNaziv($naziv) {
		$this->naziv = $naziv;
	}

	/**
	 * Returns the opis
	 *
	 * @return \string $opis
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
     * Adds a Lokacija
     *
     * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
     * @return void
     */
    public function addLokacija(Lokacija $lokacija) {

        if( $lokacija instanceof Lokacija)
            $this->lokacija = $lokacija;
        else if( is_array($lokacija) ){

            $this->lokacija = new Lokacija();

            foreach($lokacija as $lokacijaKey => $lokacijaValue){

                $methodName = 'set'.ucfirst($lokacijaKey);

                if( method_exists($this->lokacija,$methodName) )
                    $this->lokacija->{$methodName}($lokacijaValue);
            }
        }
    }

    /**
	 * Returns the lokacija
	 *
	 * @return \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 */
	public function getLokacija() {
		return $this->lokacija;
	}

	/**
	 * Sets the lokacija
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija
	 * @return void
	 */
	public function setLokacija(Lokacija $lokacija) {

        if( $lokacija instanceof Lokacija)
            $this->lokacija = $lokacija;
        else if( is_array($lokacija) ){

            if( !($this->lokacija instanceof Lokacija) )
                $this->lokacija = new Lokacija();

            foreach($lokacija as $lokacijaKey => $lokacijaValue){

                $methodName = 'set'.ucfirst($lokacijaKey);

                if( method_exists($this->lokacija,$methodName) )
                    $this->lokacija->{$methodName}($lokacijaValue);
            }
        }
        else if(is_string($lokacija)){

            $lokacija = (array)json_decode($lokacija);

            if( !($this->lokacija instanceof Lokacija) )
                $this->lokacija = new Lokacija();

            if( isset($lokacija['posta']) )
                $this->lokacija->setPosta(($lokacija['posta']));
            if( isset($lokacija['kraj']) )
                $this->lokacija->setKraj(($lokacija['kraj']));
            if( isset($lokacija['naslov']) )
                $this->lokacija->setNaslov(($lokacija['naslov']));
        }
	}

    /**
     * Returns the velikostkmetije
     *
     * @return \Agenda\AgLoket\Domain\Model\VelikostKmetije $velikostkmetije
     */
    public function getVelikostkmetije() {
        return $this->velikostkmetije;
    }

    /**
     * Sets the velikostkmetije
     *
     * @param \Agenda\AgLoket\Domain\Model\VelikostKmetije $velikostkmetije
     * @return void
     */
    public function setVelikostkmetije(VelikostKmetije $velikostkmetije) {

        if( $velikostkmetije instanceof VelikostKmetije)
            $this->velikostkmetije = $velikostkmetije;
        else if( is_int($velikostkmetije)||is_string($velikostkmetije) ){

            $velikostkmetijeRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\VelikostKmetijeRepository');

            if($velikostkmetije = $velikostkmetijeRepository->findByUid($velikostkmetije))
                $this->velikostkmetije = $velikostkmetije;
        }
    }

    /**
	 * Returns the tipkmetije
	 *
	 * @return \Agenda\AgLoket\Domain\Model\TipKmetije $tipkmetije
	 */
	public function getTipkmetije() {
		return $this->tipkmetije;
	}

	/**
	 * Sets the tipkmetije
	 *
	 * @param \Agenda\AgLoket\Domain\Model\TipKmetije $tipkmetije
	 * @return void
	 */
	public function setTipkmetije(TipKmetije $tipkmetije) {

        if( $tipkmetije instanceof TipKmetije)
            $this->tipkmetije = $tipkmetije;
        else if( is_int($tipkmetije)||is_string($tipkmetije) ){

            $tipKmetijeRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\TipKmetijeRepository');

            if($tipkmetije = $tipKmetijeRepository->findByUid($tipkmetije))
                $this->tipkmetije = $tipkmetije;
        }
	}

	/**
	 * Returns the tippridelave
	 *
	 * @return \Agenda\AgLoket\Domain\Model\TipPridelave $tippridelave
	 */
	public function getTippridelave() {
		return $this->tippridelave;
	}

	/**
	 * Sets the tippridelave
	 *
	 * @param \Agenda\AgLoket\Domain\Model\TipPridelave $tippridelave
	 * @return void
	 */
	public function setTippridelave(TipPridelave $tippridelave) {

        if( $tippridelave instanceof TipPridelave)
            $this->tippridelave = $tippridelave;
        else if( is_int($tippridelave)||is_string($tippridelave) ){

            $tipPridelaveRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\TipPridelaveRepository');

            if($tippridelave = $tipPridelaveRepository->findByUid($tippridelave))
                $this->tippridelave = $tippridelave;
        }
	}

	/**
	 * Returns the tipkmetovanja
	 *
     * @return \Agenda\AgLoket\Domain\Model\TipKmetovanja $tipkmetovanja
     */
	public function getTipkmetovanja() {
		return $this->tipkmetovanja;
	}

	/**
	 * Sets the tipkmetovanja
	 *
	 * @param \Agenda\AgLoket\Domain\Model\TipKmetovanja $tipkmetovanja
	 * @return void
	 */
	public function setTipkmetovanja(TipKmetovanja $tipkmetovanja) {

		if( $tipkmetovanja instanceof TipKmetovanja)
            $this->tipkmetovanja = $tipkmetovanja;
        else if( is_int($tipkmetovanja)||is_string($tipkmetovanja) ){

            $tipkmetovanjaRepository = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Repository\\TipKmetovanjaRepository');

            if($tipkmetovanja = $tipkmetovanjaRepository->findByUid($tipkmetovanja))
                $this->tipkmetovanja = $tipkmetovanja;
        }
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
	 * @param \Agenda\AgLoket\Domain\Model\Slike $slikeToRemove The Slike to be removed
	 * @return void
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
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Slike> $slike
	 * @return void
	 */
	public function setSlike(ObjectStorage $slike) {
		$this->slike = $slike;
	}

	/**
	 * Adds a Produkt
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $pridelki
	 * @return void
	 */
	public function addPridelki(Produkt $pridelki) {
		$this->pridelki->attach($pridelki);
	}

	/**
	 * Removes a Produkt
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Produkt $pridelkiToRemove The Produkt to be removed
	 * @return void
	 */
	public function removePridelki(Produkt $pridelkiToRemove) {
		$this->pridelki->detach($pridelkiToRemove);
	}

	/**
	 * Returns the pridelki
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Produkt> $pridelki
	 */
	public function getPridelki() {
		return $this->pridelki;
	}

	/**
	 * Sets the pridelki
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Produkt> $pridelki
	 * @return void
	 */
	public function setPridelki(ObjectStorage $pridelki) {
		$this->pridelki = $pridelki;
	}

	/**
	 * Returns the odpiralniCas
	 *
	 * @return \string $odpiralniCas
	 */
	public function getOdpiralniCas() {

        $odpiralniCas = array();

        try{
            $odpiralniCas = (array)json_decode($this->odpiralniCas);
        }
        catch(Exception $e){

        }

        return $odpiralniCas;
	}

	/**
	 * Sets the odpiralniCas
	 *
	 * @param \string $odpiralniCas
	 * @return void
	 */
	public function setOdpiralniCas($odpiralniCas) {
		$this->odpiralniCas = $odpiralniCas;
	}


    /**
     * Returns the tel
     *
     * @return \string $tel
     */
    public function getTel() {
        return $this->tel;
    }

    /**
     * Sets the tel
     *
     * @param \string $tel
     * @return void
     */
    public function setTel($tel) {
        $this->tel = $tel;
    }

    /**
     * Returns the email
     *
     * @return \string $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param \string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Returns the url
     *
     * @return \string $url
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param \string $url
     * @return void
     */
    public function setUrl($url) {
        $this->url = $url;
    }

}
?>