<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_agloket_domain_model_kategorijaprodukta'] = array(
	'ctrl' => $TCA['tx_agloket_domain_model_kategorijaprodukta']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, naziv, ikona, pic',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, naziv, ikona, pic, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_agloket_domain_model_kategorijaprodukta',
				'foreign_table_where' => 'AND tx_agloket_domain_model_kategorijaprodukta.pid=###CURRENT_PID### AND tx_agloket_domain_model_kategorijaprodukta.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kategorijaprodukta.naziv',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
        'ikona' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kategorijaprodukta.ikona',
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
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kategorijaprodukta.pic',
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
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>