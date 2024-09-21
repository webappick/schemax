<?php

namespace Schemax\App\Schema;


/**
 * Class PostSchema
 *
 * @package    CTXFeed
 * @subpackage Schemax\App\Schema
 * @author     Ohidul Islam <wahid0003@gmail.com>
 * @link       https://webappick.com
 * @license    https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category   MyCategory
 */
class PostSchema extends AbstractSchema{

	public function getDefaultMappings(): array {
		return [
			'name'        => [ 'mapping' => 'post_title' ],
			'description' => [ 'mapping' => 'post_content' ],
			'author'      => [ 'mapping' => 'post_author' ],
			'datePublished' => [ 'mapping' => 'post_date' ],
			'dateModified' => [ 'mapping' => 'post_modified' ],
			'headline'    => [ 'mapping' => 'post_title' ],
			'publisher'   => [
				'mapping' => 'post_author',
				'@type'   => 'Organization',
				'name'    => [ 'mapping' => 'post_author' ],
			],
			'keywords'    => [ 'mapping' => 'post_tags' ],
			'url'         => [ 'mapping' => 'post_url' ],
			'commentCount' => [ 'mapping' => 'comment_count' ],
			'comment'     => [
				'mapping' => 'post_comments',
				'instances' => [
					'Comment' => [
						'mapping' => 'comment_content',
						'@type'   => 'Comment',
						'author'  => [ 'mapping' => 'comment_author' ],
						'datePublished' => [ 'mapping' => 'comment_date' ],
						'description' => [ 'mapping' => 'comment_content' ],
					]
				]
			]
		];
	}
}
