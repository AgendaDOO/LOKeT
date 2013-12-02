<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_agloket_domain_model_kmetija'] = array(
	'ctrl' => $TCA['tx_agloket_domain_model_kmetija']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, naziv, opis, tel, email, url, odpiralni_cas, velikostkmetije, lokacija, tipkmetije, tippridelave, tipkmetovanja, slike, pridelki',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, naziv, opis, tel, email, url, odpiralni_cas, velikostkmetije, lokacija, tipkmetije, tippridelave, tipkmetovanja, slike, pridelki,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_agloket_domain_model_kmetija',
				'foreign_table_where' => 'AND tx_agloket_domain_model_kmetija.pid=###CURRENT_PID### AND tx_agloket_domain_model_kmetija.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.naziv',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'opis' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.opis',
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
        'tel' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.tel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'url' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.url',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
		'odpiralni_cas' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.odpiralni_cas',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			),
		),
        'velikostkmetije' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.velikostkmetije',
            'config' => array(
                'type' => 'select',
                'foreign_table' => 'tx_agloket_domain_model_velikostkmetije',
                'minitems' => 0,
                'maxitems' => 1,
            ),
        ),
		'lokacija' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.lokacija',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_lokacija',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'tipkmetije' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.tipkmetije',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tipkmetije',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'tippridelave' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.tippridelave',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tippridelave',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'tipkmetovanja' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.tipkmetovanja',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tipkmetovanja',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'slike' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.slike',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_slike',
				'foreign_field' => 'kmetija',
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
		'pridelki' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:ag_loket/Resources/Private/Language/locallang_db.xlf:tx_agloket_domain_model_kmetija.pridelki',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_produkt',
				'foreign_field' => 'kmetija',
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
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

$TCA['tx_agloket_domain_model_kmetija']['columns']['lokacija']['config'] = array(
                'items' => array(
                    array(' --- Izberi lokacijo --- ',0)
                ),

                'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_lokacija',
				'minitems' => 0,
				'maxitems' => 1,
				'iconsInOptionTags' => 1,
				'wizards' => array(
                                   '_PADDING' => 1,
                                   '_VERTICAL' => 1,
                                   'edit' => array(
                                      'type' => 'popup',
                                      'title' => 'Edit',
                                      'script' => 'wizard_edit.php',
                                      'icon' => 'edit2.gif',
                                      'popup_onlyOpenIfSelected' => 1,
                                      'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
                                   ),
                                   'add' => array(
                                      'type' => 'script',
                                      'title' => 'Create new',
                                      'icon' => 'add.gif',
                                      'params' => array(
                                         'table' => 'tx_agloket_domain_model_lokacija',
                                         'pid' => '###CURRENT_PID###',
                                         'setValue' => 'prepend'
                                      ),
                                      'script' => 'wizard_add.php',
                                   ),
                                )
);


$TCA['tx_agloket_domain_model_kmetija']['columns']['velikostkmetije']['config'] = array(
    'type' => 'select',
    'foreign_table' => 'tx_agloket_domain_model_velikostkmetije',
    'minitems' => 0,
    'maxitems' => 1,
    'iconsInOptionTags' => 1,
    'wizards' => array(
        '_PADDING' => 1,
        '_VERTICAL' => 1,
        'edit' => array(
            'type' => 'popup',
            'title' => 'Edit',
            'script' => 'wizard_edit.php',
            'icon' => 'edit2.gif',
            'popup_onlyOpenIfSelected' => 1,
            'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
        ),
        'add' => array(
            'type' => 'script',
            'title' => 'Create new',
            'icon' => 'add.gif',
            'params' => array(
                'table' => 'tx_agloket_domain_model_velikostkmetije',
                'pid' => '###CURRENT_PID###',
                'setValue' => 'prepend'
            ),
            'script' => 'wizard_add.php',
        ),
    )
);

$TCA['tx_agloket_domain_model_kmetija']['columns']['tipkmetije']['config'] = array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tipkmetije',
				'minitems' => 0,
				'maxitems' => 1,
				'iconsInOptionTags' => 1,
				'wizards' => array(
                                   '_PADDING' => 1,
                                   '_VERTICAL' => 1,
                                   'edit' => array(
                                      'type' => 'popup',
                                      'title' => 'Edit',
                                      'script' => 'wizard_edit.php',
                                      'icon' => 'edit2.gif',
                                      'popup_onlyOpenIfSelected' => 1,
                                      'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
                                   ),
                                   'add' => array(
                                      'type' => 'script',
                                      'title' => 'Create new',
                                      'icon' => 'add.gif',
                                      'params' => array(
                                         'table' => 'tx_agloket_domain_model_tipkmetije',
                                         'pid' => '###CURRENT_PID###',
                                         'setValue' => 'prepend'
                                      ),
                                      'script' => 'wizard_add.php',
                                   ),
                                )
);


$TCA['tx_agloket_domain_model_kmetija']['columns']['tippridelave']['config'] = array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tippridelave',
				'minitems' => 0,
				'maxitems' => 1,
				'iconsInOptionTags' => 1,
				'wizards' => array(
                                   '_PADDING' => 1,
                                   '_VERTICAL' => 1,
                                   'edit' => array(
                                      'type' => 'popup',
                                      'title' => 'Edit',
                                      'script' => 'wizard_edit.php',
                                      'icon' => 'edit2.gif',
                                      'popup_onlyOpenIfSelected' => 1,
                                      'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
                                   ),
                                   'add' => array(
                                      'type' => 'script',
                                      'title' => 'Create new',
                                      'icon' => 'add.gif',
                                      'params' => array(
                                         'table' => 'tx_agloket_domain_model_tippridelave',
                                         'pid' => '###CURRENT_PID###',
                                         'setValue' => 'prepend'
                                      ),
                                      'script' => 'wizard_add.php',
                                   ),
                                )
);


$TCA['tx_agloket_domain_model_kmetija']['columns']['tipkmetovanja']['config'] = array(
				'type' => 'select',
				'foreign_table' => 'tx_agloket_domain_model_tipkmetovanja',
				'minitems' => 0,
				'maxitems' => 1,
				'iconsInOptionTags' => 1,
				'wizards' => array(
                                   '_PADDING' => 1,
                                   '_VERTICAL' => 1,
                                   'edit' => array(
                                      'type' => 'popup',
                                      'title' => 'Edit',
                                      'script' => 'wizard_edit.php',
                                      'icon' => 'edit2.gif',
                                      'popup_onlyOpenIfSelected' => 1,
                                      'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
                                   ),
                                   'add' => array(
                                      'type' => 'script',
                                      'title' => 'Create new',
                                      'icon' => 'add.gif',
                                      'params' => array(
                                         'table' => 'tx_agloket_domain_model_tipkmetovanja',
                                         'pid' => '###CURRENT_PID###',
                                         'setValue' => 'prepend'
                                      ),
                                      'script' => 'wizard_add.php',
                                   ),
                                )
);


$TCA['tx_agloket_domain_model_kmetija']['columns']['slike']['config'] = array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_slike',
				'foreign_field' => 'kmetija',
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



$TCA['tx_agloket_domain_model_kmetija']['columns']['pridelki']['config'] = array(
				'type' => 'inline',
				'foreign_table' => 'tx_agloket_domain_model_produkt',
				'foreign_field' => 'kmetija',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1,
                                        'showAllLocalizationLink' => 1,
                                        'useSortable' => 1
				)
);





$TCA['tx_agloket_domain_model_kmetija']['types'] = array(
'1' => array('showitem' =>
		       'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, naziv, opis, tel, email, url, odpiralni_cas, velikostkmetije, tipkmetije, tippridelave, tipkmetovanja,
		       --div--;LLL:EXT:ag_loket/Resources/Private/Language/locallang_db_custom.xlf:tx_agloket_domain_model_kmetija.tabs.pridelki, pridelki,
		       --div--;LLL:EXT:ag_loket/Resources/Private/Language/locallang_db_custom.xlf:tx_agloket_domain_model_kmetija.tabs.lokacija, lokacija,
		       --div--;LLL:EXT:ag_loket/Resources/Private/Language/locallang_db_custom.xlf:tx_agloket_domain_model_kmetija.tabs.slikekmetije, slike,
		       --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'
                ),
);

// /*$TCA['tx_agloket_domain_model_kmetija']['columns']['slike']['config'] = array(
// 		'foreign_label' => 'naziv',
// 		),
// );*/

// $TCA['tx_agloket_domain_model_kmetija']['columns']['pridelovalec']['config'] = array(
// 				'type' => 'select',
// 				'foreign_table' => 'fe_users',
// 				'minitems' => 0,
// 				'maxitems' => 1,
// 				'iconsInOptionTags' => 1,
// 				'wizards' => array(
//                                    '_PADDING' => 1,
//                                    '_VERTICAL' => 1,
//                                    'edit' => array(
//                                       'type' => 'popup',
//                                       'title' => 'LLL:EXT:lang/locallang_tca.xml:file_mountpoints_edit_title',
//                                       'script' => 'wizard_edit.php',
//                                       'icon' => 'edit2.gif',
//                                       'popup_onlyOpenIfSelected' => 1,
//                                       'JSopenParams' => 'height=450,width=700,status=0,menubar=0,scrollbars=1',
//                                    ),
//                                 ),
// );
?>