<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_agloket_domain_model_vrstaprodukta'] = array(
	'ctrl' => $TCA['tx_agloket_domain_model_vrstaprodukta']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, naziv, kategorijaprodukta, sezona, ikona, pic',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, naziv, kategorijaprodukta, sezona, ikona, pic, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_agloket_domain_model_vrstaprodukta',
				'foreign_table_where' => 'AND tx_agloket_domain_model_vrstaprodukta.pid=###CURRENT_PID### AND tx_agloket_domain_model_vrstaprodukta.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'naziv' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta.naziv',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'kategorijaprodukta' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta.kategorijaprodukta',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_kategorijaprodukta',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
        'ikona' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta.ikona',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_agloket',
                'show_thumbs' => 1,
                'size' => 1,
                'maxitems' => 1,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ),
        ),

        'pic' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta.pic',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'uploadfolder' => 'uploads/tx_agloket',
                'show_thumbs' => 1,
                'size' => 1,
                'maxitems' => 1,
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'disallowed' => '',
            ),
        ),

		'sezona' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_vrstaprodukta.sezona',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_sezona',
				'MM' => 'tx_agloket_vrstaprodukta_sezona_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_agloket_domain_model_sezona',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>