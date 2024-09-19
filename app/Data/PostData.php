<?php
/**
 * This class is used to get information about a post.
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @category Library
 */

namespace WebAppick\WPListInfo\Services;

use WebAppick\WPListInfo\Abstracts\AbstractInfo;
use WebAppick\WPListInfo\Interfaces\ServiceInterface;
use WP_Query;

/**
 * Class PostService.
 *
 * @package WebAppick\WPListInfo\Services
 * @subpackage WebAppick\WPListInfo\Services
 * @author   Ohidul Islam <wahid0003@gmail.com>
 * @link     https://webappick.com
 * @license  https://opensource.org/licenses/gpl-license.php GNU Public License
 * @category Library
 */
class PostService extends AbstractInfo implements ServiceInterface {
	
	/**
	 * Get the information of a post by ID.
	 *
	 * @param string     $key Optional. The key of the information to get. Default is null.
	 * @param int|object $idObject  Post ID or Post Object.
     * @return mixed Information of the post.
	 */
	public function getInfo( $key, $idObject ) {
		// Validate the id or object first.
		if ( ! $this->validate( $idObject ) ) {
			return null;
		}
		
		// Get the post object.
		$post = $this->getObject( $idObject, 'post' );
		
		if ( ! $post ) {
			return null;
		}
		
		// Get the post's parent, if any.
		if ( $post->post_parent ) {
			$parent = get_post( $post->post_parent );
		} else {
			$parent = null;
		}
		
		$postInfo = array(
			'post_id'             => $post->ID,
			'post_title'          => $post->post_title,
			'post_slug'           => $post->post_name,
			'post_url'            => get_permalink( $post->ID ),
			'post_status'         => $post->post_status,
			'post_author'         => get_the_author_meta( 'display_name', $post->post_author ),
			'post_date'           => $post->post_date,
			'post_modified_date'  => $post->post_modified,
			'post_excerpt'        => $post->post_excerpt,
			'post_content'        => $post->post_content,
			'post_comment_count'  => $post->comment_count,
			'post_thumbnail_id'   => get_post_thumbnail_id( $post->ID ),
			'post_thumbnail_url'  => get_the_post_thumbnail_url( $post->ID, 'full' ),
			'post_parent_id'      => $post->post_parent,
			'post_parent_title'   => $parent ? $parent->post_title : null,
			'post_parent_url'     => $parent ? get_permalink( $parent->ID ) : null,
			'post_categories'     => wp_get_post_categories( $post->ID ),
			'post_tags'           => wp_get_post_tags( $post->ID, array( 'fields' => 'name' ) ),
			'post_meta'           => get_post_meta( $post->ID ),
			'post_type'           => $post->post_type,
			'post_ping_status'    => $post->ping_status,
			'post_comment_status' => $post->comment_status,
			'post_visibility'     => get_post_status( $post->ID ), // visibility is controlled by post status
		);
		
		// If a specific key is requested, return that.
		if ( ! empty( $key ) && isset( $postInfo[ $key ] ) ) {
			return $postInfo[ $key ];
		}
		
		return $postInfo;
	}
	
	/**
	 * Retrieve or Search a list of posts based on specified arguments.
	 *
	 * @param array $args Optional. Arguments to query posts.
	 *                    Example: [
	 *                      'post_type'      => 'post',
	 *                      'posts_per_page' => 20,
	 *                      'orderby'        => 'date',
	 *                      'order'          => 'DESC',
	 *                    ].
	 * @return array List of WP_Post objects or an empty array if no posts are found.
	 */
	public function getList( $args = array() ) {
		$defaults = array(
			'post_type'      => 'post',
			'posts_per_page' => 20,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		
		$queryArgs = wp_parse_args( $args, $defaults );
		$query     = new WP_Query( $queryArgs );
		$posts     = $query->get_posts();
		
		if ( ! empty( $posts ) ) {
			return $posts;
		}
		
		return array();
	}

	/**
	 * @inheritDoc
	 */
	public function getKeys() {
		return array(
			'post_id'             => __( 'Post ID', 'wp-list-info' ),
			'post_title'          => __( 'Post Title', 'wp-list-info' ),
			'post_slug'           => __( 'Post Slug', 'wp-list-info' ),
			'post_url'            => __( 'Post URL', 'wp-list-info' ),
			'post_status'         => __( 'Post Status', 'wp-list-info' ),
			'post_author'         => __( 'Post Author', 'wp-list-info' ),
			'post_date'           => __( 'Post Date', 'wp-list-info' ),
			'post_modified_date'  => __( 'Post Modified Date', 'wp-list-info' ),
			'post_excerpt'        => __( 'Post Excerpt', 'wp-list-info' ),
			'post_content'        => __( 'Post Content', 'wp-list-info' ),
			'post_comment_count'  => __( 'Post Comment Count', 'wp-list-info' ),
			'post_thumbnail_id'   => __( 'Post Thumbnail ID', 'wp-list-info' ),
			'post_thumbnail_url'  => __( 'Post Thumbnail URL', 'wp-list-info' ),
			'post_parent_id'      => __( 'Post Parent ID', 'wp-list-info' ),
			'post_parent_title'   => __( 'Post Parent Title', 'wp-list-info' ),
			'post_parent_url'     => __( 'Post Parent URL', 'wp-list-info' ),
			'post_categories'     => __( 'Post Categories', 'wp-list-info' ),
			'post_tags'           => __( 'Post Tags', 'wp-list-info' ),
			'post_meta'           => __( 'Post Meta', 'wp-list-info' ),
			'post_type'           => __( 'Post Type', 'wp-list-info' ),
			'post_ping_status'    => __( 'Post Ping Status', 'wp-list-info' ),
			'post_comment_status' => __( 'Post Comment Status', 'wp-list-info' ),
			'post_visibility'     => __( 'Post Visibility', 'wp-list-info' ),
		);
	}

}
