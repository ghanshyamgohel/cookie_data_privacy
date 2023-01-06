<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'TYPO3Liebhaber.CookieDataPrivacy',
            'Ext1',
            [
            	\TYPO3Liebhaber\CookieDataPrivacy\Controller\ShowCaseController::class => 'show, list',
                \TYPO3Liebhaber\CookieDataPrivacy\Controller\PrivacyConfigController::class => 'new, create',
                \TYPO3Liebhaber\CookieDataPrivacy\Controller\FileIncludeController::class => 'list, show'
            ],
            // non-cacheable actions
            [
            	\TYPO3Liebhaber\CookieDataPrivacy\Controller\ShowCaseController::class => 'show',
                \TYPO3Liebhaber\CookieDataPrivacy\Controller\PrivacyConfigController::class => 'create',
                \TYPO3Liebhaber\CookieDataPrivacy\Controller\FileIncludeController::class => ''
            ]
        );

        // Add external TS setup
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:cookie_data_privacy/Configuration/TypoScript/External/IncludeTs.typoscript">');

        //Add backend module
        if (TYPO3_MODE === 'BE') {
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
                'module.tx_cookiedataprivacy_tools_cookiedataprivacymod1 {
                    view {
                        templateRootPaths {
                            0 = EXT:cookie_data_privacy/Resources/Private/Backend/Templates/
                            1 = EXT:cookie_data_privacy/Resources/Private/Backend/Templates/
                        }
                        partialRootPaths {
                            0 = EXT:cookie_data_privacy/Resources/Private/Backend/Partials/
                            1 = EXT:cookie_data_privacy/Resources/Private/Backend/Partials/
                        }
                        layoutRootPaths {
                            0 = EXT:cookie_data_privacy/Resources/Private/Backend/Layouts/
                            1 = EXT:cookie_data_privacy/Resources/Private/Backend/Layouts/
                        }
                    }
                    persistence < plugin.tx_cookiedataprivacy_ext1.persistence
                }'
            );
        }
    },
    $_EXTKEY
);
