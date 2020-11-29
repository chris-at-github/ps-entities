<?php

namespace Ps\Entity\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @entity
 */
class Category extends \Ps\Xo\Domain\Model\Category {

	/**
	 * @var \Ps\Xo\Domain\Model\Page
	 */
	protected $page;

	/**
	 * @return \Ps\Xo\Domain\Model\Page
	 */
	public function getPage(): \Ps\Xo\Domain\Model\Page {
		return $this->page;
	}

	/**
	 * @param \Ps\Xo\Domain\Model\Page $page
	 */
	public function setPage(\Ps\Xo\Domain\Model\Page $page): void {
		$this->page = $page;
	}
}