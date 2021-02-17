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
	 * @param ModifyHrefLangTagsEvent $event
	 */
	public function __invoke(ModifyHrefLangTagsEvent $event): void {
		$uid = $this->getUid();

		if(empty($uid) === false) {

			/** @var Entity $entity */
			$entity = GeneralUtility::makeInstance(EntityRepository::class)->findByUid($uid);

			if(empty($entity->getCanonicalUrl()) === false && $entity->getNoIndex() === false) {

				$xDefault = '';
				$hrefs = [];
				$languages = $this->languageMenuProcessor->process($this->contentObject, [], [], []);

				foreach($languages['languagemenu'] as $language) {
					if($language['available'] === 1) {
						$href = $this->canonicalTagService->getUrl($entity->getCanonicalUrl(), $language['languageId']);

						if(empty($href) === false) {
							$hrefs[$language['hreflang']] = $href;

							if($language['active'] === 1) {
								$xDefault = $href;
							}
						}
					}
				}

				if(count($hrefs) > 1 && empty($xDefault) === false) {
					$hrefs['x-default'] = $xDefault;
				}

				$event->setHrefLangs($hrefs);
			}
		}
	}
}