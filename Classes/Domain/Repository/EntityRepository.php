<?php
declare(strict_types=1);

namespace Ps\Entity\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/***
 *
 * This file is part of the "Entities" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Christian Pschorr <pschorr.christian@gmail.com>
 *
 ***/

/**
 * The repository for Entities
 */
class EntityRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param array $options
	 * @return array
	 */
	protected function getMatches($query, $options) {
		$matches = [];

		if(isset($options['masterCategory']) === true) {

			// bei Eingabe von festen IDs duerfen nur die IDs der Hauptsprache verwendet werden, Extbase kuemmert sich per
			// Overlay um die korrekte Uebersetzung
			$query->getQuerySettings()->setRespectSysLanguage(false);

			$matches[] = $query->equals('masterCategory', $options['masterCategory']);
		}

		return $matches;
	}

	/**
	 * @param array $options
	 * @return QueryResultInterface
	 * @throws InvalidQueryException
	 */
	public function findAll($demand = []) {
		$query = $this->createQuery();

		if(empty($matches = $this->getMatches($query, $demand)) === false) {
			$query->matching($query->logicalAnd($matches));
		}

		return $query->execute();
	}

	/**
	 * @param array $options
	 * @return object
	 * @throws InvalidQueryException
	 */
	public function find($options = []) {
		return $this->findAll($options)->getFirst();
	}
}
