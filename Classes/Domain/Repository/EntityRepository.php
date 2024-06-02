<?php
declare(strict_types=1);

namespace Ps\Entity\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

		if(isset($options['records']) === true) {

			// bei Eingabe von festen IDs duerfen nur die IDs der Hauptsprache verwendet werden, Extbase kuemmert sich per
			// Overlay um die korrekte Uebersetzung
			// @see: https://docs.typo3.org/m/typo3/book-extbasefluid/master/en-us/9-CrosscuttingConcerns/1-localizing-and-internationalizing-an-extension.html#typo3-v9-and-higher
			$query->getQuerySettings()->setRespectSysLanguage(false);
			$query->getQuerySettings()->setLanguageOverlayMode(true);

			// immer als Array auswerten
			if(is_array($options['records']) === false) {
				$options['records'] = [$options['records']];
			}

			$matches['records'] = $query->in('uid', $options['records']);
		}

		if(isset($options['masterCategory']) === true) {

			// bei Eingabe von festen IDs duerfen nur die IDs der Hauptsprache verwendet werden, Extbase kuemmert sich per
			// Overlay um die korrekte Uebersetzung
			$query->getQuerySettings()->setLanguageOverlayMode(true);
			$matches['masterCategory'] = $query->equals('masterCategory', $options['masterCategory']);
		}

		if(isset($options['parent']) === true) {
			$matches['parent'] = $query->equals('parent', $options['parent']);
		}

		if(isset($options['categories']) === true) {
			$or = [];

			foreach($options['categories'] as $category) {
				$or[] = $query->contains('categories', (int) $category);
			}

			$matches['categories'] = $query->logicalOr($or);
		}

		return $matches;
	}

	/**
	 * @param array $options
	 * @return QueryResultInterface
	 * @throws InvalidQueryException
	 */
	public function findAllByOption($demand = []) {
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
	public function findByOption($options = []) {
		return $this->findAll($options)->getFirst();
	}
}
