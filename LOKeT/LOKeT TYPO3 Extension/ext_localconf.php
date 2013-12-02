<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Agenda.' . $_EXTKEY,
	'Loket',
	array(
		'Kmetija' => 'list, show, showSingle, ajaxShow, ajaxShowLokacije',
		'Lokacija' => 'list, show, new, create, edit, update, delete',
		'Produkt' => 'list, show, new, create, edit, update, delete',
		'Pridelovalec' => 'show, error, ajaxShowProfile, ajaxShowPridelki, ajaxDeletePridelek, ajaxDeleteImage, ajaxAddImage, ajaxShowKmetija, ajaxAddKmetija, ajaxAddPridelek, ajaxShowPridelovalec, ajaxEditKmetija, ajaxEditPridelovalec, ajaxEditPridelek, ajaxEditLokacija, ajaxAddLokacija, ajaxShowLastnostiKmetije, ajaxShowLokacija',
		
	),
	// non-cacheable actions
	array(
		'Kmetija' => 'create, update, delete',
		'Lokacija' => 'create, update, delete',
		'Produkt' => 'create, update, delete',
		'Pridelovalec' => 'create, update, delete',
		
	)
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>