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
class Lokacija extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Naslov
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $naslov;

	/**
	 * Pošta
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $posta;

	/**
	 * Kraj
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $kraj;

	/**
	 * latitude
	 *
	 * @var \string
	 */
	protected $latitude;

	/**
	 * longitude
	 *
	 * @var \string
	 */
	protected $longitude;


    /**
	 * Returns the naslov
	 *
	 * @return \string $naslov
	 */
	public function getNaslov() {
		return $this->naslov;
	}

	/**
	 * Sets the naslov
	 *
	 * @param \string $naslov
	 * @return void
	 */
	public function setNaslov($naslov) {
		$this->naslov = $naslov;
	}

	/**
	 * Returns the posta
	 *
	 * @return \string $posta
	 */
	public function getPosta() {
		return $this->posta;
	}

	/**
	 * Sets the posta
	 *
	 * @param \string $posta
	 * @return void
	 */
	public function setPosta($posta) {
		$this->posta = $posta;
	}

	/**
	 * Returns the kraj
	 *
	 * @return \string $kraj
	 */
	public function getKraj() {
		return $this->kraj;
	}

	/**
	 * Sets the kraj
	 *
	 * @param \string $kraj
	 * @return void
	 */
	public function setKraj($kraj) {
		$this->kraj = $kraj;
	}

	/**
	 * Returns the latitude
	 *
	 * @return \string $latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Sets the latitude
	 *
	 * @param \string $latitude
	 * @return void
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * Returns the longitude
	 *
	 * @return \string $longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Sets the longitude
	 *
	 * @param \string $longitude
	 * @return void
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

}
?>