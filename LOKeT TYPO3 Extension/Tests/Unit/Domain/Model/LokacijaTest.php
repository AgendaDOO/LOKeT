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
 * Test case for class \Agenda\AgLoket\Domain\Model\Lokacija.
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
class LokacijaTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Agenda\AgLoket\Domain\Model\Lokacija
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \Agenda\AgLoket\Domain\Model\Lokacija();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNaslovReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNaslovForStringSetsNaslov() { 
		$this->fixture->setNaslov('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNaslov()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostaReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPostaForStringSetsPosta() { 
		$this->fixture->setPosta('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPosta()
		);
	}
	
	/**
	 * @test
	 */
	public function getKrajReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setKrajForStringSetsKraj() { 
		$this->fixture->setKraj('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getKraj()
		);
	}
	
	/**
	 * @test
	 */
	public function getLatitudeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLatitudeForStringSetsLatitude() { 
		$this->fixture->setLatitude('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLatitude()
		);
	}
	
	/**
	 * @test
	 */
	public function getLongitudeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLongitudeForStringSetsLongitude() { 
		$this->fixture->setLongitude('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLongitude()
		);
	}
	
}
?>