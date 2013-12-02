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
class Slike extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Naziv slike
	 *
	 * @var \string
	 */
	protected $naziv;

	/**
	 * Slika
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $slika;

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
	 * Returns the slika
	 *
	 * @return \string $slika
	 */
	public function getSlika() {
		return $this->slika;
	}

	/**
	 * Sets the slika
	 *
	 * @param \string $slika
	 * @return void
	 */
	public function setSlika($slika) {
		$this->slika = $slika;
	}

}
?>