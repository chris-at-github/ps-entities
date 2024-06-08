<?php

declare(strict_types=1);

namespace Ps\Entity\XmlSitemap;

use cogpowered\FineDiff\Parser\Operations\Delete;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Seo\XmlSitemap\Exception\MissingConfigurationException;

/**
 * XmlSiteDataProvider will provide information for the XML sitemap for a specific database table
 * @internal this class is not part of TYPO3's Core API.
 */

// auf Version 12 verschoben -> extends \TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider fuehrt zu einem Fehler
class RecordsXmlSitemapDataProvider extends \TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider {
//class RecordsXmlSitemapDataProvider {

	/**
	 * @var array
	 */
	protected $masterCategories = [];

	/**
	 * @param int $categoryUid
	 * @return int
	 * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException
	 * @throws \TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException
	 */
	protected function getMasterCategoryPageUid(int $categoryUid): int {
		if(empty($this->masterCategories) === true) {

			/** @var QueryBuilder $queryBuilder */
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
			$statement = $queryBuilder
				->select('uid')
				->from('sys_category')
				->where(
					$queryBuilder->expr()->eq('tx_foundation_identifier', $queryBuilder->createNamedParameter('entity-product-main', Connection::PARAM_STR)),
					$queryBuilder->expr()->in('sys_language_uid', [0, -1])
				)
				->execute();
			$master = $statement->fetchAssociative();

			if($master !== false) {

				/** @var QueryBuilder $queryBuilder */
				$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
				$statement = $queryBuilder
					->select('uid', 'tx_entity_page')
					->from('sys_category')
					->where(
						$queryBuilder->expr()->eq('parent', $queryBuilder->createNamedParameter((int) $master['uid'], Connection::PARAM_INT)),
						$queryBuilder->expr()->in('sys_language_uid', [0, -1])
					)
					->execute();

				while($row = $statement->fetchAssociative()) {
					$this->masterCategories[(int)$row['uid']] = (int) $row['tx_entity_page'];
				}
			}
		}

		if(array_key_exists($categoryUid, $this->masterCategories) === true) {
			return $this->masterCategories[$categoryUid];
		}

		return 0;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	protected function defineUrl(array $data): array {
		if(empty($data['data']['master_category']) === true) {
			return $data;
		}

		$pageId = $this->getMasterCategoryPageUid($data['data']['master_category']);
		$additionalParams = [];

		$additionalParams = $this->getUrlFieldParameterMap($additionalParams, $data['data']);
		$additionalParams = $this->getUrlAdditionalParams($additionalParams);

		$additionalParamsString = http_build_query(
			$additionalParams,
			'',
			'&',
			PHP_QUERY_RFC3986
		);

		$typoLinkConfig = [
			'parameter' => $pageId,
			'additionalParams' => $additionalParamsString ? '&' . $additionalParamsString : '',
			'forceAbsoluteUrl' => 1,
		];

		$data['loc'] = $this->cObj->typoLink_URL($typoLinkConfig);

		return $data;
	}
}
