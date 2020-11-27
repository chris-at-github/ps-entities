<?php
defined('TYPO3_MODE') || die();

// Kategorien definieren
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
   'entity',
   'tx_entity_domain_model_entity'
);
