<?php

if(defined('TYPO3') === false) {
	die('Access denied.');
}

(function () {

	// Entity Frontend
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'Entity',
		'Frontend',
		'LLL:EXT:entity/Resources/Private/Language/locallang_plugin.xlf:frontend.title',
		'entity-module'
	);
})();