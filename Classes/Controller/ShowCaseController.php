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
        $GLOBALS['TSFE']->set_no_cache(); // set no cache for multi-language switch

        $cookie_status = $_COOKIE['cookieconsent_status'];

        $rootPageUid = 0;
        foreach ($GLOBALS['TSFE']->rootLine as $rootline) {
            if ($rootline['is_siteroot']) {
                $rootPageUid = (int)$rootline['uid'];
                break;
            }
        }

        $privacyConfigs = $this->privacyConfigRepository->findByRootPageUid($rootPageUid);
        
        $formIdsString = '';
        if(!empty($privacyConfigs[0])){
            if($privacyConfigs[0]->getFormId()){
                $formIdsArr = explode(',',$privacyConfigs[0]->getFormId());
                array_walk($formIdsArr, function(&$value, $key) { $value = '#'.$value; } );
                $formIdsString = implode(',',$formIdsArr);
            }
            $this->view
            ->assign('privacyConfig', $privacyConfigs[0])
            ->assign('formIdsString', $formIdsString);
        }
        if (empty($cookie_status) || $cookie_status === 'allow') {
            $this->view->assign('status', 1);
        } elseif ($cookie_status === 'deny') {
            // delete all cookie 100% DSGVO fullfiellment
            /*$_COOKIE = array();
            $_COOKIE['cookieconsent_status'] = $cookie_status;*/
            $this->view->assign('status', 0);
        }
    }
}
