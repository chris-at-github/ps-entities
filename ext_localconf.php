<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Entities',
            'Frontend',
            [
                \Ps\Entities\Controller\EntityController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                \Ps\Entities\Controller\EntityController::class => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        frontend {
                            iconIdentifier = entities-plugin-frontend
                            title = LLL:EXT:entities/Resources/Private/Language/locallang_db.xlf:tx_entities_frontend.name
                            description = LLL:EXT:entities/Resources/Private/Language/locallang_db.xlf:tx_entities_frontend.description
                            tt_content_defValues {
                                CType = list
                                list_type = entities_frontend
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'entities-plugin-frontend',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:entities/Resources/Public/Icons/user_plugin_frontend.svg']
			);
		
    }
);
