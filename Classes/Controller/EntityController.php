<?php

namespace Ps\Entity\Controller;

use Ps14\Foundation\Service\CropImageService;
use Ps\Entity\Provider\PageTitleProvider;
use Ps\Entity\Domain\Model\Entity;
use TYPO3\CMS\Core\MetaTag\Html5MetaTagManager;
use TYPO3\CMS\Core\MetaTag\MetaTagManagerRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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

		if(empty($overwrite['categories']) === false) {
			$options['categories'] = $overwrite['categories'];
		}

		if(empty($options['categories']) === false && gettype($options['categories']) === 'string') {
			$options['categories'] = GeneralUtility::intExplode(',', $options['categories'], true);
		}

		return $options;
	}

//	/**
//	 * action list
//	 *
//	 * @return void
//	 */
//	public function listingAction() {
//		$entities = $this->entityRepository->findAll();
//		$this->view->assign('entities', $entities);
//	}

	/**
	 * @param \Ps\Entity\Domain\Model\Entity
	 * @return void
	 */
	public function showAction($entity) {

		// Content Element Data
		$this->view->assign('record', $this->configurationManager->getContentObject()->data);

		// Zwischenspeichern fuer die weitere Verarbeitung
		$this->setEntity($entity);

		// Title-Tag, Meta-Tags, Social-Media-Tags setzen
		$this->setPageTitle($entity);
		$this->setMetaTags($entity);
		$this->setOgTags($entity);
		$this->setTwitterTags($entity);
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

	/**
	 * @param Entity $entity
	 */
	protected function setOgTags($entity) {
		$this->setOgTitle($entity);
		$this->setOgDescription($entity);
		$this->setOgImage($entity);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setOgTitle($entity) {

		$title = $entity->getTitle();

		if(empty($entity->getOgTitle()) === false) {
			$title = $entity->getOgTitle();

		} elseif(empty($entity->getSeoTitle()) === false) {
			$title = $entity->getSeoTitle();
		}

		/** @var Html5MetaTagManager $metaTagManager */
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('og:title');
		$metaTagManager->addProperty('og:title', $title);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setOgDescription($entity) {

		$description = $entity->getMetaDescription();

		if(empty($entity->getOgDescription()) === false) {
			$description = $entity->getOgDescription();
		}

		if(empty($description) === false) {

			/** @var Html5MetaTagManager $metaTagManager */
			$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('og:description');
			$metaTagManager->addProperty('og:description', $description);
		}
	}

	/**
	 * @param Entity $entity
	 */
	protected function setOgImage($entity) {
		if($entity->getOgImage() !== null) {

			/** @var CropImageService $cropService */
			$cropService = GeneralUtility::makeInstance(CropImageService::class);
			$ogImage = $cropService->crop($entity->getOgImage(), ['maxWidth' => 1200, 'cropVariant' => 'default', 'absolute' => true]);

			if(empty($ogImage) === false) {

				/** @var Html5MetaTagManager $metaTagManager */
				$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('og:image');
				$metaTagManager->addProperty('og:image', $ogImage['uri'], [], true);
			}
		}
	}

	/**
	 * @param Entity $entity
	 */
	protected function setTwitterTags($entity) {
		$this->setTwitterTitle($entity);
		$this->setTwitterDescription($entity);
		$this->setTwitterImage($entity);
		$this->setTwitterCard($entity);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setTwitterTitle($entity) {

		$title = $entity->getTitle();

		if(empty($entity->getTwitterTitle()) === false) {
			$title = $entity->getTwitterTitle();

		} elseif(empty($entity->getSeoTitle()) === false) {
			$title = $entity->getSeoTitle();
		}

		/** @var Html5MetaTagManager $metaTagManager */
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('twitter:title');
		$metaTagManager->addProperty('twitter:title', $title);
	}

	/**
	 * @param Entity $entity
	 */
	protected function setTwitterDescription($entity) {

		$description = $entity->getMetaDescription();

		if(empty($entity->getTwitterDescription()) === false) {
			$description = $entity->getTwitterDescription();
		}

		if(empty($description) === false) {

			/** @var Html5MetaTagManager $metaTagManager */
			$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('twitter:description');
			$metaTagManager->addProperty('twitter:description', $description);
		}
	}

	/**
	 * @param Entity $entity
	 */
	protected function setTwitterImage($entity) {
		if($entity->getTwitterImage() !== null) {

			/** @var CropImageService $cropService */
			$cropService = GeneralUtility::makeInstance(CropImageService::class);
			$twitterImage = $cropService->crop($entity->getTwitterImage(), ['maxWidth' => 800, 'cropVariant' => 'default', 'absolute' => true]);

			if(empty($twitterImage) === false) {

				/** @var Html5MetaTagManager $metaTagManager */
				$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('twitter:image');
				$metaTagManager->addProperty('twitter:image', $twitterImage['uri']);
			}
		}
	}

	/**
	 * @param Entity $entity
	 */
	protected function setTwitterCard($entity) {

		/** @var Html5MetaTagManager $metaTagManager */
		$metaTagManager = GeneralUtility::makeInstance(MetaTagManagerRegistry::class)->getManagerForProperty('twitter:card');
		$metaTagManager->addProperty('twitter:card', $entity->getTwitterCard());
	}
}
