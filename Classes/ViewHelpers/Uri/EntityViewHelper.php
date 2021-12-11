<?php

namespace Ps\Entity\ViewHelpers\Uri;

use Ps\Entity\Domain\Model\Category;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2021 Christian Pschorr <pschorr.christian@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Returns a phone based uri with tel: protocol
 */
class EntityViewHelper extends AbstractViewHelper {

	/**
	 * @var \Ps\Entity\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository = null;

	/**
	 * @param \Ps\Entity\Domain\Repository\CategoryRepository $categoryRepository
	 */
	public function injectEntityRepository(\Ps\Entity\Domain\Repository\CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * @var bool
	 */
	protected $escapeOutput = false;

	/**
	 * Initialize all arguments with their description and options.
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('entity', 'object', 'Entity model', true);
		$this->registerArgument('category', 'mixed', 'UID of sys category', false, null);
	}

	/**
	 * @return string
	 */
	protected function render() {
		$uri = '';
		$category = $this->arguments['category'];

		// Keine Kategorie angegeben verwende den Default
		if(empty($category) === true) {
			return $this->arguments['entity']->getLink();
		}

		if(($category instanceof Category) === false) {
			$category = $this->categoryRepository->findByUid((int) $category);
		}

		if($category instanceof Category) {
			$uri = $this->arguments['entity']->getUri(['category' => $category]);
		}

		return $uri;
	}
}
