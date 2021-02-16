<?php

namespace Ps\Entity\Controller;

use Ps\Entity\Provider\PageTitleProvider;
use Ps\Entity\Domain\Model\Entity;
use TYPO3\CMS\Core\MetaTag\Html5MetaTagManager;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

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
 * EntityController
 */
class EntityController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \Ps\Entity\Domain\Model\Entity $entity
	 */
	protected $entity = null;

	/**
	 * @var \Ps\Entity\Domain\Repository\EntityRepository
	 */
	protected $entityRepository = null;

	/**
	 * @param \Ps\Entity\Domain\Repository\EntityRepository $EntityRepository
	 */
	public function injectEntityRepository(\Ps\Entity\Domain\Repository\EntityRepository $entityRepository) {
		$this->entityRepository = $entityRepository;
	}

	/**
	 * @return Entity
	 */
	public function getEntity(): ?Entity {
		return $this->entity;
	}

	/**
	 * @param Entity|null $entity
	 */
	public function setEntity(?Entity $entity): void {
		$this->entity = $entity;
	}

	/**
	 * @param array $overwrite
	 * @return array
	 */
	protected function getDemand($overwrite = []) {
		$options = [];

		return $options;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listingAction() {
		$entities = $this->entityRepository->findAll();
		$this->view->assign('entities', $entities);
	}

	/**
	 * @param \Ps\Entity\Domain\Model\Entity
	 * @return void
	 */
	public function showAction($entity) {

		// Zwischenspeichern fuer die weitere Verarbeitung
		$this->setEntity($entity);

		// Title-Tag, Meta-Tags, Social-Media-Tags setzen
		$this->setPageTitle($entity);
		$this->setMetaTags($entity);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setPageTitle($entity) {

		$title = $entity->getTitle();
		if(empty($entity->getSeoTitle()) === false) {
			$title = $entity->getSeoTitle();
		}

		/** @var PageTitleProvider $titleProvider */
		$titleProvider = GeneralUtility::makeInstance(PageTitleProvider::class);
		$titleProvider->setTitle($title);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setMetaTags($entity) {
		$this->setMetaDescription($entity);
		$this->setRobotsTag($entity);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setMetaDescription($entity) {

		/** @var Html5MetaTagManager $metaTagManager */
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('description');
		$metaTagManager->addProperty('description', $entity->getMetaDescription());
	}

	/**
	 * @param Entity $entity
	 */
	protected function setRobotsTag($entity) {

		$robots = [];

		if($entity->getNoIndex() === true) {
			$robots[] = 'noindex';
		}

		if($entity->getNoFollow() === true) {
			$robots[] = 'nofollow';
		}

		if(empty($robots) === false) {

			/** @var Html5MetaTagManager $metaTagManager */
			$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('robots');
			$metaTagManager->addProperty('robots', implode(', ', $robots));
		}
	}
}
