<?php

namespace Ps\Entity\EventListener;

use Ps\Entity\Domain\Model\Entity;
use Ps\Entity\Domain\Repository\EntityRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Seo\Event\ModifyUrlForCanonicalTagEvent;

class CanonicalTagEventListener {
	public function __invoke(ModifyUrlForCanonicalTagEvent $event): void {
		$request = GeneralUtility::_GET('tx_entityproduct_frontend');
		$uid = null;

		if(isset($request['product']) === true) {
			$uid = (int) $request['product'];
		}

		if(empty($uid) === false) {

			/** @var Entity $entity */
			$entity = GeneralUtility::makeInstance(EntityRepository::class)->findByUid($uid);

			if(empty($entity->getCanonicalUrl()) === false && $entity->getNoIndex() === false) {

				/** @var ContentObjectRenderer $contentObject */
				$contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);

				$instructions = [
					'parameter' => $entity->getCanonicalUrl(),
					'forceAbsoluteUrl' => true,
				];

				// Uebersetzung wird selbststaendig von TYPO3 durchgefuehrt wenn auf den Datensatz der Hauptsprache verlinkt wird
				// Wenn die Zielseite nicht in der entsprechenden Sprache vorhanden ist
				$canonical = $contentObject->typoLink_URL($instructions);

				if(empty($canonical) === false) {
					$event->setUrl($canonical);
				}
			}
		}
	}
}