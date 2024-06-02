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
	 * @return Entity|null
	 */
	protected function getEntity() {
		$uid = $this->getUid();

		if(empty($uid) === false) {
			return GeneralUtility::makeInstance(EntityRepository::class)->findByUid($uid);
		}

		return null;
	}

	/**
	 * @param ModifyUrlForCanonicalTagEvent $event
	 */
	public function __invoke(ModifyUrlForCanonicalTagEvent $event): void {
//		$entity = $this->getEntity();
//
//		if($entity !== null) {
//			if($entity->getNoIndex() === false) {
//
//				// gesetzte URL aus dem Enitity verwenden
//				if(empty($entity->getCanonicalUrl()) === false) {
//					$canonical = GeneralUtility::makeInstance(CanonicalTagService::class)->getUrl($entity->getCanonicalUrl());
//
//				// zur Sicherheit nochmal die Canonical setzen (falls das Entity unter mehreren URLs angezeigt wird
//				} else {
//					$uriOptions = [
//						'absoluteUri' => true
//					];
//
//					if($entity->getMasterCategory() !== null && $entity->getMasterCategory()->getPage() !== null) {
//						$uriOptions['category'] = $entity->getMasterCategory();
//					}
//
//					$canonical = $entity->getUri($uriOptions);
//				}
//
//				if(empty($canonical) === false) {
//					$event->setUrl($canonical);
//				}
//			}
//		}
	}
}