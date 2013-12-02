<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Loket',
	'Loket'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Loket');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_kmetija', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_kmetija.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_kmetija');
$TCA['tx_agloket_domain_model_kmetija'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,opis,tel, email, url, odpiralni_cas, velikostkmetije, lokacija, tipkmetije, tippridelave, tipkmetovanja, slike, pridelki,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kmetija.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_kmetija.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_lokacija', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_lokacija.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_lokacija');
$TCA['tx_agloket_domain_model_lokacija'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_lokacija',
		'label' => 'naslov',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naslov,posta,kraj,latitude,longitude,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Lokacija.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_lokacija.gif'
	),
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_velikostkmetije', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_velikostkmetije.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_velikostkmetije');
$TCA['tx_agloket_domain_model_velikostkmetije'] = array(
    'ctrl' => array(
        'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_velikostkmetije',
        'label' => 'naziv',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'naziv,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/VelikostKmetije.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_velikostkmetije.gif'
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_tipkmetije', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_tipkmetije.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_tipkmetije');
$TCA['tx_agloket_domain_model_tipkmetije'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_tipkmetije',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TipKmetije.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_tipkmetije.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_tippridelave', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_tippridelave.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_tippridelave');
$TCA['tx_agloket_domain_model_tippridelave'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_tippridelave',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TipPridelave.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_tippridelave.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_tipkmetovanja', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_tipkmetovanja.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_tipkmetovanja');
$TCA['tx_agloket_domain_model_tipkmetovanja'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_tipkmetovanja',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/TipKmetovanja.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_tipkmetovanja.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_slike', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_slike.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_slike');
$TCA['tx_agloket_domain_model_slike'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_slike',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,slika,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Slike.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_slike.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_produkt', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_produkt.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_produkt');
$TCA['tx_agloket_domain_model_produkt'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,opis,cena,na_zalogi,kolicina, letni_pridelek,slike, enotaprodukta, vrstaprodukta,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Produkt.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_produkt.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_enotaprodukta', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_enotaprodukta.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_enotaprodukta');
$TCA['tx_agloket_domain_model_enotaprodukta'] = array(
    'ctrl' => array(
        'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_enotaprodukta',
        'label' => 'naziv',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'naziv,',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/EnotaProdukta.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_enotaprodukta.gif'
    ),
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_vrstaprodukta', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_vrstaprodukta.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_vrstaprodukta');
$TCA['tx_agloket_domain_model_vrstaprodukta'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,kategorijaprodukta,ikona,pic,sezona,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/VrstaProdukta.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_vrstaprodukta.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_kategorijaprodukta', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_kategorijaprodukta.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_kategorijaprodukta');
$TCA['tx_agloket_domain_model_kategorijaprodukta'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kategorijaprodukta',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,ikona,pic,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/KategorijaProdukta.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_kategorijaprodukta.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_agloket_domain_model_sezona', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_tx_agloket_domain_model_sezona.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_agloket_domain_model_sezona');
$TCA['tx_agloket_domain_model_sezona'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_sezona',
		'label' => 'naziv',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'naziv,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Sezona.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_agloket_domain_model_sezona.gif'
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder


// \TYPO3\CMS\Core\Utility\GeneralUtility::loadTCA("fe_users");
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tmp_agloket_columns);
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes("fe_users","Tx_AgLoket_Pridelovalec");
// $TCA['fe_users']['ctrl']['type']

$TCA['fe_users']['columns']['tx_extbase_type']['config']['items'][] = array('LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:fe_users.tx_extbase_type.Tx_AgLoket_Pridelovalec','Tx_AgLoket_Pridelovalec');

$TCA['fe_users']['types']['Tx_AgLoket_Pridelovalec'] = $TCA['fe_users']['types']['0'];
$TCA['fe_users']['types']['Tx_AgLoket_Pridelovalec']['showitem'] .= ',--div--;LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija,';
$TCA['fe_users']['types']['Tx_AgLoket_Pridelovalec']['showitem'] .= '';

$tempColumns = array (
	'kmetija' => array (
		'exclude' => 0,
		'label' => 'Kmetija',
		'config' => array (
			'items' => array(
			                        array(' --- Izberi kmetijo --- ',0)
			),                        
			'type' => 'select',
			'foreign_table' => 'tx_agloket_domain_model_kmetija',
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			// 'foreign_field' => 'uid',
			'readOnly' => false
		)
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users',$tempColumns,1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users','kmetija;;;;1-1-1');


// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('fe_users', 'EXT:ag_loket/Resources/Private/Language/locallang_csh_fe_users.xlf');
// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('fe_users');
// $TCA['fe_users'] = array(
// 	'ctrl' => array(
// 		'title'	=> 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:fe_users',
// 		'label' => 'kmetija',
// 		'tstamp' => 'tstamp',
// 		'crdate' => 'crdate',
// 		'cruser_id' => 'cruser_id',
// 		'dividers2tabs' => TRUE,

// 		'versioningWS' => 2,
// 		'versioning_followPages' => TRUE,
// 		'origUid' => 't3_origuid',
// 		'languageField' => 'sys_language_uid',
// 		'transOrigPointerField' => 'l10n_parent',
// 		'transOrigDiffSourceField' => 'l10n_diffsource',
// 		'delete' => 'deleted',
// 		'enablecolumns' => array(
// 			'disabled' => 'hidden',
// 			'starttime' => 'starttime',
// 			'endtime' => 'endtime',
// 		),
// 		'searchFields' => 'kmetija,',
// 		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Pridelovalec.php',
// 		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/fe_users.gif'
// 	),
// );
?>