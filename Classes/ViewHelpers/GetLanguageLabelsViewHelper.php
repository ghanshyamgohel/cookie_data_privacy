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
 * <cp:getLanguageLabels fieldName="cookiemessage" sys_language_uid="1" privacyconfig="1" />
  ***/
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class GetLanguageLabelsViewHelper extends AbstractViewHelper {

    /**
     * Initializes arguments for Translate ViewHelper
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('fieldName', 'string', 'fieldName');
        $this->registerArgument('sys_language_uid', 'integer', 'sys_language_uid');
        $this->registerArgument('privacyconfig', 'integer', 'privacyconfig');
    }
    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $fieldName = $arguments['fieldName'];
        $sys_language_uid = (int)$arguments['sys_language_uid'];
        $privacyconfig = (int)$arguments['privacyconfig'];
        
        if($fieldName){
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cookiedataprivacy_domain_model_languagelabels');
            $statement = $queryBuilder
            ->select($fieldName)
            ->from('tx_cookiedataprivacy_domain_model_languagelabels')
            ->where(
                $queryBuilder->expr()->eq('sys_language_uid', $sys_language_uid),
                $queryBuilder->expr()->eq('privacyconfig', $privacyconfig)
            )->execute()->fetch();
            
            return $statement[$fieldName];
        }
        return '';
    }
}
