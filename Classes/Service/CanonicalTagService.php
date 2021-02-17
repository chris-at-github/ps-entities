<?php
namespace Ps\Entity\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class CanonicalTagService {

	/**
	 * @param string $typolink
	 * @param int|null $language
	 * @return string
	 */
	public function getUrl(string $typolink, ?int $language = null) {

		/** @var ContentObjectRenderer $contentObject */
		$contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);

		$instructions = [
			'parameter' => $typolink,
			'forceAbsoluteUrl' => true,
		];

		if($language !== null) {
			$instructions['language'] = $language;
		}

		// Uebersetzung wird selbststaendig von TYPO3 durchgefuehrt wenn auf den Datensatz der Hauptsprache verlinkt wird
		// Wenn die Zielseite nicht in der entsprechenden Sprache vorhanden ist
		return $contentObject->typoLink_URL($instructions);
	}
}