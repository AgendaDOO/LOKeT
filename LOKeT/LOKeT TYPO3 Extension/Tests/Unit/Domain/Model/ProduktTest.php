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
 * Test case for class \Agenda\AgLoket\Domain\Model\Produkt.
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
class ProduktTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Agenda\AgLoket\Domain\Model\Produkt
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Agenda\AgLoket\Domain\Model\Produkt();
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
	public function getCenaReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCenaForStringSetsCena() { 
		$this->fixture->setCena('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCena()
		);
	}
	
	/**
	 * @test
	 */
	public function getNaZalogiReturnsInitialValueForOolean() { }

	/**
	 * @test
	 */
	public function setNaZalogiForOoleanSetsNaZalogi() { }
	
	/**
	 * @test
	 */
	public function getEnotaReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getEnota()
		);
	}

	/**
	 * @test
	 */
	public function setEnotaForIntegerSetsEnota() { 
		$this->fixture->setEnota(12);

		$this->assertSame(
			12,
			$this->fixture->getEnota()
		);
	}
	
	/**
	 * @test
	 */
	public function getLetniPridelekReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLetniPridelekForStringSetsLetniPridelek() { 
		$this->fixture->setLetniPridelek('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLetniPridelek()
		);
	}
	
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
	public function getVrstaproduktaReturnsInitialValueForVrstaProdukta() { }

	/**
	 * @test
	 */
	public function setVrstaproduktaForVrstaProduktaSetsVrstaprodukta() { }
	
}
?>