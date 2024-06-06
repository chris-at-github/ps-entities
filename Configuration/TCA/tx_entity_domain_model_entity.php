<?php

//$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity');

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
		'iconfile' => 'EXT:entity/Resources/Public/Icons/entity-module.svg',
	],
	'palettes' => [
		'title' => [
			'showitem' => 'title, --linebreak--, subtitle'
		],
		'description' => [
			'showitem' => 'short_description, --linebreak--, long_description,'
		],
		'media' => [
			'showitem' => 'image, --linebreak--, media,'
		],
		'files' => [
			'showitem' => 'files,'
		],
		'relation' => [
			'showitem' => 'related,'
		],
		'seo_general' => [
			'showitem' => 'seo_title, --linebreak--, meta_description, --linebreak--, slug,'
		],
		'seo_robots' => [
			'showitem' => 'no_index, no_follow,'
		],
		'seo_canonical' => [
			'showitem' => 'canonical_url,'
		],
		'seo_sitemap' => [
			'showitem' => 'sitemap_change_frequency, sitemap_priority,'
		],
		'socialmedia_og' => [
			'showitem' => 'og_title, --linebreak--, og_description, --linebreak--, og_image,'
		],
		'socialmedia_twitter' => [
			'showitem' => 'twitter_title, --linebreak--, twitter_description, --linebreak--, twitter_image, --linebreak--, twitter_card,'
		],
		'language' => [
			'showitem' => 'sys_language_uid, l10n_parent,'
		],
		'access' => [
			'showitem' => 'hidden, --linebreak--, starttime, endtime,'
		],
		'category' => [
			'showitem' => 'master_category, --linebreak--, categories,'
		]
	],
	'types' => [
		'1' => [
			'showitem' => '
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
				--palette--;;title,
				--palette--;;description,
				--palette--;;media,
				--palette--;;files,
			--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.seo,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_general;seo_general,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_robots;seo_robots,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_canonical;seo_canonical,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seo_sitemap;seo_sitemap,
			--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.socialmedia,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmedia_og;socialmedia_og,
				--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmedia_twitter;socialmedia_twitter,
			--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.relation,
				--palette--;;relation,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
				--palette--;;language,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
				--palette--;;access,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
				tx_extbase_type,
			--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
				--palette--;;category,
			'
		],
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
					[
						'value' => '',
						'label' => ''
					],
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
				'itemsProcFunc' => Ps14\Foundation\Service\TcaService::class . '->getCategoriesByIdentifier',
				'itemsProcConfig' => [
					'identifier' => 'entity-product-main',
					'filter' => true,
				],
				'size' => 1,
				'maxitems' => 1,
				'foreign_table' => 'sys_category',
				'foreign_table_where' => ' AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.sorting ASC',
			],
		],
		'categories' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.categories',
			'config' => [
				'type' => 'category'
			]
		],
		'image' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.image',
			'config' => [
				'type' => 'file',
				'maxitems' => 1,
				'appearance' => [
					'collapseAll' => true,
					'fileUploadAllowed' => false,
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				],
				'allowed' => 'common-image-types',
			],
		],
		'media' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.media',
			'config' => [
				'type' => 'file',
				'maxitems' => 99,
				'appearance' => [
					'collapseAll' => true,
					'fileUploadAllowed' => false,
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				],
			],
		],
		'files' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.files',
			'config' => [
				'type' => 'file',
				'maxitems' => 99,
				'appearance' => [
					'collapseAll' => true,
					'fileUploadAllowed' => false,
				],
				'behaviour' => [
					'allowLanguageSynchronization' => true
				],
			],
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
				'richtextConfiguration' => 'ps14Minimal',
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
				'richtextConfiguration' => 'ps14Default',
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
				'richtextConfiguration' => 'ps14Minimal',
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
				'type' => 'link',
				'allowedTypes' => ['page', 'url', 'record'],
				'size' => 50,
				'appearance' => [
					'browserTitle' => 'LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.canonical_link',
					'allowedOptions' => ['params', 'rel'],
				],
			],
		],
		'no_index' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.no_index',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
//						'invertStateDisplay' => true
					]
				],
				'default' => 0,
			],
		],
		'no_follow' => [
			'exclude' => true,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.no_follow',
			'config' => [
				'type' => 'check',
				'renderType' => 'checkboxToggle',
				'items' => [
					[
						0 => '',
						1 => '',
//						'invertStateDisplay' => true
					],
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
			'config' => [
				'type' => 'file',
				'allowed' => 'common-image-types',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'overrideChildTca' => [
					'columns' => [
						'crop' => [
							'config' => [
								'cropVariants' => \Ps14\Site\Service\TcaService::getCropVariants(
									[
										'default' => [
											'allowedAspectRatios' => ['191_1'],
											'selectedRatio' => '191_1'
										],
									]
								),
							]
						],
					],
				],
			],
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
			'config' => [
				'type' => 'file',
				'allowed' => 'common-image-types',
				'behaviour' => [
					'allowLanguageSynchronization' => true,
				],
				'overrideChildTca' => [
					'columns' => [
						'crop' => [
							'config' => [
								'cropVariants' => \Ps14\Site\Service\TcaService::getCropVariants(
									[
										'default' => [
											'allowedAspectRatios' => ['191_1', '1_1'],
											'selectedRatio' => '191_1'
										],
									]
								),
							]
						],
					],
				],
			],
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
