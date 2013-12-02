<?php
namespace Agenda\AgLoket\Controller;

use Agenda\AgLoket\Domain\Model\Lokacija;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Resource\ProcessedFile;

/**
 *
 *
 * @package ag_loket
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class GeneralController extends ActionController {

    /**
     * storageRepository
     *
     * @var \TYPO3\CMS\Core\Resource\StorageRepository
     * @inject
     */
    protected $storageRepository;

    /**
     * storage
     *
     * @var \TYPO3\CMS\Core\Resource\ResourceStorage
     */
    protected $storage;

    /**
     * Function only returns the user uid if a user is logged in
     *
     * @return mixed
     */
    protected function checkForLogin(){

        global $TSFE;

        return $TSFE->fe_user->user['uid'];
    }

    /**
     * Shows a flashmessage
     *
     * @param string $messageKey The key to look for in the locallang.xml file
     * @return void
     */
    public function showFlashMessage($messageKey){

        $message = LocalizationUtility::translate($messageKey, 'ag_loket');

        $this->flashMessageContainer->add($message);
    }

    /**
     * Checks wether the request made is of Ajax type or not
     */
    protected function isAjaxRequest(){

        if( isset($_GET['type']) && $_GET['type']=="99" )
            return true;

        return false;
    }

    /**
     * Returns json with correct headers set and exits
     *
     * @param array $array
     * @return void
     */
    protected function returnJSON($array){

        //Set this! Otherwise you get an error message for the view which does not exist!!!
        $this->view=null;

        header('Content-type: application/json');
        echo json_encode($array);
    }

    /**
     * Returns json with correct headers set and exits
     *
     * @param array $array
     * @return void
     */
    protected function returnJSONSuccess($array){

        $array["success"] = true;
        $this->returnJSON($array);
    }

    /**
     * Returns json with correct headers set and exits
     *
     * @param string $error_key The array to be converted to JSON
     * @param string $arguments The arguments to be passed to the LocaliZationUtility
     * @return void
     */
    protected function JSONError($error_key, $arguments=null){

        $errorArray['error'] = LocalizationUtility::translate($error_key, $this->extensionName, $arguments);

        $this->returnJSON($errorArray);
    }

    /**
     * Returns json with correct headers set and exits
     *
     * @param string $success_key The success message if any
     * @param array $retArray The array to be converted to JSON
     * @return void
     */
    protected function JSONSuccess($retArray, $success_key=''){

        if($success_key && $succesString = LocalizationUtility::translate($success_key,$this->extensionName))
            $retArray['success'] =  $succesString;
        else
            $retArray['success'] =  true;

        $this->returnJSON($retArray);
    }


    protected function initFileRepository(){

        if( !$this->storage ){

            //Here we get the Custom Created File storage with ID "2" => pridelovalec_uploads
            $this->storage = $this->storageRepository->findByUid(2);

            //Create user specific folder for uploads if it does not yet exist
            $username = $GLOBALS['TSFE']->fe_user->user['username'];

            $this->storage->createFolder($username);
        }
    }

    /**
     * @param $imageTmpName
     * @param $imageName
     * @return \TYPO3\CMS\Core\Resource\FileInterface
     */
    protected function uploadFile($imageTmpName, $imageName){

        $username = $GLOBALS['TSFE']->fe_user->user['username'];

        $this->initFileRepository();

        $fileObject = $this->storage->addFile($imageTmpName, $this->storage->getFolder($username), $imageName);

        return $fileObject;
    }

    /**
     * Renders a thumbnail from given image and returns the url
     *
     * @param $imageFileObject \TYPO3\CMS\Core\Resource\FileInterface
     * @return string URL of the thumbnail image generated
     */
    protected function getThumbnailURL($imageFileObject){

        global $TSFE;

        $processingConfiguration = array();
        $processingConfiguration['width'] = "250c";
        $processingConfiguration['height'] = "250c";
        $processingConfiguration['fileExtension'] = "jpg";

        /**
         * @var $processedFileObject \TYPO3\CMS\Core\Resource\FileInterface
         */
        $processedFileObject = $imageFileObject->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, $processingConfiguration);

        $processedUrl = $processedFileObject->getPublicUrl();

//        $processedFileObject->moveTo($this->storage->getDefaultFolder());

        return $TSFE->baseUrl.$processedUrl;
    }

    /**
     * Renders a thumbnail from given image and returns the url
     *
     * @param $image \TYPO3\CMS\Core\Resource\FileInterface
     * @return string URL of the thumbnail image generated
     */
    protected function getImageURL($image){

        global $TSFE;

        return $TSFE->baseUrl.$image->getPublicUrl();
    }

    /**
     * Helper function which get lokacija and returns an url encoded string
     *
     * @param Lokacija $lokacija
     * @return string
     */
    public function getFormattedAddress(Lokacija $lokacija){

        if($lokacija instanceof Lokacija){

            $encodeUrl = "";

            if($naslov = $lokacija->getNaslov()){
                $encodeUrl = $naslov;
            }
            if($posta = $lokacija->getPosta()){
                if(!empty($encodeUrl))
                    $encodeUrl .= ', ';

                $encodeUrl .= $posta;
            }
            if($kraj = $lokacija->getKraj()){
                if(!empty($encodeUrl))
                    $encodeUrl .= ', ';

                $encodeUrl .= $kraj;
            }
            return $encodeUrl;
        }
    }

    /*

    public function ajaxShowKmetijaAction() {

        $kmetijaRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("Agenda\AgLoket\Domain\Repository\KmetijaRepository");

        $kmetijaTrenutnegaUserja = $GLOBALS['TSFE']->fe_user->user['kmetija'];

        $kmetija = $kmetijaRepository->findByUid($kmetijaTrenutnegaUserja);


        // echo get_class($this->storageRepository->findByUid(1));die();
        // \TYPO3\CMS\Core\Utility\DebugUtility::debug($storageRepository);
        // \TYPO3\CMS\Core\Utility\DebugUtility::debug($storage->getRootLevelFolder()->getPublicUrl());die();

        // \TYPO3\CMS\Core\Utility\DebugUtility::debug($kmetija);
        // \TYPO3\CMS\Core\Utility\DebugUtility::debug($this->request->getArguments());die();
        //return json_encode($GLOBALS['TSFE']->fe_user->user);


        if($image = $this->request->getArgument('image')){

            foreach ($image as $img) {
                $this->uploadFile($img['tmp_name'], $img['name']);
            }
        }
    }



    */

}

