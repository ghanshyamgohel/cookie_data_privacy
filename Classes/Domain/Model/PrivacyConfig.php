<?php
namespace TYPO3Liebhaber\CookieDataPrivacy\Domain\Model;

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
 * PrivacyConfig
 */
use TYPO3\CMS\Extbase\Annotation\ORM\Cascade;

class PrivacyConfig extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * inFooter
     *
     * @var bool
     */
    protected $inFooter = false;

    /**
     * jsScript
     *
     * @var string
     */
    protected $jsScript = '';

    /**
     * enableFormPrivacy
     *
     * @var bool
     */
    protected $enableFormPrivacy = false;

    /**
     * formId
     *
     * @var string
     */
    protected $formId = '';

    /**
     * position
     *
     * @var string
     */
    protected $position = '';

    /**
     * popupBackground
     *
     * @var string
     */
    protected $popupBackground = '';

    /**
     * buttonBackground
     *
     * @var string
     */
    protected $buttonBackground = '';

    /**
     * domain
     *
     * @var string
     */
    protected $domain = '';

    /**
     * expiryDay
     *
     * @var int
     */
    protected $expiryDay = 0;

    /**
     * cookiePageUid
     *
     * @var int
     */
    protected $cookiePageUid = 0;

    /**
     * dataPrivacyPageUid
     *
     * @var int
     */
    protected $dataPrivacyPageUid = 0;

    /**
     * rootPageUid
     *
     * @var int
     */
    protected $rootPageUid = 0;

    /**
     * jsPathExternal
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude>
     * @cascade remove
     */
    protected $jsPathExternal = null;

    /**
     * cssPathExternal
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude>
     * @cascade remove
     */
    protected $cssPathExternal = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->jsPathExternal = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->cssPathExternal = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the inFooter
     *
     * @return bool $inFooter
     */
    public function getInFooter()
    {
        return $this->inFooter;
    }

    /**
     * Sets the inFooter
     *
     * @param bool $inFooter
     * @return void
     */
    public function setInFooter($inFooter)
    {
        $this->inFooter = $inFooter;
    }

    /**
     * Returns the boolean state of inFooter
     *
     * @return bool
     */
    public function isInFooter()
    {
        return $this->inFooter;
    }

    /**
     * Returns the jsScript
     *
     * @return string $jsScript
     */
    public function getJsScript()
    {
        return $this->jsScript;
    }

    /**
     * Sets the jsScript
     *
     * @param string $jsScript
     * @return void
     */
    public function setJsScript($jsScript)
    {
        $this->jsScript = $jsScript;
    }

    /**
     * Returns the enableFormPrivacy
     *
     * @return bool $enableFormPrivacy
     */
    public function getEnableFormPrivacy()
    {
        return $this->enableFormPrivacy;
    }

    /**
     * Sets the enableFormPrivacy
     *
     * @param bool $enableFormPrivacy
     * @return void
     */
    public function setEnableFormPrivacy($enableFormPrivacy)
    {
        $this->enableFormPrivacy = $enableFormPrivacy;
    }

    /**
     * Returns the boolean state of enableFormPrivacy
     *
     * @return bool
     */
    public function isEnableFormPrivacy()
    {
        return $this->enableFormPrivacy;
    }

    /**
     * Returns the formId
     *
     * @return string $formId
     */
    public function getFormId()
    {
        return $this->formId;
    }

    /**
     * Sets the formId
     *
     * @param string $formId
     * @return void
     */
    public function setFormId($formId)
    {
        $this->formId = $formId;
    }
    
    /**
     * Returns the position
     *
     * @return string $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position
     *
     * @param string $position
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
    /**
     * Returns the popupBackground
     *
     * @return string $popupBackground
     */
    public function getPopupBackground()
    {
        return $this->popupBackground;
    }

    /**
     * Sets the popupBackground
     *
     * @param string $popupBackground
     * @return void
     */
    public function setPopupBackground($popupBackground)
    {
        $this->popupBackground = $popupBackground;
    }

    /**
     * Returns the buttonBackground
     *
     * @return string $buttonBackground
     */
    public function getButtonBackground()
    {
        return $this->buttonBackground;
    }

    /**
     * Sets the buttonBackground
     *
     * @param string $buttonBackground
     * @return void
     */
    public function setButtonBackground($buttonBackground)
    {
        $this->buttonBackground = $buttonBackground;
    }

    /**
     * Returns the domain
     *
     * @return string $domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Sets the domain
     *
     * @param string $domain
     * @return void
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Returns the expiryDay
     *
     * @return int $expiryDay
     */
    public function getExpiryDay()
    {
        return $this->expiryDay;
    }

    /**
     * Sets the expiryDay
     *
     * @param int $expiryDay
     * @return void
     */
    public function setExpiryDay($expiryDay)
    {
        $this->expiryDay = $expiryDay;
    }

    /**
     * Returns the cookiePageUid
     *
     * @return int $cookiePageUid
     */
    public function getCookiePageUid()
    {
        return $this->cookiePageUid;
    }

    /**
     * Sets the cookiePageUid
     *
     * @param int $cookiePageUid
     * @return void
     */
    public function setCookiePageUid($cookiePageUid)
    {
        $this->cookiePageUid = $cookiePageUid;
    }
    
    /**
     * Returns the rootPageUid
     *
     * @return int $rootPageUid
     */
    public function getRootPageUid()
    {
        return $this->rootPageUid;
    }

    /**
     * Sets the rootPageUid
     *
     * @param int $rootPageUid
     * @return void
     */
    public function setRootPageUid($rootPageUid)
    {
        $this->rootPageUid = $rootPageUid;
    }

    /**
     * Returns the dataPrivacyPageUid
     *
     * @return int $dataPrivacyPageUid
     */
    public function getDataPrivacyPageUid()
    {
        return $this->dataPrivacyPageUid;
    }

    /**
     * Sets the dataPrivacyPageUid
     *
     * @param int $dataPrivacyPageUid
     * @return void
     */
    public function setDataPrivacyPageUid($dataPrivacyPageUid)
    {
        $this->dataPrivacyPageUid = $dataPrivacyPageUid;
    }

    /**
     * Adds a FileInclude
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $jsPathExternal
     * @return void
     */
    public function addJsPathExternal(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $jsPathExternal)
    {
        $this->jsPathExternal->attach($jsPathExternal);
    }

    /**
     * Removes a FileInclude
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $jsPathExternalToRemove The FileInclude to be removed
     * @return void
     */
    public function removeJsPathExternal(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $jsPathExternalToRemove)
    {
        $this->jsPathExternal->detach($jsPathExternalToRemove);
    }

    /**
     * Returns the jsPathExternal
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude> $jsPathExternal
     */
    public function getJsPathExternal()
    {
        return $this->jsPathExternal;
    }

    /**
     * Sets the jsPathExternal
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude> $jsPathExternal
     * @return void
     */
    public function setJsPathExternal(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $jsPathExternal)
    {
        $this->jsPathExternal = $jsPathExternal;
    }

    /**
     * Adds a FileInclude
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $cssPathExternal
     * @return void
     */
    public function addCssPathExternal(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $cssPathExternal)
    {
        $this->cssPathExternal->attach($cssPathExternal);
    }

    /**
     * Removes a FileInclude
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $cssPathExternalToRemove The FileInclude to be removed
     * @return void
     */
    public function removeCssPathExternal(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $cssPathExternalToRemove)
    {
        $this->cssPathExternal->detach($cssPathExternalToRemove);
    }

    /**
     * Returns the cssPathExternal
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude> $cssPathExternal
     */
    public function getCssPathExternal()
    {
        return $this->cssPathExternal;
    }

    /**
     * Sets the cssPathExternal
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude> $cssPathExternal
     * @return void
     */
    public function setCssPathExternal(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $cssPathExternal)
    {
        $this->cssPathExternal = $cssPathExternal;
    }
}
