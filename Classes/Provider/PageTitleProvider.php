<?php

namespace Ps\Entity\Provider;

use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class PageTitleProvider extends AbstractPageTitleProvider {

	/**
	 * @param string $title
	 */
	public function setTitle(string $title) {
		$this->title = $title;
	}
}