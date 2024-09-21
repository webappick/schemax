<?php

namespace Schemax\App\Data;

class PostData extends DataAbstract {

	/**
	 * Get the data for the given object type.
	 *
	 * @param array  $mapping The mapping for the object.
	 * @param object $object The ID or Object for the entity.
	 *
	 * @return array The data for the object.
	 */
	public function fetchData(array $mapping, object $object ): array {


		// Validate the id or object first.
		if (! $object instanceof \WP_Post) {
			return [];
		}

		$post = $object;

		// Prepare the data for the given object
		$data = $this->prepareData( $mapping, $post );

		return apply_filters( 'schemax_post_data', $data, $post );
	}

	public function dataKeys(): array {
		// Return the data keys and their labels with the format 'key' => 'Label' Post as label prefix
		return array(
			'post_id'               => 'Post ID',
			'post_title'            => 'Post Title',
			'post_headline'         => 'Post Meta Title',
			'post_content'          => 'Post Content',
			'post_excerpt'          => 'Post Excerpt',
			'post_date'             => 'Post Date',
			'post_modified'         => 'Post Modified Date',
			'post_author'           => 'Post Author',
		);
	}

	/**
	 * Get the post title.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post title.
	 */
	public function get_post_title( object $post ): string {
		return $post->post_title;
	}

	/**
	 * Get the post headline.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post headline.
	 */
	public function get_post_headline( object $post ): string {
		setup_postdata( $post ); // Setup post data

		// Apply the 'document_title_parts' filter to get the title parts
		$title_parts = apply_filters('document_title_parts', [
			'title' => get_the_title( $post ),
			'tagline' => get_bloginfo( 'name' ),
			'site' => get_bloginfo( 'description' ),
			'separator' => '|'
		]);

		// Restore original post data after using setup_postdata
		wp_reset_postdata();

		// Return the constructed title (meta title)
		return $title_parts['title'] ?? get_the_title( $post );
	}

	/**
	 * Get the post content.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post content.
	 */
	public function get_post_content( object $post ): string {
		//TODO: Get settings for the content type (Full Description, Excerpt, Meta Description etc.)

		// Get the raw content
		$content = get_the_content(null, false, $post);

		// Apply the content filters to format it correctly
		// Return the formatted content
		return apply_filters('the_content', $content);
	}

	/**
	 * Get the post author full name.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post author.
	 */
	public function get_post_author( object $post ): string {
		$author = get_userdata( $post->post_author );
		if ( ! $author ) {
			return '';
		}
		return $author->first_name . ' ' . $author->last_name;
	}

	/**
	 * Get the post date published.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post date.
	 */
	public function get_post_date( object $post ): string {
		// Check if the post date is empty
		if ( empty( $post->post_date ) ) {
			return '';
		}

		// Return the formatted date
		return get_post_time('Y-m-d', true, $post);
	}

	/**
	 * Get the post date modified.
	 *
	 * @param object $post The post object.
	 *
	 * @return string The post date.
	 */
	public function get_post_modified( object $post ): string {
		// Check if the post date is empty
		if ( empty( $post->post_modified ) ) {
			return '';
		}

		// Return the formatted date
		return get_post_modified_time('c', true, $post);
	}
}
