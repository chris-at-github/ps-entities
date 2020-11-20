<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Entity',
            'Frontend',
            'Frontend'
        );



        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('entity', 'Configuration/TypoScript', 'Entity');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_entity_domain_model_entity', 'EXT:entity/Resources/Private/Language/locallang_csh_tx_entity_domain_model_entity.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entity_domain_model_entity');

    }
);
