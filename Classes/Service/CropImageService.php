<?php
namespace Ps\Entity\Service;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class CropImageService {

	/**
	 * @var ImageService
	 */
	protected $imageService;

	/**
	 * @param ImageService $imageService
	 */
	public function __construct(ImageService $imageService) {
		$this->imageService = $imageService;
	}

	/**
	 * @param FileReference $file
	 * @param array $options
	 * @return array
	 */
	public function crop($file, array $options = []) {

		if($file instanceof \TYPO3\CMS\Extbase\Domain\Model\FileReference) {
			$file = $file->getOriginalResource();
		}

		$arguments = $file->getProperties();

		$cropVariant = $arguments['cropVariant'];
		if(isset($options['cropVariant']) === true) {
			$cropVariant = $options['cropVariant'];
		}

		$cropVariantCollection = CropVariantCollection::create((string) $arguments['crop']);
		$cropArea = $cropVariantCollection->getCropArea($cropVariant);

		$processingConfiguration = [
			'crop' => $cropArea->makeAbsoluteBasedOnFile($file)
		];

		if(isset($options['maxWidth']) === true) {
			$processingConfiguration['maxWidth'] = $options['maxWidth'];
		}

		$processedImage = $file->getOriginalFile()->process(
			ProcessedFile::CONTEXT_IMAGECROPSCALEMASK,
			$processingConfiguration
		);

		$absolute = false;
		if(isset($options['absolute']) === true) {
			$absolute = $options['absolute'];
		}

		return [
			'uri' => $this->imageService->getImageUri($processedImage, $absolute),
			'width' => floor($processedImage->getProperty('width')),
			'height' => floor($processedImage->getProperty('height')),
			'alternative' => $arguments['alternative']
		];
	}
}