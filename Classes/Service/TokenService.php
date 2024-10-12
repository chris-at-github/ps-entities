<?php
namespace Ps\Entity\Service;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TokenService
 * @package Ps\Entity
 */
class TokenService {

	/**
	 * @param string $status
	 * @param string $table
	 * @param string $id
	 * @param array $fields
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler
	 */
	function processDatamap_afterDatabaseOperations($status, $table, $id, &$fields, &$dataHandler) {
		if($table == 'tx_entity_domain_model_entity') {
			$connection = GeneralUtility::makeInstance(ConnectionPool::class)
				->getConnectionForTable('tx_entity_domain_model_entity');

			$sql = "UPDATE tx_entity_domain_model_entity SET token = MD5(uid) WHERE token = ''";
			$connection->executeQuery($sql);
		}
	}
}