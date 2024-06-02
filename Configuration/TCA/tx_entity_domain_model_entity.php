<?php

$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity');

return [
	'ctrl' => [
		'title' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity',
		'label' => 'title',
		'type' => 'tx_extbase_type',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',
		'versioningWS' => true,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'security' => [
			'ignorePageTypeRestriction' => true,
		],
		'searchFields' => 'title, subtitle, slug, meta_description, short_description, long_description, teaser, canonical_url, seo_title, og_title, og_description, twitter_title, twitter_description',
		'iconfile' => 'EXT:ps14_foundation/Resources/Public/Icons/entity-module.svg',
	],
	'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, tx_extbase_type, title, subtitle, slug, master_category, image, media, files, meta_description, short_description, long_description, teaser, canonical_url, no_index, no_follow, sitemap_change_frequency, sitemap_priority, seo_title, og_title, og_description, og_image, twitter_title, twitter_description, twitter_image, twitter_card, related --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
	],
	'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'default' => 0,
				'items' => [
					['', 0],
				],
				'foreign_table' => 'tx_entity_domain_model_entity',
				'foreign_table_where' => 'AND {#tx_entity_domain_model_entity}.{#pid}=###CURRENT_PID### AND {#tx_entity_domain_model_entity}.{#sys_language_uid} IN (-1,0)',
			],
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
						'invertStateDisplay' => true
					]
				],
			],
		],
		'starttime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'endtime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime,int',
				'default' => 0,
				'range' => [
					'upper' => mktime(0, 0, 0, 1, 1, 2038)
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				]
			],
		],
		'tx_extbase_type' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tx_extbase_type',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['',''],
				],
				'default' => '',
				'size' => 1,
				'maxitems' => 1,
			]
		],
		'title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim,required'
			],
		],
		'subtitle' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.subtitle',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 2,
				'eval' => 'trim',
			]
		],
		'slug' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.slug',
			'config' => [
				'type' => 'slug',
				'generatorOptions' => [
					'fields' => ['title'],
					'prefixParentPageSlug' => true,
					'replacements' => [
						'/' => '',
					],
				],
//				'appearance' => [
//					'prefix' => \Vendor\Extension\UserFunctions\FormEngine\SlugPrefix::class . '->getPrefix'
//				],
				'fallbackCharacter' => '-',
				'eval' => 'uniqueInSite',
				'default' => ''
			],
		],
		'master_category' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.master_category',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['', 0],
				],
				'size' => 1,
				'maxitems' => 1,
				'foreign_table' => 'sys_category',
//				'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) and sys_category.parent = ' . (int) $extensionConfiguration['masterCategory'] . ' ORDER BY sys_category.sorting ASC',
				'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.sorting ASC',
			],
		],
		'image' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'image',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
						'collapseAll' => 1,
					],
					'foreign_match_fields' => [
						'fieldname' => 'image',
						'tablenames' => 'tx_entity_domain_model_entity',
						'table_local' => 'sys_file',
					],
					'maxitems' => 1,
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
						],
					],
				],

				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
		],
		'media' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.media',
			'config' =>
				\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
					'media',
					[
						'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
							'collapseAll' => 1,
						],
						'overrideChildTca' => [
							'types' => [
								'0' => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
										--palette--;;filePalette'
								]
							],
						],
						'foreign_match_fields' => [
							'fieldname' => 'media',
							'tablenames' => 'tx_entity_domain_model_entity',
							'table_local' => 'sys_file',
						],
						'maxitems' => 99
					],
				),
		],
		'files' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.files',
			'config' =>
				\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
					'files',
					[
						'appearance' => [
							'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference',
							'collapseAll' => 1,
						],
						'overrideChildTca' => [
							'types' => [
								'0' => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
									'showitem' => '
										--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
									'showitem' => '
  									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
									'showitem' => '
       							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
									'showitem' => '
       							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								],
								\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
									'showitem' => '
       							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.basicoverlayPalette;basicoverlayPalette,
										--palette--;;filePalette'
								]
							],
						],
						'foreign_match_fields' => [
							'fieldname' => 'files',
							'tablenames' => 'tx_entity_domain_model_entity',
							'table_local' => 'sys_file',
						],
						'maxitems' => 99
					]
				),
		],
		'meta_description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.meta_description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 4,
				'eval' => 'trim',
				'max' => 160
			]
		],
		'short_description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.short_description',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'richtextConfiguration' => 'xoMinimal',
				'fieldControl' => [
					'fullScreenRichtext' => [
						'disabled' => false,
					],
				],
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			],
		],
		'long_description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.long_description',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'richtextConfiguration' => 'xoDefault',
				'fieldControl' => [
					'fullScreenRichtext' => [
						'disabled' => false,
					],
				],
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			],
		],
		'teaser' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.teaser',
			'config' => [
				'type' => 'text',
				'enableRichtext' => true,
				'richtextConfiguration' => 'xoMinimal',
				'fieldControl' => [
					'fullScreenRichtext' => [
						'disabled' => false,
					],
				],
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
			],
		],
		'canonical_url' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.canonical_url',
			'config' => [
				'type' => 'input',
				'renderType' => 'inputLink',
				'size' => 40,
				'max' => 1024,
				'fieldControl' => [
					'linkPopup' => [
						'options' => [
							'title' => 'LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.canonical_link',
							'blindLinkFields' => 'class,target,title',
							'blindLinkOptions' => 'mail,folder,file,telephone'
						],
					],
				],
				'softref' => 'typolink'
			],
		],
		'no_index' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.no_index',
			'config' => [
				'type' => 'check',
				'items' => [
					'1' => [
						'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
					]
				],
				'default' => 0,
			]
		],
		'no_follow' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.no_follow',
			'config' => [
				'type' => 'check',
				'items' => [
					'1' => [
						'0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
					]
				],
				'default' => 0,
			]
		],
		'sitemap_change_frequency' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.none', ''],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.always', 'always'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.hourly', 'hourly'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.daily', 'daily'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.weekly', 'weekly'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.monthly', 'monthly'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.yearly', 'yearly'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_change_frequency.never', 'never'],
				],
				'size' => 1,
			],
		],
		'sitemap_priority' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.sitemap_priority',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'default' => '0.5',
				'items' => [
					['0.0', '0.0'],
					['0.1', '0.1'],
					['0.2', '0.2'],
					['0.3', '0.3'],
					['0.4', '0.4'],
					['0.5', '0.5'],
					['0.6', '0.6'],
					['0.7', '0.7'],
					['0.8', '0.8'],
					['0.9', '0.9'],
					['1.0', '1.0'],
				],
				'size' => 1,
			]
		],
		'seo_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.seo_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max' => 60
			],
		],
		'og_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.og_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max' => 90,
			],
		],
		'og_description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.og_description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 4,
				'eval' => 'trim',
				'max' => 290
			]
		],
		'og_image' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.og_image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'og_image',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
						'collapseAll' => 1
					],
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'default' => [
											'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
											'allowedAspectRatios' => [
												'191_1' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.191_1',
													'value' => 1.91 / 1
												],
											],
											'selectedRatio' => '191_1',
										],
									]
								]
							]
						]
					],
					'foreign_match_fields' => [
						'fieldname' => 'og_image',
						'tablenames' => 'tx_entity_domain_model_entity',
						'table_local' => 'sys_file',
					],
					'maxitems' => 1
				],
				'png, jpg'
			),
		],
		'twitter_title' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_title',
			'config' => [
				'type' => 'input',
				'size' => 40,
				'eval' => 'trim',
				'max' => 70
			],
		],
		'twitter_description' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 4,
				'eval' => 'trim',
				'max' => 280
			]
		],
		'twitter_image' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_image',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'twitter_image',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
						'collapseAll' => 1,
					],
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'default' => [
											'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.crop_variant.default',
											'allowedAspectRatios' => [
												'191_1' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.191_1',
													'value' => 1.91 / 1
												],
												'1_1' => [
													'title' => 'LLL:EXT:core/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
													'value' => 1 / 1
												],
											],
											'selectedRatio' => '191_1',
										],
									]
								]
							]
						]
					],
					'foreign_match_fields' => [
						'fieldname' => 'twitter_image',
						'tablenames' => 'tx_entity_domain_model_entity',
						'table_local' => 'sys_file',
					],
					'maxitems' => 1
				],
				'jpg, png'
			),
		],
		'twitter_card' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_card',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_card.summary', 'summary'],
					['LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.twitter_card.summaryLargeImage', 'summary_large_image'],
				],
				'size' => 1,
			],
		],
		'related' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.related',
			'config' => [
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_entity_domain_model_entity',
				'foreign_table' => 'tx_entity_domain_model_entity',
				'MM' => 'tx_entity_entity_entity_mm',
				'maxitems' => 999,
				'size' => 4,
			],
		],
		'parent' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.parent',
			'config' => [
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_entity_domain_model_entity',
				'foreign_table' => 'tx_entity_domain_model_entity',
				'default' => 0,
				'size' => 1,
				'maxitems' => 1,
			],
		],
	],
];
