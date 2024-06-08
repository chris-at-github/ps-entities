<?php

namespace Ps\Entity\EventListener;

use Ps\Entity\Domain\Model\Entity;
use Ps\Entity\Domain\Repository\EntityRepository;
use Ps\Entity\Service\CanonicalTagService;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\DataProcessing\LanguageMenuProcessor;
use TYPO3\CMS\Frontend\Event\ModifyHrefLangTagsEvent;

class HrefLangTagEventListener {

	/**
	 * @var ContentObjectRenderer
	 */
	public $contentObject;

	/**
	 * @var LanguageMenuProcessor
	 */
	protected $languageMenuProcessor;

	/**
	 * @var CanonicalTagService
	 */
	protected $canonicalTagService;

	/**
	 * @param ContentObjectRenderer $contentObject
	 * @param LanguageMenuProcessor $languageMenuProcessor
	 * @param CanonicalTagService $canonicalTagService
	 */
	public function __construct(ContentObjectRenderer $contentObject, LanguageMenuProcessor $languageMenuProcessor, CanonicalTagService $canonicalTagService) {
		$this->contentObject = $contentObject;
		$this->languageMenuProcessor = $languageMenuProcessor;
		$this->canonicalTagService = $canonicalTagService;
	}

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
	 * @param int $uid
	 * @return Entity
	 */
	protected function getEntity($uid) {
		return GeneralUtility::makeInstance(EntityRepository::class)->findByUid($uid);
	}

	/**
	 * @param ModifyHrefLangTagsEvent $event
	 */
	public function __invoke(ModifyHrefLangTagsEvent $event): void {
		$uid = $this->getUid();

		if(empty($uid) === false) {

			/** @var Entity $entity */
			$entity = $this->getEntity($uid);
			$hrefs = [];

			// Verarbeitung nur starten wenn kein Canonical hinterlegt ist -> ansonsten sollte das Hreflang zurueckgesetzt
			// werden
			if(empty($entity->getCanonicalUrl()) === true && $entity->getNoIndex() === false) {
				$xDefault = '';
				$languages = $this->languageMenuProcessor->process($this->contentObject, [], [], []);

				foreach($languages['languagemenu'] as $language) {
					if($language['available'] === 1) {

						$uriOptions = [
							'language' => $language['languageId'],
							'absoluteUri' => true
						];

						if($entity->getMasterCategory() !== null && $entity->getMasterCategory()->getPage() !== null) {
							$uriOptions['category'] = $entity->getMasterCategory();
						}

						$href = $entity->getUri($uriOptions);

						if(empty($href) === false) {
							$hrefs[$language['hreflang']] = $href;

							// Hauptsprache (ID: 0) -> ist nicht ganz sauber, aber vermutlich zu 90% richtig
							if($language['languageId'] === 0) {
								$xDefault = $href;
							}
						}
					}
				}

				if(count($hrefs) > 1 && empty($xDefault) === false) {
					$hrefs['x-default'] = $xDefault;
				}
			}

			// Href komplett zuruecksetzen wenn
			// 	1) aktuell aufgerufene URL nicht vorkommt
			//  2) ein Canonical gesetzt ist
			// Leeres Array fuehrt dazu das kein Hreflang-Tag erstellt wird
			if(
				in_array(GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL'), $hrefs) === false ||
				empty($entity->getCanonicalUrl()) === false
			) {
				$hrefs = [];
			}

			$event->setHrefLangs($hrefs);
		}
	}
}