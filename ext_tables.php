<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'TYPO3Liebhaber.CookieDataPrivacy',
                'tools', // Make module a submodule of 'tools'
                'mod1', // Submodule key
                '', // Position
                [
                    \TYPO3Liebhaber\CookieDataPrivacy\Controller\PrivacyConfigController::class => 'list, new, create, edit, update, delete',
                    \TYPO3Liebhaber\CookieDataPrivacy\Controller\FileIncludeController::class => 'list, show',
                    \TYPO3Liebhaber\CookieDataPrivacy\Controller\ShowCaseController::class => 'list, show',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:cookie_data_privacy/Resources/Public/Icons/dsgvo.svg',
                    'labels' => 'LLL:EXT:cookie_data_privacy/Resources/Private/Language/locallang_mod1.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('cookie_data_privacy', 'Configuration/TypoScript', 'Cookie Privacy & Data Privacy (DSGVO)');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cookiedataprivacy_domain_model_privacyconfig', 'EXT:cookie_data_privacy/Resources/Private/Language/locallang_csh_tx_cookiedataprivacy_domain_model_privacyconfig.xlf');
        
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cookiedataprivacy_domain_model_fileinclude', 'EXT:cookie_data_privacy/Resources/Private/Language/locallang_csh_tx_cookiedataprivacy_domain_model_fileinclude.xlf');
        
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cookiedataprivacy_domain_model_showcase', 'EXT:cookie_data_privacy/Resources/Private/Language/locallang_csh_tx_cookiedataprivacy_domain_model_showcase.xlf');
        
    },
    $_EXTKEY
);
