<?php

if(defined('TYPO3') === false) {
	die('Access denied.');
}

(function () {

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Entity',
		'Frontend',
		[
			\Ps\Entity\Controller\EntityController::class => 'list, show'
		],
		// non-cacheable actions
		[]
	);

	// -------------------------------------------------------------------------------------------------------------------
	// Hooks
	// Automatisches Setzen des Tokens
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][\Ps\Entity\Service\TokenService::class] = \Ps\Entity\Service\TokenService::class;

})();