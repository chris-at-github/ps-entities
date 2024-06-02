<?php

namespace Ps\Entity\Domain\Model;

use Ps14\Foundation\Domain\Model\Page;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @entity
 */
class Category extends \Ps14\Foundation\Domain\Model\Category {

	/**
	 * @var Page
	 */
	protected $page;

	/**
	 * @return Page|null
	 */
	public function getPage(): ?Page {
		return $this->page;
	}

	/**
	 * @param Page $page
	 */
	public function setPage(Page $page): void {
		$this->page = $page;
	}
}