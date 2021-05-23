<?php
namespace TYPO3Liebhaber\CookieDataPrivacy\ViewHelpers;

/***
 * Copyright notice
 *
 * (c) 2018 Ghanshyam Gohel <ghanshyam.typo3developer@gmail.com>
 * 
 * All rights reserved
 *
 * This file is part of the "Cookie Data Privacy" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Ghanshyam Gohel <ghanshyam.typo3developer@gmail.com>
 *
 * uses case for fluid template
 * {namespace cp=TYPO3Liebhaber\CookieDataPrivacy\ViewHelpers}
 * <cp:formPrivacy translateKey="data_privacy_contact_form" />
 *
 * uses case for marker/piBase extension
 * use TYPO3Liebhaber\CookieDataPrivacy\ViewHelpers\FormPrivacyViewHelper; // put this line before your marker controler start
 * 
 * in function where marker is define
 * $formPrivacyParam = 'data_privacy_contact_form';
 * $formPrivacyCheckboxes = FormPrivacyViewHelper::render($formPrivacyParam);
 * $marker['###COOKIE_PRIVACY###']= $formPrivacyCheckboxes;
 * 
 * ###COOKIE_PRIVACY### <!-- use this marker in your template -->
 ***/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Site\SiteFinder;

class FormPrivacyViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Initializes arguments for Translate ViewHelper
     *
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('translateKey', 'string', 'Content');
    }
    /**
     * @param string $string
     * @return string
     */
    public function render($arguStr = NULL) {
		$arguments = $this->arguments;
        if($arguStr){
            $translateKey = $arguStr;
        }elseif($arguments['translateKey']){
            $translateKey = $arguments['translateKey'];
        }

        $pageUid = $GLOBALS['TSFE']->id;
        $site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByPageId($pageUid);
        $rootPageUid = 0;
        if($site->getConfiguration()){
            $rootPageUid = (int)$site->getConfiguration()['rootPageId'];
        }
        
        if (version_compare(TYPO3_version, '9.0.0', '<')) {
            $formPrivacyData = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('uid,enable_form_privacy,cookie_page_uid,data_privacy_page_uid,domain', 'tx_cookiedataprivacy_domain_model_privacyconfig', '(deleted=0 AND hidden=0) AND root_page_uid='.$rootPageUid, '', '', '', '');
        }else{
            $queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable('tx_cookiedataprivacy_domain_model_privacyconfig');
            $formPrivacyData = $queryBuilder
                ->select('uid','enable_form_privacy','cookie_page_uid','data_privacy_page_uid','domain')
                ->from('tx_cookiedataprivacy_domain_model_privacyconfig')
                ->where('(deleted=0 AND hidden=0) AND root_page_uid='.$rootPageUid)
                ->execute()
                ->fetch();
        }
        
		// get extension settings
		$objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\Extbase\\Object\\ObjectManager');
		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $settings = $extbaseFrameworkConfiguration['plugin.']['tx_cookiedataprivacy_ext1.']['settings.'];

        $checkbox2Message = $settings[$translateKey];
		$variables = array('formPrivacyData' => $formPrivacyData, 'translateKey' => $translateKey, 'settings' =>$settings, 'checkbox2Message' => $checkbox2Message);
		$standaloneView = $objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $extPath = ExtensionManagementUtility::extPath('cookie_data_privacy');
        
        $templatePathAndFilename = $extPath . 'Resources/Private/ViewHelper/FormPrivacy.html';
        $standaloneView->setTemplatePathAndFilename($templatePathAndFilename);
        $standaloneView->assignMultiple($variables);
        $output = $standaloneView->render();
        
		return $output;
    }
}

?>