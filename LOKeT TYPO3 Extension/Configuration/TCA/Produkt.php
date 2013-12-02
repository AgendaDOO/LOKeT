<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_agloket_domain_model_produkt'] = array(
	'ctrl' => $TCA['tx_agloket_domain_model_produkt']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, naziv, opis, cena, na_zalogi, kolicina, enotaprodukta, letni_pridelek, slike, vrstaprodukta',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, naziv, opis, cena, na_zalogi, kolicina, enotaprodukta, letni_pridelek, slike, vrstaprodukta,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_agloket_domain_model_produkt',
				'foreign_table_where' => 'AND tx_agloket_domain_model_produkt.pid=###CURRENT_PID### AND tx_agloket_domain_model_produkt.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.naziv',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'opis' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.opis',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'cena' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.cena',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'na_zalogi' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.na_zalogi',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
        'kolicina' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.kolicina',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'enotaprodukta' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.enotaprodukta',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_agloket_domain_model_enotaprodukta',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
		'letni_pridelek' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.letni_pridelek',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'slike' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.slike',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_slike',
				'foreign_field' => 'produkt',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'vrstaprodukta' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_produkt.vrstaprodukta',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_vrstaprodukta',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'kmetija' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$TCA['tx_agloket_domain_model_produkt']['columns']['slike']['config'] = array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_slike',
				'foreign_field' => 'produkt',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'headerThumbnail' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
					'useSortable' => 1
                                )
);
?>