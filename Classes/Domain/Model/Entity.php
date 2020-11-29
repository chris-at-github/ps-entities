<?php
declare(strict_types=1);

namespace Ps\Entity\Domain\Model;


use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extbase\Annotation\Inject;

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
 * Entity
 */
class Entity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @Inject
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * title
	 *
	 * @var string
	 * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
	 */
	protected $title = '';

	/**
	 * slug
	 *
	 * @var string
	 */
	protected $slug = '';

	/**
	 * masterCategory
	 *
	 * @var \Ps\Entity\Domain\Model\Category
	 */
	protected $masterCategory;

	/**
	 * image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $image = null;

	/**
	 * media
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $media = null;

	/**
	 * files
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $files = null;

	/**
	 * metaDescription
	 *
	 * @var string
	 */
	protected $metaDescription = '';

	/**
	 * shortDescription
	 *
	 * @var string
	 */
	protected $shortDescription = '';

	/**
	 * longDescription
	 *
	 * @var string
	 */
	protected $longDescription = '';

	/**
	 * teaser
	 *
	 * @var string
	 */
	protected $teaser = '';

	/**
	 * canonicalUrl
	 *
	 * @var string
	 */
	protected $canonicalUrl = '';

	/**
	 * noIndex
	 *
	 * @var bool
	 */
	protected $noIndex = false;

	/**
	 * noFollow
	 *
	 * @var bool
	 */
	protected $noFollow = false;

	/**
	 * sitemapChangeFrequency
	 *
	 * @var int
	 */
	protected $sitemapChangeFrequency = 0;

	/**
	 * sitemapPriority
	 *
	 * @var float
	 */
	protected $sitemapPriority = 0.0;

	/**
	 * seoTitle
	 *
	 * @var string
	 */
	protected $seoTitle = '';

	/**
	 * ogTitle
	 *
	 * @var string
	 */
	protected $ogTitle = '';

	/**
	 * ogDescription
	 *
	 * @var string
	 */
	protected $ogDescription = '';

	/**
	 * ogImage
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $ogImage = null;

	/**
	 * twitterTitle
	 *
	 * @var string
	 */
	protected $twitterTitle = '';

	/**
	 * twitterDescription
	 *
	 * @var string
	 */
	protected $twitterDescription = '';

	/**
	 * twitterImage
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $twitterImage = null;

	/**
	 * twitterCard
	 *
	 * @var int
	 */
	protected $twitterCard = 0;

	/**
	 * related
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ps\Entity\Domain\Model\Entity>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
	 */
	protected $related = null;



	/**
	 * __construct
	 */
	public function __construct() {

		//Do not remove the next line: It would break the functionality
		$this->initializeObject();
	}

	/**
	 * Initializes all ObjectStorage properties when model is reconstructed from DB (where __construct is not called)
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initializeObject() {
		$this->media = $this->media ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->files = $this->files ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->related = $this->related ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the slug
	 *
	 * @return string slug
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * Sets the slug
	 *
	 * @param string $slug
	 * @return void
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
	}

	/**
	 * Returns the masterCategory
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\Category $masterCategory
	 */
	public function getMasterCategory() {
		return $this->masterCategory;
	}

	/**
	 * Sets the masterCategory
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $masterCategory
	 * @return void
	 */
	public function setMasterCategory($masterCategory) {
		$this->masterCategory = $masterCategory;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium
	 * @return void
	 */
	public function addMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $medium) {
		$this->media->attach($medium);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediumToRemove) {
		$this->media->detach($mediumToRemove);
	}

	/**
	 * Returns the media
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
	 */
	public function getMedia() {
		return $this->media;
	}

	/**
	 * Sets the media
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
	 * @return void
	 */
	public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $media) {
		$this->media = $media;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function addFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file) {
		$this->files->attach($file);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileToRemove) {
		$this->files->detach($fileToRemove);
	}

	/**
	 * Returns the files
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * Sets the files
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 * @return void
	 */
	public function setFiles(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $files) {
		$this->files = $files;
	}

	/**
	 * Returns the metaDescription
	 *
	 * @return string $metaDescription
	 */
	public function getMetaDescription() {
		return $this->metaDescription;
	}

	/**
	 * Sets the metaDescription
	 *
	 * @param string $metaDescription
	 * @return void
	 */
	public function setMetaDescription($metaDescription) {
		$this->metaDescription = $metaDescription;
	}

	/**
	 * Returns the shortDescription
	 *
	 * @return string $shortDescription
	 */
	public function getShortDescription() {
		return $this->shortDescription;
	}

	/**
	 * Sets the shortDescription
	 *
	 * @param string $shortDescription
	 * @return void
	 */
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
	}

	/**
	 * Returns the longDescription
	 *
	 * @return string $longDescription
	 */
	public function getLongDescription() {
		return $this->longDescription;
	}

	/**
	 * Sets the longDescription
	 *
	 * @param string $longDescription
	 * @return void
	 */
	public function setLongDescription($longDescription) {
		$this->longDescription = $longDescription;
	}

	/**
	 * Returns the teaser
	 *
	 * @return string $teaser
	 */
	public function getTeaser() {
		return $this->teaser;
	}

	/**
	 * Sets the teaser
	 *
	 * @param string $teaser
	 * @return void
	 */
	public function setTeaser($teaser) {
		$this->teaser = $teaser;
	}

	/**
	 * Returns the canonicalUrl
	 *
	 * @return string $canonicalUrl
	 */
	public function getCanonicalUrl() {
		return $this->canonicalUrl;
	}

	/**
	 * Sets the canonicalUrl
	 *
	 * @param string $canonicalUrl
	 * @return void
	 */
	public function setCanonicalUrl($canonicalUrl) {
		$this->canonicalUrl = $canonicalUrl;
	}

	/**
	 * Returns the noIndex
	 *
	 * @return bool $noIndex
	 */
	public function getNoIndex() {
		return $this->noIndex;
	}

	/**
	 * Sets the noIndex
	 *
	 * @param bool $noIndex
	 * @return void
	 */
	public function setNoIndex($noIndex) {
		$this->noIndex = $noIndex;
	}

	/**
	 * Returns the boolean state of noIndex
	 *
	 * @return bool
	 */
	public function isNoIndex() {
		return $this->noIndex;
	}

	/**
	 * Returns the noFollow
	 *
	 * @return bool $noFollow
	 */
	public function getNoFollow() {
		return $this->noFollow;
	}

	/**
	 * Sets the noFollow
	 *
	 * @param bool $noFollow
	 * @return void
	 */
	public function setNoFollow($noFollow) {
		$this->noFollow = $noFollow;
	}

	/**
	 * Returns the boolean state of noFollow
	 *
	 * @return bool
	 */
	public function isNoFollow() {
		return $this->noFollow;
	}

	/**
	 * Returns the sitemapChangeFrequency
	 *
	 * @return int $sitemapChangeFrequency
	 */
	public function getSitemapChangeFrequency() {
		return $this->sitemapChangeFrequency;
	}

	/**
	 * Sets the sitemapChangeFrequency
	 *
	 * @param int $sitemapChangeFrequency
	 * @return void
	 */
	public function setSitemapChangeFrequency($sitemapChangeFrequency) {
		$this->sitemapChangeFrequency = $sitemapChangeFrequency;
	}

	/**
	 * Returns the sitemapPriority
	 *
	 * @return float $sitemapPriority
	 */
	public function getSitemapPriority() {
		return $this->sitemapPriority;
	}

	/**
	 * Sets the sitemapPriority
	 *
	 * @param float $sitemapPriority
	 * @return void
	 */
	public function setSitemapPriority($sitemapPriority) {
		$this->sitemapPriority = $sitemapPriority;
	}

	/**
	 * Returns the seoTitle
	 *
	 * @return string $seoTitle
	 */
	public function getSeoTitle() {
		return $this->seoTitle;
	}

	/**
	 * Sets the seoTitle
	 *
	 * @param string $seoTitle
	 * @return void
	 */
	public function setSeoTitle($seoTitle) {
		$this->seoTitle = $seoTitle;
	}

	/**
	 * Returns the ogTitle
	 *
	 * @return string $ogTitle
	 */
	public function getOgTitle() {
		return $this->ogTitle;
	}

	/**
	 * Sets the ogTitle
	 *
	 * @param string $ogTitle
	 * @return void
	 */
	public function setOgTitle($ogTitle) {
		$this->ogTitle = $ogTitle;
	}

	/**
	 * Returns the ogDescription
	 *
	 * @return string $ogDescription
	 */
	public function getOgDescription() {
		return $this->ogDescription;
	}

	/**
	 * Sets the ogDescription
	 *
	 * @param string $ogDescription
	 * @return void
	 */
	public function setOgDescription($ogDescription) {
		$this->ogDescription = $ogDescription;
	}

	/**
	 * Returns the ogImage
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $ogImage
	 */
	public function getOgImage() {
		return $this->ogImage;
	}

	/**
	 * Sets the ogImage
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $ogImage
	 * @return void
	 */
	public function setOgImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $ogImage) {
		$this->ogImage = $ogImage;
	}

	/**
	 * Returns the twitterTitle
	 *
	 * @return string $twitterTitle
	 */
	public function getTwitterTitle() {
		return $this->twitterTitle;
	}

	/**
	 * Sets the twitterTitle
	 *
	 * @param string $twitterTitle
	 * @return void
	 */
	public function setTwitterTitle($twitterTitle) {
		$this->twitterTitle = $twitterTitle;
	}

	/**
	 * Returns the twitterDescription
	 *
	 * @return string $twitterDescription
	 */
	public function getTwitterDescription() {
		return $this->twitterDescription;
	}

	/**
	 * Sets the twitterDescription
	 *
	 * @param string $twitterDescription
	 * @return void
	 */
	public function setTwitterDescription($twitterDescription) {
		$this->twitterDescription = $twitterDescription;
	}

	/**
	 * Returns the twitterImage
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $twitterImage
	 */
	public function getTwitterImage() {
		return $this->twitterImage;
	}

	/**
	 * Sets the twitterImage
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $twitterImage
	 * @return void
	 */
	public function setTwitterImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $twitterImage) {
		$this->twitterImage = $twitterImage;
	}

	/**
	 * Returns the twitterCard
	 *
	 * @return int $twitterCard
	 */
	public function getTwitterCard() {
		return $this->twitterCard;
	}

	/**
	 * Sets the twitterCard
	 *
	 * @param int $twitterCard
	 * @return void
	 */
	public function setTwitterCard($twitterCard) {
		$this->twitterCard = $twitterCard;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getRelated(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage {
		return $this->related;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $related
	 */
	public function setRelated(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $related): void {
		$this->related = $related;
	}

	/**
	 * @return array
	 */
	protected function getLinkArguments() {
		return [
			'extension' => 'Entity',
			'controller' => 'Entity',
			'action' => 'show',
			'plugin' => 'Frontend',
			'arguments' => [
				'entity' => $this->getUid()
			]
		];
	}

	/**
	 * @return string
	 */
	public function getLink() {
		$link = '';

		if($this->getMasterCategory() !== null && $this->getMasterCategory()->getPage() !== null) {

			/** @var UriBuilder $uriBuilder */
			$uriBuilder = $this->objectManager->get(UriBuilder::class);
			$arguments = $this->getLinkArguments();
			$link = $uriBuilder
				->reset()
				->setTargetPageUid($this->getMasterCategory()->getPage()->getUid())
				->uriFor($arguments['action'], $arguments['arguments'], $arguments['controller'], $arguments['extension'], $arguments['plugin']);
		}

		return $link;
	}
}
