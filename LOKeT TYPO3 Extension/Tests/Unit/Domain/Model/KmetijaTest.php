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
 * Test case for class \Agenda\AgLoket\Domain\Model\Kmetija.
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
class KmetijaTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Agenda\AgLoket\Domain\Model\Kmetija
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Agenda\AgLoket\Domain\Model\Kmetija();
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
	public function getOpisReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setOpisForStringSetsOpis() { 
		$this->fixture->setOpis('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getOpis()
		);
	}
	
	/**
	 * @test
	 */
	public function getOdpiralniCasReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setOdpiralniCasForStringSetsOdpiralniCas() { 
		$this->fixture->setOdpiralniCas('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getOdpiralniCas()
		);
	}
	
	/**
	 * @test
	 */
	public function getVelikostReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setVelikostForStringSetsVelikost() { 
		$this->fixture->setVelikost('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getVelikost()
		);
	}
	
	/**
	 * @test
	 */
	public function getLokacijaReturnsInitialValueForLokacija() { }

	/**
	 * @test
	 */
	public function setLokacijaForLokacijaSetsLokacija() { }
	
	/**
	 * @test
	 */
	public function getTipkmetijeReturnsInitialValueForTipKmetije() { }

	/**
	 * @test
	 */
	public function setTipkmetijeForTipKmetijeSetsTipkmetije() { }
	
	/**
	 * @test
	 */
	public function getTippridelaveReturnsInitialValueForTipPridelave() { }

	/**
	 * @test
	 */
	public function setTippridelaveForTipPridelaveSetsTippridelave() { }
	
	/**
	 * @test
	 */
	public function getTipkmetovanjaReturnsInitialValueForTipKmetovanja() { }

	/**
	 * @test
	 */
	public function setTipkmetovanjaForTipKmetovanjaSetsTipkmetovanja() { }
	
	/**
	 * @test
	 */
	public function getSlikeReturnsInitialValueForSlike() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getSlike()
		);
	}

	/**
	 * @test
	 */
	public function setSlikeForObjectStorageContainingSlikeSetsSlike() { 
		$slike = new \Agenda\AgLoket\Domain\Model\Slike();
		$objectStorageHoldingExactlyOneSlike = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSlike->attach($slike);
		$this->fixture->setSlike($objectStorageHoldingExactlyOneSlike);

		$this->assertSame(
			$objectStorageHoldingExactlyOneSlike,
			$this->fixture->getSlike()
		);
	}
	
	/**
	 * @test
	 */
	public function addSlikeToObjectStorageHoldingSlike() {
		$slike = new \Agenda\AgLoket\Domain\Model\Slike();
		$objectStorageHoldingExactlyOneSlike = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneSlike->attach($slike);
		$this->fixture->addSlike($slike);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneSlike,
			$this->fixture->getSlike()
		);
	}

	/**
	 * @test
	 */
	public function removeSlikeFromObjectStorageHoldingSlike() {
		$slike = new \Agenda\AgLoket\Domain\Model\Slike();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($slike);
		$localObjectStorage->detach($slike);
		$this->fixture->addSlike($slike);
		$this->fixture->removeSlike($slike);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getSlike()
		);
	}
	
	/**
	 * @test
	 */
	public function getPridelkiReturnsInitialValueForProdukt() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getPridelki()
		);
	}

	/**
	 * @test
	 */
	public function setPridelkiForObjectStorageContainingProduktSetsPridelki() { 
		$pridelki = new \Agenda\AgLoket\Domain\Model\Produkt();
		$objectStorageHoldingExactlyOnePridelki = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePridelki->attach($pridelki);
		$this->fixture->setPridelki($objectStorageHoldingExactlyOnePridelki);

		$this->assertSame(
			$objectStorageHoldingExactlyOnePridelki,
			$this->fixture->getPridelki()
		);
	}
	
	/**
	 * @test
	 */
	public function addPridelkiToObjectStorageHoldingPridelki() {
		$pridelki = new \Agenda\AgLoket\Domain\Model\Produkt();
		$objectStorageHoldingExactlyOnePridelki = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOnePridelki->attach($pridelki);
		$this->fixture->addPridelki($pridelki);

		$this->assertEquals(
			$objectStorageHoldingExactlyOnePridelki,
			$this->fixture->getPridelki()
		);
	}

	/**
	 * @test
	 */
	public function removePridelkiFromObjectStorageHoldingPridelki() {
		$pridelki = new \Agenda\AgLoket\Domain\Model\Produkt();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($pridelki);
		$localObjectStorage->detach($pridelki);
		$this->fixture->addPridelki($pridelki);
		$this->fixture->removePridelki($pridelki);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getPridelki()
		);
	}
	
}
?>