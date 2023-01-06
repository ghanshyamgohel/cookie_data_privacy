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
 * FileIncludeController
 */
use TYPO3\CMS\Extbase\Annotation as Extbase;

class FileIncludeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
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
        $fileIncludes = $this->fileIncludeRepository->findAll();
        $this->view->assign('fileIncludes', $fileIncludes);
    }

    /**
     * action show
     *
     * @param \TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $fileInclude
     * @return void
     */
    public function showAction(\TYPO3Liebhaber\CookieDataPrivacy\Domain\Model\FileInclude $fileInclude)
    {
        $this->view->assign('fileInclude', $fileInclude);
    }
}
