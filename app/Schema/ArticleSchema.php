<?php

namespace WebAppick\WPListInfo\Middleware\Schema;


namespace MyPlugin\Schema;

class ArticleSchema extends AbstractSchema
{
	protected $schemaType = 'Article';
	
	public function getDefaultMappings(): array
	{
		return [
			'headline' => ['label' => 'Article Headline', 'mapping' => 'post_title'],
			'description' => ['label' => 'Article Description', 'mapping' => 'post_excerpt'],
			'author' => ['label' => 'Author', 'mapping' => 'post_author'],
			'datePublished' => ['label' => 'Date Published', 'mapping' => 'post_date'],
		];
	}
}
