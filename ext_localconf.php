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

})();