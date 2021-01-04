<?php
namespace Ps\Entity\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class TcaService
 * @package Ps\Entity
 */
class TcaService {

	/**
	 * Wrapper-Methode um einen typabhaengigen Record-Titel zu generieren. Aufruf:
	 *
	 * $GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['label_userFunc'] = \Ps\Entity\Service\TcaService::class . '->getRecordTitle';
	 * $GLOBALS['TCA']['tx_entity_domain_model_entity']['ctrl']['label_userFunc_options'] = [\Ps\EntityBicycleMarket\Domain\Model\Bicycle::class => \Ps\EntityBicycleMarket\Service\BicycleTcaService::class . '->getTitle'];
	 *
	 * @param array $parameter
	 */
	public function getRecordTitle(&$parameter) {
		if(empty($parameter['options']) === false && key($parameter['options']) === $parameter['row']['tx_extbase_type']) {
			GeneralUtility::callUserFunction(current($parameter['options']), $parameter, $null);
		}
	}
}