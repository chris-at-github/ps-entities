<?php

(function() {

	// -------------------------------------------------------------------------------------------------------------------
	// Weitere Felder in Categories
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', [
		'tx_entity_page' => [
			'exclude' => true,
			'label' => 'LLL:EXT:entity/Resources/Private/Language/locallang_tca.xlf:tx_entity_sys_category.page',
			'config' => [
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'pages',
				'foreign_table' => 'pages',
				'maxitems' => 1,
				'size' => 1,
			]
		],
	]);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'tx_entity_page', '', 'after:tx_foundation_link');
})();