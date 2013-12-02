<?php
namespace Agenda\AgLoket\Controller;

use Agenda\AgLoket\Domain\Model\Lokacija;
use Agenda\AgLoket\Domain\Model\Produkt;
use Agenda\AgLoket\Domain\Model\Sezona;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \Agenda\AgLoket\Domain\Model\Pridelovalec;
use \Agenda\AgLoket\Domain\Model\Slike;
use \Agenda\AgLoket\Domain\Model\TipKmetije;
use \Agenda\AgLoket\Domain\Model\TipKmetovanja;
use \Agenda\AgLoket\Domain\Model\TipPridelave;
use \Agenda\AgLoket\Domain\Model\VelikostKmetije;
use \TYPO3\CMS\Extbase\Persistence\ObjectStorage;

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
class PridelovalecController extends GeneralController {

	/**
	 * pridelovalecRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\PridelovalecRepository
	 * @inject
	 */
	protected $pridelovalecRepository;

    /**
	 * kmetijaRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\KmetijaRepository
	 * @lazy
	 * @inject
	 */
	protected $kmetijaRepository;

    /**
	 * produktRepository
	 *
	 * @var \Agenda\AgLoket\Domain\Repository\ProduktRepository
	 * @lazy
	 * @inject
	 */
	protected $produktRepository;

    /**
     * pridelovalec - Currently logged in pridelovalec
     *
     * @var \Agenda\AgLoket\Domain\Model\Pridelovalec
     */
    protected $pridelovalec;

    /**
     * velikostKmetijeRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\VelikostKmetijeRepository
     * @lazy
     * @inject
     */
    protected $velikostKmetijeRepository;

    /**
     * tipKmetijeRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\TipKmetijeRepository
     * @lazy
     * @inject
     */
    protected $tipKmetijeRepository;


    /**
     * tipKmetovanjaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\TipKmetovanjaRepository
     * @lazy
     * @inject
     */
    protected $tipKmetovanjaRepository;


    /**
     * tipPridelaveRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\TipPridelaveRepository
     * @lazy
     * @inject
     */
    protected $tipPridelaveRepository;

    /**
     * sezonaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\SezonaRepository
     * @lazy
     * @inject
     */
    protected $sezonaRepository;

    /**
     * kategorijaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\KategorijaProduktaRepository
     * @lazy
     * @inject
     */
    protected $kategorijaProduktaRepository;

    /**
     * vrstaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\VrstaProduktaRepository
     * @lazy
     * @inject
     */
    protected $vrstaProduktaRepository;

    /**
     * enotaProduktaRepository
     *
     * @var \Agenda\AgLoket\Domain\Repository\EnotaProduktaRepository
     * @lazy
     * @inject
     */
    protected $enotaProduktaRepository;

    /**
     * Init function for all actions! This will check wether a user is logged in first
     * @return void
     */
    protected function initializeAction(){
//        error_log($this->actionMethodName." cookies ".var_export($_COOKIE,1));

        //Be sure not to cause a redirect Loop! Check that the errorAction is not beeing forwarded to already
        if( $this->actionMethodName != 'errorAction' ){

            //If a user is not logged in make an internal redirection to the error Action
            if( !$this->checkForLogin() )
                $this->forward("error");
        }

        $this->pridelovalec = $this->pridelovalecRepository->findByUid($this->checkForLogin());
    }

	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {

        $this->view->assign('pridelovalec', $this->pridelovalec);
		$this->view->assign('loginuser', $this->checkForLogin());
	}


    /*******************************************************
     *
     *  Helper functions for the AJAX EDIT Requests
     *
     *******************************************************/

    /**
     * This method takes an extbase model by reference and copies the argument array key values to the object
     * If the key value does not match an object property, it will get filled in an array which will then be returned
     *
     * @param $object mixed This can be an object of type extbase model to which to assign the given arguments
     * @param $arguments array Array of arguments sest in the format "objectProperty"=>"newValue"
     * @return array|bool Either an array containing errors or false if no errors
     */
    protected function updateObjectWithRequestArguments(&$object , $arguments){

        $errorArray = array();

        foreach($arguments as $key=>$value){

            if($key != 'uid'){

                $methodName = 'set'.ucfirst($key);

                if( method_exists($object,$methodName) ){
                    $object->{$methodName}($value);
                }
                else
                    $errorArray[$methodName] = LocalizationUtility::translate('error.parameter_invalid',$this->extensionName);
            }
        }

        if( !empty($errorArray) )
            return array('error'=>$errorArray);

        return false;
    }

    /**
     * This method takes an extbase model by reference and copies the argument array key values to the object
     * If the key value does not match an object property, it will get filled in an array which will then be returned
     *
     * @param $objectName string The name of the model to be updated
     * @param $object mixed This can be an object of type extbase model to which to assign the given arguments
     * @param $objectRepository mixed The repository that the object belongs to, If null, it will not be updated in repository
     * @param $returnObjectMethod bool|string Wether or not to return the object
     * @param bool $silent If silent is defined, then there is no JSON response returned
     * @return void
     */
    protected function editObjectWithRequestArguments($objectName, &$object, &$objectRepository = null, $returnObjectMethod = false, $silent=false){

        //First check that there are arguments to be posted to update the Kmetija object, then also be sure that the values are in an array!
        if( !$this->request->hasArgument($objectName) || !is_array($this->request->getArgument($objectName)) ){
            $this->JSONError("error.missing_argument", array($objectName));
            return;
        }

        /**
         * By now the $arguments var has to be an array
         * @var $arguments array
         */
        $arguments = $this->request->getArgument($objectName);

        $hasErrors = $this->updateObjectWithRequestArguments($object, $arguments);

        //If a repository is supplied, then update the current object in the repository
        if($objectRepository)
            $objectRepository->update($object);

        if($hasErrors){
            $this->returnJSON($hasErrors);
            return;
        }

        $returnObjectArray = array();

        if($returnObjectMethod && method_exists($this, $returnObjectMethod))
            $returnObjectArray = array( $objectName=>$this->$returnObjectMethod($object) );

        if(!$silent)
            $this->JSONSuccess($returnObjectArray,"success.{$objectName}_updated");
    }

    protected function ajaxAddImageAction() {

        if($this->request->hasArgument('image')){

            $image = $this->request->getArgument('image');

            $imageUploaded = $this->uploadFile($image['tmp_name'], $image['name']);


            $newSlika = new Slike();
            $newSlika->setSlika(ltrim($imageUploaded->getIdentifier(), '/'));

            $kmetija = $this->pridelovalec->getKmetija();

            $this->removeAllImagesFromKmetija($kmetija);

            $kmetija->addSlike($newSlika);

            $this->kmetijaRepository->update($kmetija);

            $retArray = array();
            $retArray["thumb"] = $this->getThumbnailURL($imageUploaded);
            $retArray["raw"] = $this->getImageURL($imageUploaded);

            $this->JSONSuccess($retArray);
        }
        else
            $this->JSONError('error.missing_argument', array("[image]"));
    }

    protected function ajaxDeleteImageAction() {

        $kmetija = $this->pridelovalec->getKmetija();

        $this->removeAllImagesFromKmetija($kmetija);

        $this->kmetijaRepository->update($kmetija);

        $this->JSONSuccess(array());
    }

    /**
     * Takes a kmetija by reference and removes all the images from it
     *
     * @param $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
     * @return \Agenda\AgLoket\Domain\Model\Kmetija
     */
    private function removeAllImagesFromKmetija(&$kmetija){

        $kmetija->setSlike( new ObjectStorage );

        return $kmetija;
    }

    /**
     * Helper function which extracts properties from the given kmetija and returns an array of allowed values
     *
     * @param $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
     * @return array
     */
    protected function getKmetijaProperties($kmetija){

        $returnArray =  array();

        $kmetijaReturnProperties = array("uid", "naziv", "opis", "tel", "email", "odpiralniCas");

        foreach($kmetijaReturnProperties as $property){

            $methodName = 'get'.ucfirst($property);

            if( method_exists($kmetija,$methodName) ){
                $returnArray[$property] = $kmetija->{$methodName}();
            }
        }

        $returnArray['lokacija'] = $returnArray['tipkmetije'] = $returnArray['tipkmetovanja'] = $returnArray['tippridelave'] = $returnArray['velikostkmetije'] = null;

        // ------- VELIKOST KMETIJE -------
        $velikost = $kmetija->getVelikostkmetije();

        if($velikost instanceof VelikostKmetije)
            $returnArray['velikostkmetije'] = $velikost->getUid();

        // ------- TIP KMETIJE -------
        $tipkmetije = $kmetija->getTipkmetije();

        if($tipkmetije instanceof TipKmetije)
            $returnArray['tipkmetije'] = $tipkmetije->getUid();

        // ------- TIP KMETOVANJA -------
        $tipkmetovanja = $kmetija->getTipkmetovanja();

        if($tipkmetovanja instanceof TipKmetovanja)
            $returnArray['tipkmetovanja'] = $tipkmetovanja->getUid();

        // ------- TIP PRIDELAVE -------
        $tippridelave = $kmetija->getTippridelave();

        if($tippridelave instanceof TipPridelave)
            $returnArray['tippridelave'] = $tippridelave->getUid();

        // ------- LOKACIJA -------
        $lokacija = $kmetija->getLokacija();

        if($lokacija instanceof Lokacija){

            $returnArray['lokacija']['naslov'] = $lokacija->getNaslov();
            $returnArray['lokacija']['kraj'] = $lokacija->getKraj();
            $returnArray['lokacija']['posta'] = $lokacija->getPosta();
        }

        // ------- SLIKE -------
        $slike = $kmetija->getSlike()->toArray();
        /**
         * @var $prvaslika \Agenda\AgLoket\Domain\Model\Slike
         */
        $prvaSlika = $slike[0];

        if($prvaSlika instanceof Slike)
            $returnArray['slika'] = $prvaSlika->getSlika();

        return $returnArray;
    }

    /**
     * Helper function which extracts properties from the given pridelek/produkt and returns an array of allowed values
     *
     * @param $pridelek \Agenda\AgLoket\Domain\Model\Produkt
     * @return array
     */
    protected function getProduktProperties($pridelek){

        $pridelekReturnProperties = array("uid", "naziv", "cena", "letniPridelek", "naZalogi");

        $pridelekProperties = array();

        foreach($pridelekReturnProperties as $property){

            $pridelekProperties[$property] = $pridelek->_getProperty($property);
        }

        /**
         * @var $slika \Agenda\AgLoket\Domain\Model\Slike
         */
        foreach($pridelek->getSlike() as $slika){

            $pridelekProperties["slike"][] = $slika->getSlika();
        }

        $pridelekProperties["opis"] = html_entity_decode(strip_tags($pridelek->getOpis()));

        if($pridelek->getVrstaprodukta())
            $pridelekProperties["vrstaprodukta"] = $pridelek->getVrstaprodukta()->getUid();
        else
            $pridelekProperties["vrstaprodukta"] = null;

        if($pridelek->getEnotaprodukta())
            $pridelekProperties["enotaprodukta"] = $pridelek->getEnotaprodukta()->getUid();
        else
            $pridelekProperties["enotaprodukta"] = null;

        return $pridelekProperties;
    }

    /*******************************************************
     *
     *  Ajax SHOW Actions
     *
     *******************************************************/

    /**
     * action ajaxShowPridelovalec
     *
     * @return void
     */
    public function ajaxShowPridelovalecAction() {

        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
//        $kmetija = $this->pridelovalec->getKmetija();

        $pridelovalecReturnProperties = array("username", "firstName", "lastName", "email");

        $pridelovalec = $returnArray = array();

        foreach($pridelovalecReturnProperties as $property){

            $pridelovalec[$property] = $this->pridelovalec->_getProperty($property);
        }

        $returnArray['user'] = $pridelovalec;

        $kmetija = $this->pridelovalec->getKmetija();

        if($kmetija){

            $returnArray['farm'] = $this->getKmetijaProperties($kmetija);
        }
        else
            $returnArray['farm'] = false;

        $this->returnJSON( $returnArray );
    }


    /**
     * action ajaxShowPridelovalec
     *
     * @return void
     */
    public function ajaxShowPridelkiAction(){

        $pridelki = $this->pridelovalec->getKmetija()->getPridelki();

        $returnArray = array();

        if( $pridelki->count() > 0  ){

            /**
             * @var $pridelek \Agenda\AgLoket\Domain\Model\Produkt
             */
            while($pridelek = $pridelki->current()){

                $returnArray[] = $this->getProduktProperties($pridelek);

                $pridelki->next();
            }
        }

        $this->returnJSONSuccess( array('pridelki'=>$returnArray) );
    }

    /**
     * action ajaxShowKmetija
     *
     * @return void
     */
    public function ajaxShowKmetijaAction() {
        $this->JSONSuccess( array('kmetija'=>array($this->getKmetijaProperties($this->pridelovalec->getKmetija()))) );
    }


    /**
     * action ajaxShowLastnostiKmetije
     *
     * @return void
     */
    public function ajaxShowLastnostiKmetijeAction() {

        $vrste = $enote = $kategorije = $sezone = $tipiKmetije = $tipiPridelave = $tipiKmetovanja = $velikostiKmetije = array();

        /**
         * @var $velikostKmetije \Agenda\AgLoket\Domain\Model\VelikostKmetije
         */
        foreach($this->velikostKmetijeRepository->findAll() as $velikostKmetije){

            $velikostiKmetije[$velikostKmetije->getUid()] = $velikostKmetije->getNaziv();
        }

        /**
         * @var $tipKmetije \Agenda\AgLoket\Domain\Model\TipKmetije
         */
        foreach($this->tipKmetijeRepository->findAll() as $tipKmetije){

            $tipiKmetije[$tipKmetije->getUid()] = $tipKmetije->getNaziv();
        }

        /**
         * @var $velikostKmetije \Agenda\AgLoket\Domain\Model\TipKmetije
         */
        foreach($this->tipKmetijeRepository->findAll() as $tipKmetije){

            $tipiKmetije[$tipKmetije->getUid()] = $tipKmetije->getNaziv();
        }

        /**
         * @var $tipPridelave \Agenda\AgLoket\Domain\Model\TipPridelave
         */
        foreach($this->tipPridelaveRepository->findAll() as $tipPridelave){

            $tipiPridelave[$tipPridelave->getUid()] = $tipPridelave->getNaziv();
        }

        /**
         * @var $tipKmetovanja \Agenda\AgLoket\Domain\Model\TipKmetovanja
         */
        foreach($this->tipKmetovanjaRepository->findAll() as $tipKmetovanja){

            $tipiKmetovanja[$tipKmetovanja->getUid()] = $tipKmetovanja->getNaziv();
        }

        /**
         * @var $sezona \Agenda\AgLoket\Domain\Model\Sezona
         */
        foreach($this->sezonaRepository->findAll() as $sezona){

            $sezone[$sezona->getUid()] = $sezona->getNaziv();
        }

        /**
         * @var $kategorija \Agenda\AgLoket\Domain\Model\KategorijaProdukta
         */
        foreach($this->kategorijaProduktaRepository->findAll() as $kategorija){

            $kategorije[$kategorija->getUid()] = $kategorija->getNaziv();
        }

        /**
         * @var $enota \Agenda\AgLoket\Domain\Model\EnotaProdukta
         */
        foreach($this->enotaProduktaRepository->findAll() as $enota){

            $enote[$enota->getUid()] = $enota->getNaziv();
        }


        /**
         * @var $vrsta \Agenda\AgLoket\Domain\Model\VrstaProdukta
         */
        foreach($this->vrstaProduktaRepository->findAll() as $vrsta){

            $sezoneProdukta = $vrsta->getSezona();
            $sezoneProduktaArray = array();
            while($currentSezona = $sezoneProdukta->current()){

                if($currentSezona instanceof Sezona){
                    $current_uid = $currentSezona->getUid();
                    $sezoneProduktaArray[] = $current_uid;
                }

                $sezoneProdukta->next();
            }

            $uid_kategorije = null;

            if( $vrsta->getKategorijaprodukta() )
                $uid_kategorije = $vrsta->getKategorijaprodukta()->getUid();

            $vrste[$vrsta->getUid()] = array(
                                            'name'=>$vrsta->getNaziv(),
                                            'sezone'=>$sezoneProduktaArray,
                                            'kategorija'=>$uid_kategorije
                                       );
        }

        $retArray['sezone'] = $sezone;
        $retArray['kategorije'] = $kategorije;

        $retArray['enote'] = $enote;
        $retArray['enote'][0] = "-- Izberi enoto --";

        $retArray['vrste'] = $vrste;
        $retArray['velikosti_kmetije'] = $velikostiKmetije;
        $retArray['tipi_kmetije'] = $tipiKmetije;
        $retArray['tipi_pridelave'] = $tipiPridelave;
        $retArray['tipi_kmetovanja'] = $tipiKmetovanja;

        $this->JSONSuccess( array('appdata'=>array($retArray)) );
    }


    /**
     * action ajaxShowLokacija
     *
     * @return void
     */
    public function ajaxShowLokacijaAction() {

        /**s
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */

        $lokacija = $this->pridelovalec->getKmetija()->getLokacija();

        $lokacijaReturnProperties = array("naslov","posta","kraj","latitude","longitude");

        //\TYPO3\CMS\Core\Utility\DebugUtility::debug($kmetija);

        $returnArray = array();

        foreach($lokacijaReturnProperties as $property){

            $returnArray[$property] = $lokacija->_getProperty($property);
        }

        $this->returnJSON( $returnArray );
    }


    /*******************************************************
     *
     *  Ajax ADD Actions
     *
     *******************************************************/

    /**
     * action ajaxAddKmetija
     *
     * @return void
     */
    public function ajaxAddKmetijaAction() {

        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Pridelovalec
         */
        $kmetija = $this->pridelovalec->getKmetija();

        //If there already is a farm for the current farmer, then abort
        if($kmetija){
            $this->JSONError('error.kmetija_exists');
            return;
        }

        /**
         * @var $newKmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
        $newKmetija = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Model\\Kmetija');

        if( !$this->request->hasArgument('kmetija') ){
            $this->JSONError('error.missing_argument_kmetija');
            return;
        }
        else{
            //Kmetija naziv is required argument!!! So if it is not set, then abort everything!!!
            $arguments = $this->request->getArgument('kmetija');

            if( !isset($arguments['naziv']) ){
                $this->JSONError('error.kmetija_missing_naziv');
                return;
            }
        }

        $this->editObjectWithRequestArguments('kmetija', $newKmetija);

        $this->pridelovalec->setKmetija($newKmetija);

        $this->pridelovalecRepository->update($this->pridelovalec);
    }



    /**
     * action ajaxAddLokacija
     *
     * @return void
     */
    public function ajaxAddLokacijaAction() {

        /**
         * @var $lokacija \Agenda\AgLoket\Domain\Model\Lokacija
         */
        $lokacija = $this->pridelovalec->getKmetija()->getLokacija();

        //preveri če ima kmetija že vpisano lokacijo
        if($lokacija){
            $this->JSONError('error.lokacija_exists');
            return;
        }


        if( !$this->request->hasArgument('lokacija') ) {
            $this->JSONError("error.missing_argument", array('lokacija'));
            return;
        }

        $arguments = $this->request->getArgument('lokacija');

        if( !isset($arguments['naslov']) ){
            $this->JSONError('error.missing_required_argument', array('lokacija','naslov'));
            return;
        }

        /**
         * @var $newLokacija \Agenda\AgLoket\Domain\Model\Lokacija
         */
        $newLokacija = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Model\\Lokacija');

        $this->editObjectWithRequestArguments('lokacija', $newLokacija);

        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
        $kmetija = $this->pridelovalec->getKmetija();

        $kmetija->addLokacija($newLokacija);

        $this->kmetijaRepository->update($kmetija);

        //$this->pridelovalecRepository->update($this->pridelovalec);
    }

    /**
     * action ajaxAddPridelek
     *
     * @return void
     */
    public function ajaxAddPridelekAction() {

//        error_log(var_export($_POST,1));

        if( !$this->request->hasArgument('pridelek') ) {
            $this->JSONError("error.missing_argument", array('pridelek'));
            return;
        }

        /**
         * By now the $arguments var has to be an array
         * @var $arguments array
         */
        $arguments = $this->request->getArgument('pridelek');


        if( !isset($arguments['naziv']) ){
            $this->JSONError('error.missing_required_argument', array('pridelka','naziv'));
            return;
        }

        /**
         * @var $newPridelek \Agenda\AgLoket\Domain\Model\Produkt
         */
        $newPridelek = GeneralUtility::makeInstance('Agenda\\AgLoket\\Domain\\Model\\Produkt');

        $hasErrors = $this->updateObjectWithRequestArguments($newPridelek, $arguments);

        if($hasErrors){
            $this->returnJSON($hasErrors);
            return;
        }

        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
        $kmetija = $this->pridelovalec->getKmetija();

        $kmetija->addPridelki($newPridelek);

        $this->pridelovalecRepository->update($this->pridelovalec);

        //Ok, so now we are done with the newly created object. Normal extBase would persist everything at the end. But since we are making JSON returns and kind of a REST api,
        //we will not be able to get the object ID unless we persist it NOW!
        $persistenceManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');

        /* @var $persistenceManager \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager */
        $persistenceManager->persistAll();

        $retArray = array("uid"=>$newPridelek->getUid());

        $this->JSONSuccess(array('pridelki'=>$retArray));
    }

    /*******************************************************
     *
     *  Ajax EDIT Actions
     *
     *******************************************************/

    /**
     * action ajaxEditKmetija
     * @return void
     */
    public function ajaxEditKmetijaAction(){
//        error_log(var_export($_POST,1));
        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
        $kmetija = $this->pridelovalec->getKmetija();

        $this->editObjectWithRequestArguments('kmetija', $kmetija, $this->kmetijaRepository);
    }


    /**
     * action ajaxEditLokacija
     *
     * @return void
     */
    public function ajaxEditLokacijaAction() {

        /**
         * @var $kmetija \Agenda\AgLoket\Domain\Model\Kmetija
         */
        $kmetija = $this->pridelovalec->getKmetija();

        $lokacija = $kmetija->getLokacija();

        $this->editObjectWithRequestArguments('lokacija', $lokacija);

        $this->kmetijaRepository->update($kmetija);
    }

    /**
     * action ajaxEditPridelovalec
     *
     * @return void
     */
    public function ajaxEditPridelovalecAction() {

        $this->editObjectWithRequestArguments('pridelovalec', $this->pridelovalec, $this->pridelovalecRepository);
    }

    /**
     * action ajaxEditPridelek
     *
     * @return void
     */
    public function ajaxEditPridelekAction() {

//        error_log(var_export($_POST,1));

        if( !$this->request->hasArgument('pridelek') ) {
            $this->JSONError("error.missing_argument", array('pridelek'));
            return;
        }

        $pridelek = $this->request->getArgument('pridelek');

        if(!is_array($pridelek) || !$pridelek["uid"]){
            $this->JSONError("error.missing_argument_pridelek_uid");
            return;
        }

        /**
         * @var $pridelek \Agenda\AgLoket\Domain\Model\Produkt
         */
        $pridelek = $this->produktRepository->findByUid($pridelek["uid"]);

        if($pridelek){

            $isPridelekInKmetija = $this->pridelovalec->getKmetija()->getPridelki()->getPosition($pridelek);

            if($isPridelekInKmetija){
                $this->editObjectWithRequestArguments('pridelek', $pridelek, $this->produktRepository, 'getProduktProperties');
                return;
            }
        }

        $this->JSONError("error.pridelek_not_found");
    }


    /**
     * action ajaxDeletePridelek
     *
     * @return void
     */
    public function ajaxDeletePridelekAction() {

//        error_log(var_export($_POST,1));

        if( !$this->request->hasArgument('pridelek') ) {
            $this->JSONError("error.missing_argument", array('pridelek'));
            return;
        }

        $pridelek = $this->request->getArgument('pridelek');

        if(!is_array($pridelek) || !$pridelek["uid"]){
            $this->JSONError("error.missing_argument_pridelek_uid");
            return;
        }

        $pridelek = $this->produktRepository->findByUid($pridelek["uid"]);

        if($pridelek){

            $isPridelekInKmetija = $this->pridelovalec->getKmetija()->getPridelki()->getPosition($pridelek);

            if($isPridelekInKmetija){

                $this->produktRepository->remove($pridelek);

                $this->JSONSuccess("success.pridelek_removed");

                return;
            }
        }

        $this->JSONError("error.pridelek_not_found");
    }


    /**
	 * Error action used to handle normal / ajax errors!
	 *
	 * @return void
	 */
	public function errorAction() {

        if( $this->isAjaxRequest() )
            $this->JSONError('error.login');
	}
}
?>