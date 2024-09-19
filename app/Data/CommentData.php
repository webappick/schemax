<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class CommentService
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */
class CommentService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific comment.
	 *
	 * @param int|object  $id The ID or Object for the comment.
	 * @param string|null $key The key for the comment.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the comment.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$comment = $this->getObject($id, 'comment');
		if (!$comment) {
			return null;
		}
		
		$commentInfo = array(
			'comment_id'           => $comment->comment_ID,
			'comment_post_id'      => $comment->comment_post_ID,
			'comment_author'       => $comment->comment_author,
			'comment_author_email' => $comment->comment_author_email,
			'comment_author_url'   => $comment->comment_author_url,
			'comment_author_IP'    => $comment->comment_author_IP,
			'comment_date'         => $comment->comment_date,
			'comment_date_gmt'     => $comment->comment_date_gmt,
			'comment_content'      => $comment->comment_content,
			'comment_karma'        => $comment->comment_karma,
			'comment_approved'     => $comment->comment_approved,
			'comment_agent'        => $comment->comment_agent,
			'comment_type'         => $comment->comment_type,
			'comment_parent'       => $comment->comment_parent,
			'user_id'              => $comment->user_id,
		);
		
		return $key && isset($commentInfo[$key]) ? $commentInfo[$key] : $commentInfo;
	}
	
	/**
	 * Retrieve a list of keys for the comment.
	 *
	 * @return array An array of keys for the comment.
	 * @throws \Exception
	 */
	public function getKeys() {
		return array(
			'comment_id'           => __('Comment ID', 'wp-list-info'),
			'comment_post_id'      => __('Post ID', 'wp-list-info'),
			'comment_author'       => __('Author', 'wp-list-info'),
			'comment_author_email' => __('Author Email', 'wp-list-info'),
			'comment_author_url'   => __('Author URL', 'wp-list-info'),
			'comment_author_IP'    => __('Author IP', 'wp-list-info'),
			'comment_date'         => __('Date', 'wp-list-info'),
			'comment_date_gmt'     => __('Date GMT', 'wp-list-info'),
			'comment_content'      => __('Content', 'wp-list-info'),
			'comment_karma'        => __('Karma', 'wp-list-info'),
			'comment_approved'     => __('Approved', 'wp-list-info'),
			'comment_agent'        => __('Agent', 'wp-list-info'),
			'comment_type'         => __('Type', 'wp-list-info'),
			'comment_parent'       => __('Parent', 'wp-list-info'),
			'user_id'              => __('User ID', 'wp-list-info'),
		);
	}
}