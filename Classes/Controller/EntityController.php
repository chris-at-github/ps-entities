<?php
declare(strict_types=1);

namespace Ps\Entities\Controller;


use Ps\Entities\Provider\PageTitleProvider;

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
class EntityController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * entityRepository
     * 
     * @var \Ps\Entities\Domain\Repository\EntityRepository
     */
    protected $entityRepository = null;

    /**
     * @param \Ps\Entities\Domain\Repository\EntityRepository $entityRepository
     */
    public function injectEntityRepository(\Ps\Entities\Domain\Repository\EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $entities = $this->entityRepository->findAll();
        $this->view->assign('entities', $entities);
    }

    /**
     * action show
     * 
     * @param \Ps\Entities\Domain\Model\Entity $entity
     * @return void
     */
    public function showAction(\Ps\Entities\Domain\Model\Entity $entity)
    {
    	$this->setPageTitle($entity->getTitle());
        $this->view->assign('entity', $entity);
    }

    protected function setPageTitle($title) {
			$titleProvider = $this->objectManager->get(PageTitleProvider::class);
			$titleProvider->setTitle($title);
		}
}
