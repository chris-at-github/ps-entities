<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Entity',
            'Frontend',
            [
                \Ps\Entity\Controller\EntityController::class => 'list, show'
            ],
            // non-cacheable actions
            [
                \Ps\Entity\Controller\EntityController::class => ''
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins {
                    elements {
                        frontend {
                            iconIdentifier = entity-plugin-frontend
                            title = LLL:EXT:entity/Resources/Private/Language/locallang_db.xlf:tx_entity_frontend.name
                            description = LLL:EXT:entity/Resources/Private/Language/locallang_db.xlf:tx_entity_frontend.description
                            tt_content_defValues {
                                CType = list
                                list_type = entity_frontend
                            }
                        }
                    }
                    show = *
                }
           }'
        );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'entity-plugin-frontend',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:entity/Resources/Public/Icons/user_plugin_frontend.svg']
			);
		
    }
);
