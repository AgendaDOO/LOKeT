<?php

namespace Agenda\AgLoket\ViewHelpers;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper ;

/**
 * This class is a demo view helper for the Fluid templating engine.
 *
 * @package TYPO3
 * @subpackage Fluid
 * @version
 */
class GoogleMapsViewHelper extends AbstractViewHelper {

    /**
     * Renders some classic dummy content: Lorem Ipsum...
     *
     * @param \Agenda\AgLoket\Domain\Model\Lokacija $lokacija Lokacija od katere bo generirana slika
     * @param $width int Width of the image
     * @param $height int Height of the image
     * @param $zoom int The zoom of the map
     * @param $className bool|string The class to assign to the image tag
     * @param bool $openInMaps If you wish to include the wrapper that opens in phone maps application
     * @return string The url of the image by given location
     * @author Mitja Orlic <mitja.orlic@agenda.si>
     */
    public function render($lokacija, $width=300, $height=300, $className="", $zoom=16, $openInMaps=true) {

        //If Lokacija ni nastavljena
        if(!$lokacija){
            return '<img src="http://placehold.it/'.$width.'x'.$height.'" alt="Naslov ni nastavljen" style="width:100%" />';
        }

        $mapsUrl = "http://maps.googleapis.com/maps/api/staticmap?";

        $kraj = $lokacija->getKraj();

        $naslov = $lokacija->getNaslov();

        $postna = $lokacija->getPosta();

        $naslovEncoded = '';

        if($naslov)
            $naslovEncoded .= $naslov;
        if($kraj)
            $naslovEncoded .= ','.$kraj;
        if($postna)
            $naslovEncoded .= ','.$postna;

        $naslovEncoded = urlencode($naslovEncoded);

        $mapsUrl .= 'center='.$naslovEncoded;

        $mapsUrl .= '&zoom='.$zoom;

        $mapsUrl .= '&size='.$width.'x'.$height;

        $mapsUrl .= '&sensor=false';

        //The Map Marker
        $mapsUrl .= '&markers=color:red|'.$naslovEncoded;

        //$className = '';

        if($className){
            $className = ' class="'.$className.'"';
        }

        $imageWrap = '<img src="|" alt="'.$naslov.'" style="width:100%"'.$className.' />';

        $returnString = str_replace('|',  $mapsUrl, $imageWrap);

        if($openInMaps)
            $returnString = '<a href="http://maps.google.com/maps?saddr='.$naslovEncoded.'" target="top">'.$returnString.'</a>';

        return $returnString;
    }
}

