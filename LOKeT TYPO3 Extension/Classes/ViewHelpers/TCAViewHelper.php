<?php
namespace Agenda\AgLoket\ViewHelpers;
#use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * This class is a demo view helper for the Fluid templating engine.
 *
 * @package TYPO3
 * @subpackage Fluid
 * @version
 */
class TCAViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Render TCA
     *
     * @param string $tableName
     * @param string $column
     * @return string
     */
    public function render($tableName = '', $column = '') {

        $subject = $this->renderChildren();

        // load tca
        $GLOBALS['TSFE']->includeTCA();
//        $tca = t3lib_div::loadTCA($tableName);
        $items = $GLOBALS['TCA'][$tableName]['columns'][$column]['config']['items'];

        // array looks like this:
        /*array(4) {
          [0]=>
          array(2) {
            [0]=>
            string(19) "Option 1 Label"
            [1]=>
            int(0)
          }
          [1]=>
          array(2) {
            [0]=>
            string(6) "Option 2 Label"
            [1]=>
            int(1)
          }
        }*/

        foreach($items as $k => $v){
            if($v[1] == $subject){
                return $items[$k][0];
            }
        }
        return FALSE;
    }
}