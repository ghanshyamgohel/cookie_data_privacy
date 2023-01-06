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
 * PrivacyConfigController
 */
 use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
 use TYPO3\CMS\Core\Utility\GeneralUtility;
 use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
 use TYPO3\CMS\Extbase\Annotation as Extbase;
 use TYPO3\CMS\Core\Site\SiteFinder;

class PrivacyConfigController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * privacyConfigRepository
     *
     * @var \TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\PrivacyConfigRepository
     * @Extbase\Inject
     */
    protected $privacyConfigRepository = null;

    public function injectPrivacyConfigRepository(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\PrivacyConfigRepository $privacyConfigRepository){
        $this->privacyConfigRepository = $privacyConfigRepository;
    }

    /**
     * fileIncludeRepository
     *
     * @var \TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\FileIncludeRepository
     * @Extbase\Inject
     */
    protected $fileIncludeRepository = null;
    
    public function injectFileIncludeRepository(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository\FileIncludeRepository $fileIncludeRepository){
        $this->fileIncludeRepository = $fileIncludeRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $privacyConfigs = $this->privacyConfigRepository->findAll();
        $this->view->assign('privacyConfigs', $privacyConfigs);
    }

    /**
     * action newDomain
     *
     * @return void
     */
    public function newAction(){
        
    }

    /**
     * action createDomain
     *
     * @param $newPrivacyConfig
     * @return void
     */
    public function createAction(){
        $arguments = $this->request->getArguments();
        $privacyConfigModel = GeneralUtility::makeInstance('TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\PrivacyConfig');

        $privacyConfigSubmitData = $arguments['privacyconfig'];
        $domain = ($privacyConfigSubmitData['domain'])? $privacyConfigSubmitData['domain'] : '';
        $rootPageUid = ($privacyConfigSubmitData['rootPageUid'])? (int)$privacyConfigSubmitData['rootPageUid'] : '';

        $privacyConfigModel->setDomain($domain);
        $privacyConfigModel->setRootPageUid($rootPageUid);

        $this->addFlashMessage('You have successfully added the domain record.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->privacyConfigRepository->add($privacyConfigModel);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @return void
     */
    public function editAction(){
        $arguments = $this->request->getArguments();
        
        $uid = (int)$arguments['uid'];
        $privacyConfigs = $this->privacyConfigRepository->findByUid($uid);

        $languages = [];
        $rootPageUid = $privacyConfigs->getRootPageUid();
        $site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByPageId($rootPageUid);
        if($site->getConfiguration()){
            $languages = $site->getConfiguration()['languages'];
        }
        
        $this->view->assign('privacyConfigs', $privacyConfigs);
        $this->view->assign('languages', $languages);
    }

    /**
     * action update
     *
     * @param $privacyConfig
     * @return void
     */
    public function updateAction(){
        $arguments = $this->request->getArguments();
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
        
         ### JS configuration ###
        $uid = (int)$arguments['privacyconfig']['uid'];
        
        // variable assign
        $privacyConfigSubmitData = $arguments['privacyconfig'];
        $inFooter = ($privacyConfigSubmitData['inFooter'])? (int)$privacyConfigSubmitData['inFooter'] : 0;
        $jsScript = ($privacyConfigSubmitData['jsScript'])? $privacyConfigSubmitData['jsScript'] : '';
        $enableFormPrivacy = ($privacyConfigSubmitData['enableFormPrivacy'])? (int)$privacyConfigSubmitData['enableFormPrivacy'] : 0;
        $formId = ($privacyConfigSubmitData['formId'])? $privacyConfigSubmitData['formId'] : '';
        $position = ($privacyConfigSubmitData['position'])? $privacyConfigSubmitData['position'] : '';
        $popupBackground = ($privacyConfigSubmitData['popupBackground'])? $privacyConfigSubmitData['popupBackground'] : '';
        $buttonBackground = ($privacyConfigSubmitData['buttonBackground'])? $privacyConfigSubmitData['buttonBackground'] : '';
        $domain = ($privacyConfigSubmitData['domain'])? $privacyConfigSubmitData['domain'] : '';
        $expiryDay = ($privacyConfigSubmitData['expiryDay'])? (int)$privacyConfigSubmitData['expiryDay'] : '';
        $rootPageUid = ($privacyConfigSubmitData['rootPageUid'])? (int)$privacyConfigSubmitData['rootPageUid'] : '';
        $cookiePageUid = ($privacyConfigSubmitData['cookiePageUid'])? (int)$privacyConfigSubmitData['cookiePageUid'] : '';
        $dataPrivacyPageUid = ($privacyConfigSubmitData['dataPrivacyPageUid'])? (int)$privacyConfigSubmitData['dataPrivacyPageUid'] : '';

        $privacyConfigModel = $this->privacyConfigRepository->findByUid($uid);
        // set model value
        $privacyConfigModel->setInFooter($inFooter);
        $privacyConfigModel->setJsScript($jsScript);
        $privacyConfigModel->setEnableFormPrivacy($enableFormPrivacy);
        $privacyConfigModel->setFormId($formId);
        $privacyConfigModel->setPosition($position);
        $privacyConfigModel->setPopupBackground($popupBackground);
        $privacyConfigModel->setButtonBackground($buttonBackground);
        $privacyConfigModel->setDomain($domain);
        $privacyConfigModel->setExpiryDay($expiryDay);
        $privacyConfigModel->setRootPageUid($rootPageUid);
        $privacyConfigModel->setCookiePageUid($cookiePageUid);
        $privacyConfigModel->setDataPrivacyPageUid($dataPrivacyPageUid);
        
        // JS external file
        $jsexternal = $arguments['privacyconfig']['fileinclude']['js'];
        
        if(!empty($jsexternal)){
            foreach($jsexternal as $key=>$value){
                $jsFileName = '';
                $countModelObj = $garbage.$key;
                $countModelObj = GeneralUtility::makeInstance('TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude');
                $jsFolderName = 'js';
                $jsFileName = substr( md5( (int)$value['uid'] ), 0, 10 ); 

                $originalPath = $value['originalPath'];
                $countModelObj->setOriginalPath($originalPath);
                $path = $this->fetchExternal($originalPath, $jsFolderName, $jsFileName);
                $countModelObj->setPath($path);
                
                $pathUid = (int)$value['uid'];
                if($pathUid){//updates
                    $countModelObj = $this->fileIncludeRepository->findByUid($pathUid);
                    $countModelObj->setOriginalPath($originalPath);
                    $countModelObj->setPath($path);
                }
                
                $objectStorage->attach($countModelObj);
            }
            $privacyConfigModel->setJsPathExternal($objectStorage);
        }
        
        // CSS external file
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage;
        $cssexternal = $arguments['privacyconfig']['fileinclude']['css'];
        if(!empty($cssexternal)){
            foreach($cssexternal as $key=>$value){
                $cssFileName = '';
                $cssCountModelObj = GeneralUtility::makeInstance('TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude');
                $cssFolderName = 'css';
                $cssFileName = substr( md5( (int)$value['uid'] ), 0, 10 ); 

                $originalPath = $value['originalPath'];
                $cssCountModelObj->setOriginalPath($originalPath);
                $path = $this->fetchExternal($originalPath, $cssFolderName, $cssFileName);
                $cssCountModelObj->setPath($path);
                
                $pathUid = (int)$value['uid'];
                if($pathUid){//updates
                    $cssCountModelObj = $this->fileIncludeRepository->findByUid($pathUid);
                    $cssCountModelObj->setOriginalPath($originalPath);
                    $cssCountModelObj->setPath($path);
                }
                
                $objectStorage->attach($cssCountModelObj);
            }
            $privacyConfigModel->setCssPathExternal($objectStorage);
        }
        // save language labels
        if($this->request->hasArgument('languagelabels')){
            $languagelabels = $arguments['languagelabels'];
            $this->privacyConfigRepository->addLanguageLabels($languagelabels);
        }
        
        // ### write TS for Include library ###
        $tsSourceFile = 'IncludeTs.txt.cp';$tsWritePath = 'Configuration/TypoScript/External/Domain/';
        $this->writeTSFile($tsSourceFile,$tsWritePath,$privacyConfigModel);
        
        $this->addFlashMessage('You have successfully updated the configuration.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        
        $this->privacyConfigRepository->update($privacyConfigModel);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\PrivacyConfig $privacyConfig
     * @return void
     */
    public function deleteAction(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\PrivacyConfig $privacyConfig)
    {
        $this->addFlashMessage('You have successfully deleted the domain record.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->privacyConfigRepository->remove($privacyConfig);
        $this->redirect('list');
    }

    /**
    * fetch from external server and stored in own server
    **/
    public function fetchExternal($externalFilePath, $folderName, $fileName){
        if($externalFilePath){
            $directory = GeneralUtility::getFileAbsFileName('fileadmin/cookie_data_privacy/External/'.$folderName.'/');
            
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            $filenameAndPath = $directory.$fileName.'.'.$folderName;
            $getData = file_get_contents($externalFilePath);
            file_put_contents($filenameAndPath, $getData);

            $returnPath = 'fileadmin/cookie_data_privacy/External/'.$folderName.'/'.$fileName.'.'.$folderName;
            return $returnPath;
        }else{
            return '';
        }
    }

    /**
    *
    * write TS file for include library
    */
    public function writeTSFile($tsSourceFile,$tsFilePath,$privacyConfigs){
        $variables = array('privacyConfigs' => $privacyConfigs);

        $standaloneView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $extPath = ExtensionManagementUtility::extPath('cookie_data_privacy');
        
        $templatePathAndFilename = $extPath . 'Resources/Private/External/'.$tsSourceFile;
        $standaloneView->setTemplatePathAndFilename($templatePathAndFilename);
        $standaloneView->assignMultiple($variables);
        $output = $standaloneView->render();

        //write TS
        $directory = $extPath.$tsFilePath;
        $filename = 'Root'.$privacyConfigs->getRootPageUid().'IncludeTs.typoscript';
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $directoryAndFilename = $directory.$filename;
        file_put_contents($directoryAndFilename, trim($output));
        return null;
    }
}
