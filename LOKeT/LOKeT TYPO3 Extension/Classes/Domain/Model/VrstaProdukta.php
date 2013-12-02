<?php
namespace Agenda\AgLoket\Domain\Model;

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
class VrstaProdukta extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Vrsta produkta
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $naziv;

	/**
	 * kategorijaprodukta
	 *
	 * @var \Agenda\AgLoket\Domain\Model\KategorijaProdukta
	 */
	protected $kategorijaprodukta;

	/**
	 * sezona
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Sezona>
	 */
	protected $sezona;

    /**
     * Ikona
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $ikona;

    /**
     * Pic
     *
     * @var \string
     * @validate NotEmpty
     */
    protected $pic;


	/**
	 * __construct
	 *
	 * @return VrstaProdukta
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
		$this->sezona = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Returns the ikona
     *
     * @return \string $ikona
     */
    public function getIkona() {
        return $this->ikona;
    }

    /**
     * Sets the ikona
     *
     * @param \string $ikona
     * @return void
     */
    public function setIkona($ikona) {
        $this->ikona = $ikona;
    }


    /**
     * Returns the pic
     *
     * @return \string $pic
     */
    public function getPic() {
        return $this->pic;
    }

    /**
     * Sets the pic
     *
     * @param \string $pic
     * @return void
     */
    public function setPic($pic) {
        $this->pic = $pic;
    }


    /**
	 * Returns the kategorijaprodukta
	 *
	 * @return \Agenda\AgLoket\Domain\Model\KategorijaProdukta $kategorijaprodukta
	 */
	public function getKategorijaprodukta() {
		return $this->kategorijaprodukta;
	}

	/**
	 * Sets the kategorijaprodukta
	 *
	 * @param \Agenda\AgLoket\Domain\Model\KategorijaProdukta $kategorijaprodukta
	 * @return void
	 */
	public function setKategorijaprodukta(\Agenda\AgLoket\Domain\Model\KategorijaProdukta $kategorijaprodukta) {
		$this->kategorijaprodukta = $kategorijaprodukta;
	}

	/**
	 * Adds a Sezona
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Sezona $sezona
	 * @return void
	 */
	public function addSezona(\Agenda\AgLoket\Domain\Model\Sezona $sezona) {
		$this->sezona->attach($sezona);
	}

	/**
	 * Removes a Sezona
	 *
	 * @param \Agenda\AgLoket\Domain\Model\Sezona $sezonaToRemove The Sezona to be removed
	 * @return void
	 */
	public function removeSezona(\Agenda\AgLoket\Domain\Model\Sezona $sezonaToRemove) {
		$this->sezona->detach($sezonaToRemove);
	}

	/**
	 * Returns the sezona
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Sezona> $sezona
	 */
	public function getSezona() {
		return $this->sezona;
	}

	/**
	 * Sets the sezona
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Agenda\AgLoket\Domain\Model\Sezona> $sezona
	 * @return void
	 */
	public function setSezona(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $sezona) {
		$this->sezona = $sezona;
	}

}
?>