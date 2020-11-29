<?php

// @see: https://docs.typo3.org/m/typo3/book-extbasefluid/master/en-us/6-Persistence/4-use-foreign-data-sources.html
return [
	\Ps\Entity\Domain\Model\Category::class => [
		'tableName' => 'sys_category',
		'properties' => [
			'page' => [
				'fieldName' => 'tx_entity_page'
			],
		]
	],
];