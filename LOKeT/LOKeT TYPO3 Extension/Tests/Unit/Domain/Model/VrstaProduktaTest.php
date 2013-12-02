<?php

namespace Agenda\AgLoket\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Agenda\AgLoket\Domain\Model\VrstaProdukta.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Loket
 *
 * @author Agenda <programerji@agenda.si>
 */
class VrstaProduktaTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Agenda\AgLoket\Domain\Model\VrstaProdukta
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Agenda\AgLoket\Domain\Model\VrstaProdukta();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNazivReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNazivForStringSetsNaziv() { 
		$this->fixture->setNaziv('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNaziv()
		);
	}
	
	/**
	 * @test
	 */
	public function getKategorijaproduktaReturnsInitialValueForKategorijaProdukta() { }

	/**
	 * @test
	 */
	public function setKategorijaproduktaForKategorijaProduktaSetsKategorijaprodukta() { }
	
	/**
	 * @test
	 */
	public function getSezonaReturnsInitialValueForSezona() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getSezona()
		);
	}

	/**
	 * @test
	 */
	public function setSezonaForObjectStorageContainingSezonaSetsSezona() { 
		$sezona = new \Agenda\AgLoket\Domain\Model\Sezona();
		$objectStorageHoldingExactlyOneSezona = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSezona->attach($sezona);
		$this->fixture->setSezona($objectStorageHoldingExactlyOneSezona);

		$this->assertSame(
			$objectStorageHoldingExactlyOneSezona,
			$this->fixture->getSezona()
		);
	}
	
	/**
	 * @test
	 */
	public function addSezonaToObjectStorageHoldingSezona() {
		$sezona = new \Agenda\AgLoket\Domain\Model\Sezona();
		$objectStorageHoldingExactlyOneSezona = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSezona->attach($sezona);
		$this->fixture->addSezona($sezona);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneSezona,
			$this->fixture->getSezona()
		);
	}

	/**
	 * @test
	 */
	public function removeSezonaFromObjectStorageHoldingSezona() {
		$sezona = new \Agenda\AgLoket\Domain\Model\Sezona();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($sezona);
		$localObjectStorage->detach($sezona);
		$this->fixture->addSezona($sezona);
		$this->fixture->removeSezona($sezona);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getSezona()
		);
	}
	
}
?>