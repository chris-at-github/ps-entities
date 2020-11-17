<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Entities',
            'Frontend',
            'Frontend'
        );



        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('entities', 'Configuration/TypoScript', 'Entities');


        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_entities_domain_model_entity', 'EXT:entities/Resources/Private/Language/locallang_csh_tx_entities_domain_model_entity.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_entities_domain_model_entity');

    }
);
