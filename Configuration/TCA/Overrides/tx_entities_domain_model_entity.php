<?php
defined('TYPO3_MODE') || die();




\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	'entities',
	'tx_entities_domain_model_entity'
);
