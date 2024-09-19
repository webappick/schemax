<?php

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;

/**
 * Class ReviewService
 *
 * @category Library
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @author
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://webappick.com
 */
class ReviewService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Retrieve information about a specific review.
	 *
	 * @param int|object  $id The ID or Object for the review.
	 * @param string|null $key The key for the review.
	 * @return array|bool|float|int|string|\WC_DateTime|null An array of all or single information about the review.
	 */
	public function getInfo($id, $key = null) {
		if (!$this->validate($id)) {
			return null;
		}
		
		$review = $this->getObject($id, 'comment');
		if (!$review) {
			return null;
		}
		
		$reviewInfo = array(
			'review_id'           => $review->comment_ID,
			'review_post_id'      => $review->comment_post_ID,
			'review_author'       => $review->comment_author,
			'review_author_email' => $review->comment_author_email,
			'review_author_url'   => $review->comment_author_url,
			'review_author_IP'    => $review->comment_author_IP,
			'review_date'         => $review->comment_date,
			'review_date_gmt'     => $review->comment_date_gmt,
			'review_content'      => $review->comment_content,
			'review_karma'        => $review->comment_karma,
			'review_approved'     => $review->comment_approved,
			'review_agent'        => $review->comment_agent,
			'review_type'         => $review->comment_type,
			'review_parent'       => $review->comment_parent,
			'user_id'             => $review->user_id,
			'review_rating'       => get_comment_meta($review->comment_ID, 'rating', true),
		);
		
		return $key && isset($reviewInfo[$key]) ? $reviewInfo[$key] : $reviewInfo;
	}
	
	/**
	 * Retrieve a list of keys for the review.
	 *
	 * @return array An array of keys for the review.
	 * @throws \Exception
	 */
	public function getKeys() {
		return array(
			'review_id'           => __('Review ID', 'wp-list-info'),
			'review_post_id'      => __('Review Post ID', 'wp-list-info'),
			'review_author'       => __('Review Author', 'wp-list-info'),
			'review_author_email' => __('Review Author Email', 'wp-list-info'),
			'review_author_url'   => __('Review Author URL', 'wp-list-info'),
			'review_author_IP'    => __('Review Author IP', 'wp-list-info'),
			'review_date'         => __('Review Date', 'wp-list-info'),
			'review_date_gmt'     => __('Review Date GMT', 'wp-list-info'),
			'review_content'      => __('Review Content', 'wp-list-info'),
			'review_karma'        => __('Review Karma', 'wp-list-info'),
			'review_approved'     => __('Review Approved', 'wp-list-info'),
			'review_agent'        => __('Review Agent', 'wp-list-info'),
			'review_type'         => __('Review Type', 'wp-list-info'),
			'review_parent'       => __('Review Parent', 'wp-list-info'),
			'user_id'             => __('Review User ID', 'wp-list-info'),
			'review_rating'       => __('Review Rating', 'wp-list-info'),
		);
	}
}