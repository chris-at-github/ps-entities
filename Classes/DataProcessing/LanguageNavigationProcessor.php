<?php

namespace Ps\Entity\DataProcessing;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class LanguageNavigationProcessor implements DataProcessorInterface {

	/**
	 * @return TypoScriptFrontendController
	 */
	protected function getTypoScriptFrontendController() {
		return $GLOBALS['TSFE'];
	}

	/**
	 * Parst die Inhalte aller verknupeften Inhaltselemente
	 *
	 * @param ContentObjectRenderer $cObject The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObject, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {
//		if(isset($processedData['navigationLanguage']) === true) {
//
//			try {
//				$arguments = $this->getTypoScriptFrontendController()->getPageArguments()->getArguments();
//				$argumentPrefix = $processorConfiguration['argumentPrefix'];
//				$uid = (int) $arguments[$argumentPrefix][$processorConfiguration['uidArgument']];
//
//				if(empty($uid) === false) {
//
//					/** @var QueryBuilder $queryBuilder */
//					$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tx_entity_domain_model_entity');
//
//					/** @var Site $site */
//					$site = GeneralUtility::makeInstance(SiteFinder::class)->getSiteByPageId((int) $this->getTypoScriptFrontendController()->id);
//
//					// Durchlaufe alle verfuegbaren Sprachen aus dem Language Menu
//					// Pruefe ob die eigentliche Seite uebersetzt ist
//					foreach($processedData['navigationLanguage'] as &$language) {
//
//						if($language['available'] === 1) {
//							$statement = $queryBuilder
//								->select('*')
//								->from('tx_entity_domain_model_entity')
//								->orWhere(
//									$queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid)),
//									$queryBuilder->expr()->eq('l10n_parent', $queryBuilder->createNamedParameter($uid))
//								)
//								->andWhere($queryBuilder->expr()->eq('sys_language_uid', $queryBuilder->createNamedParameter((int) $language['languageUid'])))
//								->execute();
//
//							// Wenn es einen Datensatz gibt wurde er in angegebene Sprache uebersetzt
//							if($statement->fetch() !== false) {
//								$language['link'] = $site->getRouter()->generateUri((int) $this->getTypoScriptFrontendController()->id, [
//									$argumentPrefix => $arguments[$argumentPrefix],
//									'_language' => (int) $language['languageUid']
//								])->getPath();
//
//								// deaktiviere den Sprachlink, auch wenn die Detailseite uebersetzt
//							} else {
//								$language['available'] = 0;
//							}
//						}
//					}
//				}
//
//			// es gibt nichts abzufangen -> wenn der Parameter nicht in der vorhanden ist fuege nichts dem Breadcrumb hinzu
//			} catch(\RuntimeException $exception) {}
//		}

		return $processedData;
	}
}