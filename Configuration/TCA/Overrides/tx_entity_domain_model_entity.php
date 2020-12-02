<?php
defined('TYPO3_MODE') || die();

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['seoGeneral'] = [
	'showitem' => 'seo_title, --linebreak--, meta_description, --linebreak--, slug,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['seoRobots'] = [
	'showitem' => 'no_index, no_follow,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['seoCanonical'] = [
	'showitem' => 'canonical_url,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['seoSitemap'] = [
	'showitem' => 'sitemap_change_frequency, sitemap_priority,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['socialmediaOg'] = [
	'showitem' => 'og_title, --linebreak--, og_description, --linebreak--, og_image,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['socialmediaTwitter'] = [
	'showitem' => 'twitter_title, --linebreak--, twitter_description, --linebreak--, twitter_image, --linebreak--, twitter_card,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['language'] = [
	'showitem' => 'sys_language_uid, l10n_parent,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['access'] = [
	'showitem' => 'hidden, --linebreak--, starttime, endtime,'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['palettes']['category'] = [
	'showitem' => 'master_category, --linebreak--'
];

$GLOBALS['TCA']['tx_entity_domain_model_entity']['types']['1']['showitem'] = '
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.seo,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoGeneral;seoGeneral,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoRobots;seoRobots,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoCanonical;seoCanonical,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.seoSitemap;seoSitemap,
--div--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.tab.socialmedia,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmediaOg;socialmediaOg,
	--palette--;LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_domain_model_entity.palette.socialmediaTwitter;socialmediaTwitter,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
	--palette--;;language,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
	--palette--;;access,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
	tx_extbase_type,
--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
	--palette--;;category,
';

// Kategorien definieren
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
   'entity',
   'tx_entity_domain_model_entity',
	'categories',
	[
		'fieldList' => 'categories',
		'position' => 'after:master_category'
	]
);
