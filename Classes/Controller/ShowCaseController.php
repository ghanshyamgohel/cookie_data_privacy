<?php
namespace TYPO3Liebhaber\CookieDataPrivacy\Controller;

/***
 *
 * This file is part of the "Cookie Data Privacy" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Ghanshyam B. Gohel <ghanshyam.typo3developer@gmail.com>
 *
 ***/

/**
 * ShowCaseController
 */
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Annotation\Inject;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Site\SiteFinder;

class ShowCaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * showCaseRepository
     *
     * @var \TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\ShowCaseRepository
     * @inject
     */
    protected $showCaseRepository = null;

    /**
     * privacyConfigRepository
     *
     * @var \TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\PrivacyConfigRepository
     * @inject
     */
    protected $privacyConfigRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $showCases = $this->showCaseRepository->findAll();
        $this->view->assign('showCases', $showCases);
    }

    /**
     * action show
     *
     * @return void
     */
    public function showAction()
    {
        $cookie_status = $_COOKIE['cookieconsent_status'];

        // set languageUid for multi-language switch
        $context = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class);
        $languageUid = $context->getPropertyFromAspect('language', 'id');
        $this->view->assign('languageUid', $languageUid);
        
        $pageUid = $GLOBALS['TSFE']->id;
        $site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByPageId($pageUid);
        $rootPageUid = 0;
        if($site->getConfiguration()){
            $rootPageUid = (int)$site->getConfiguration()['rootPageId'];
        }
        
        $privacyConfigs = $this->privacyConfigRepository->findByRootPageUid($rootPageUid);
        
        $formIdsString = '';
        if(!empty($privacyConfigs)){
            if($privacyConfigs->getFormId()){
                $formIdsArr = explode(',',$privacyConfigs->getFormId());
                array_walk($formIdsArr, function(&$value, $key) { $value = '#'.$value; } );
                $formIdsString = implode(',',$formIdsArr);
            }
            $this->view
            ->assign('privacyConfig', $privacyConfigs)
            ->assign('formIdsString', $formIdsString);
        }
        if (empty($cookie_status) || $cookie_status === 'allow') {
            $this->view->assign('status', 1);
        } elseif ($cookie_status === 'deny') {
            // delete all cookie 100% DSGVO fullfiellment
            $this->view->assign('status', 0);
        }
    }
}
