<?php

namespace Ps\Entity\EventListener;

use Ps\Entity\Domain\Model\Entity;
use Ps\Entity\Domain\Repository\EntityRepository;
use Ps\Entity\Service\CanonicalTagService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Seo\Event\ModifyUrlForCanonicalTagEvent;

class CanonicalTagEventListener {

	/**
	 * @return int|null
	 */
	protected function getUid(): ?int {
		$request = GeneralUtility::_GET('tx_entity_frontend');

		if(isset($request['entity']) === true) {
			return (int) $request['entity'];
		}

		return null;
	}

	/**
	 * @param ModifyUrlForCanonicalTagEvent $event
	 */
	public function __invoke(ModifyUrlForCanonicalTagEvent $event): void {
		$uid = $this->getUid();

		if(empty($uid) === false) {

			/** @var Entity $entity */
			$entity = GeneralUtility::makeInstance(EntityRepository::class)->findByUid($uid);

			if(empty($entity->getCanonicalUrl()) === false && $entity->getNoIndex() === false) {
				$canonical = GeneralUtility::makeInstance(CanonicalTagService::class)->getUrl($entity->getCanonicalUrl());

				if(empty($canonical) === false) {
					$event->setUrl($canonical);
				}
			}
		}
	}
}