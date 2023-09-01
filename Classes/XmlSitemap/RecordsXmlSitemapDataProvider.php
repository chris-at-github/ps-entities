<?php

declare(strict_types=1);

namespace Ps\Entity\XmlSitemap;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * XmlSiteDataProvider will provide information for the XML sitemap for a specific database table
 * @internal this class is not part of TYPO3's Core API.
 */
class RecordsXmlSitemapDataProvider extends \TYPO3\CMS\Seo\XmlSitemap\RecordsXmlSitemapDataProvider {

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
			$extensionConfiguration = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class)->get('entity_product');

			/** @var QueryBuilder $queryBuilder */
			$queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
			$statement = $queryBuilder
				->select('uid', 'tx_entity_page')
				->from('sys_category')
				->where(
					$queryBuilder->expr()->eq('parent', $queryBuilder->createNamedParameter((int)$extensionConfiguration['parentMasterProductCategory'], Connection::PARAM_INT)),
					$queryBuilder->expr()->in('sys_language_uid', [0, -1])
				)
				->execute();

			while($row = $statement->fetch()) {
				$this->masterCategories[(int)$row['uid']] = (int) $row['tx_entity_page'];
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
