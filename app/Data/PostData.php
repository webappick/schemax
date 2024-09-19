<?php

namespace Schemax\App\Data;

class PostData extends DataAbstract {

	/**
	 * Get the data for the given object type.
	 *
	 * @param object $object The ID or Object for the entity.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData( object $object ): array {
		$post = get_post( $object );


		$data = array(
			'ID'                    => $post->ID,
			'post_title'            => $post->post_title,
			'post_content'          => $post->post_content,
			'post_excerpt'          => $post->post_excerpt,
			'post_date'             => $post->post_date,
			'post_author'           => $post->post_author,
			'post_status'           => $post->post_status,
			'post_type'             => $post->post_type,
			'post_name'             => $post->post_name,
			'post_parent'           => $post->post_parent,
			'post_modified'         => $post->post_modified,
			'post_content_filtered' => $post->post_content_filtered,
			'post_mime_type'        => $post->post_mime_type,
			'guid'                  => $post->guid,
			'menu_order'            => $post->menu_order,
			'comment_count'         => $post->comment_count,
			'comment_status'        => $post->comment_status,
			'ping_status'           => $post->ping_status,
			'pinged'                => $post->pinged,
			'to_ping'               => $post->to_ping,
			'post_password'         => $post->post_password
		);

		return $data;

	}

	public function dataKeys(): array {
		// Return the data keys and their labels with the format 'key' => 'Label' Post as label prefix
		return array(
			'post_id'               => 'Post ID',
			'post_title'            => 'Post Title',
			'post_content'          => 'Post Content',
			'post_excerpt'          => 'Post Excerpt',
			'post_date'             => 'Post Date',
			'post_author'           => 'Post Author',
			'post_status'           => 'Post Status',
			'post_type'             => 'Post Type',
			'post_name'             => 'Post Name',
			'post_parent'           => 'Post Parent',
			'post_modified'         => 'Post Modified',
			'post_content_filtered' => 'Post Content Filtered',
			'post_mime_type'        => 'Post Mime Type',
			'guid'                  => 'Post Guid',
			'menu_order'            => 'Post Menu Order',
			'comment_count'         => 'Post Comment Count',
			'comment_status'        => 'Post Comment Status',
			'ping_status'           => 'Post Ping Status',
			'pinged'                => 'Post Pinged',
			'to_ping'               => 'Post To Ping',
			'post_password'         => 'Post Password'
		);
	}
}
