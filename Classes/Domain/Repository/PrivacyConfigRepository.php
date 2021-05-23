<?php
namespace TYPO3Liebhaber\CookieDataPrivacy\Domain\Repository;

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
 * The repository for PrivacyConfigs
 */
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
class PrivacyConfigRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	public function initializeObject(){
        // get the current settings
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        // change the default setting, whether the storage page ID is ignored by the plugins (FALSE) or not (TRUE - default setting)
        $querySettings->setRespectStoragePage(FALSE);
        // store the new setting(s)
        $this->setDefaultQuerySettings($querySettings);
	}

    /**
     * find by field
     */
    public function findByRootPageUid($rootPageUid){
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_cookiedataprivacy_domain_model_privacyconfig');
        $statement = $queryBuilder
        ->select('uid')
        ->from('tx_cookiedataprivacy_domain_model_privacyconfig')
        ->where(
            $queryBuilder->expr()->eq('root_page_uid', $rootPageUid)
        )->execute()->fetch();
        $uid = (int)$statement['uid'];
        return $this->findByIdentifier($uid);
    }
}
