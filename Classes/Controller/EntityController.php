<?php
declare(strict_types=1);

namespace Ps\Entity\Controller;

use Ps\Entity\Provider\PageTitleProvider;

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
	 * entityRepository
	 *
	 * @var \Ps\Entity\Domain\Repository\EntityRepository
	 */
	protected $entityRepository = null;

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
	 * @param Ps\Entity\Domain\Model\Entity
	 * @return void
	 */
	public function listAction() {
		$entities = $this->entityRepository->findAll();
		$this->view->assign('entities', $entities);
	}

	/**
	 * action show
	 *
	 * @param Ps\Entity\Domain\Model\Entity
	 * @return void
	 */
	public function showAction(\Ps\Entity\Domain\Model\Entity $entity) {
		$this->setPageTitle($entity->getTitle());
		$this->view->assign('entity', $entity);
	}

	/**
	 * @param $title
	 */
	protected function setPageTitle($title) {
		$titleProvider = $this->objectManager->get(PageTitleProvider::class);
		$titleProvider->setTitle($title);
	}

	/**
	 * @param \Ps\Entity\Domain\Repository\EntityRepository $EntityRepository
	 */
	public function injectEntityRepository(\Ps\Entity\Domain\Repository\EntityRepository $entityRepository) {
		$this->entityRepository = $entityRepository;
	}
}
