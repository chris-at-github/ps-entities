<?php

namespace Ps\Entity\DataProcessing;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * AddressProcessor fuer TtAddress Datensaetze, die innerhalb von Content Elementen (FSCEs) verknuepft sind. Diese werden
 * im Feld tx_xo_content innerhalb der Tabelle tt_address mit der UID des Content Elements versehen
 */
class BreadcrumbProcessor implements DataProcessorInterface {
	/**
	 * Parst die Inhalte aller verknupeften Inhaltselemente
	 *
	 * @param ContentObjectRenderer $cObject The data of the content element or page
	 * @param array $contentObjectConfiguration The configuration of Content Object
	 * @param array $processorConfiguration The configuration of this processor
	 * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
	 * @return array the processed data as key/value store
	 */
	public function process(ContentObjectRenderer $cObject, array $contentObjectConfiguration, array $processorConfiguration, array $processedData) {

		DebuggerUtility::var_dump($processedData);

		return $processedData;
	}
}