<?php
namespace Agenda\AgLoket\Domain\Repository;

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
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 *
 *
 * @package ag_loket
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ProduktRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    /**
     * Finds all products by the specified vrstaProdukta
     *
     * @param array $vrste
     * @param string $sort
     * @param string $longitude
     * @param string $latitude
     * @return Tx_Extbase_Persistence_QueryResultInterface The products
     */
    public function findByVrste(array $vrste, $sort=NULL, $longitude=null, $latitude=null) {

        if($sort=='1'){
            $query = $this->createQuery();

            $produkti = $query
                ->matching($query->in('vrstaprodukta', $vrste))
                ->setOrderings (Array('cena' => 'DESC'))
                ->execute();

           return $produkti;

        } else if ($sort=='2'){

            $query = $this->createQuery();

            $produkti = $query
                ->matching($query->in('vrstaprodukta', $vrste))
                ->execute()
                ->toArray();

            $produkti = $this->sortByRazdalja($produkti, $longitude, $latitude);

            return $produkti;

        } else {
            $query = $this->createQuery();

            $produkti = $query
                ->matching($query->in('vrstaprodukta', $vrste))
                ->execute();

            return $produkti;
        }
    }

    /**
     * Finds and sorts all products
     *
     * @param string $sort
     * @param string $longitude
     * @param string $latitude
     * @return Tx_Extbase_Persistence_QueryResultInterface The products
     */
    public function findAndSortAll($sort=NULL, $longitude=null, $latitude=null) {

        if($sort=='1'){
            $produkti = $this->createQuery()
                ->setOrderings (Array('cena' => 'DESC'))
                ->execute();

            return $produkti;

        } else if ($sort=='2'){
            $produkti = $this->createQuery()
                ->execute()
                ->toArray();

            $produkti = $this->sortByRazdalja($produkti, $longitude, $latitude);

            return $produkti;

        } else {
            $produkti = $this->createQuery()
                ->execute();

            return $produkti;
        }
    }

    /**
     * Sorts all products by the specified razdalja
     *
     * @param array $produkti
     */
    public function sortByRazdalja(array $produkti, $longitude=null, $latitude=null) {

        foreach($produkti as $produkt)
        {
            $produktLongitude = $produkt->getKmetija()->getLokacija()->getLongitude();
            $produktLatitude = $produkt->getKmetija()->getLokacija()->getLatitude();

            // Request URL
            /*$url = "http://maps.googleapis.com/maps/api/directions/json?origin=54,16&destination=".$produktLatitude.",".$produktLongitude."&sensor=false&units=metric";*/
            $url = "http://maps.googleapis.com/maps/api/directions/json?origin=".$latitude.",".$longitude.
                "&destination=".$produktLatitude.",".$produktLongitude."&sensor=false&units=metric";

            // Make our API request
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $return = curl_exec($curl);
            curl_close($curl);
            $directions = json_decode($return);
            /*$distance = $directions->routes[0]->legs[0]->distance->text;*/
            $distance = trim($directions->routes[0]->legs[0]->distance->text," km");
            $produkt->setRazdalja($distance);
        }

        usort($produkti, function($a, $b)
        {
            if ($a->getRazdalja() == $b->getRazdalja()) {
                return 0;
            }
            return ($a->getRazdalja() < $b->getRazdalja()) ? -1 : 1;
        });

        foreach($produkti as $produkt)
            echo $produkt->getRazdalja().", ".$produkt->getNaziv()." --- ";

        return $produkti;
    }
}
?>