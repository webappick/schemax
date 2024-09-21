<?php

namespace app\Services;

use lucatume\WPBrowser\TestCase\WPTestCase;
use Schemax\App\Mapping\MappingFactory;
use Schemax\App\Services\SchemaGenerationService;

class SchemaGenerationServiceTest extends WPTestCase {
	/**
	 * @var \WpunitTester
	 */
	protected $tester;

	protected $post;

	public function setUp(): void {
		// Before...
		parent::setUp();

		// Your set up methods here.
		// User data array
		$user_data = array(
			'user_login' => 'john_doe', // Username
			'user_pass'  => 'password123', // Password
			'user_email' => 'johndoe@example.com', // Email address
			'first_name' => 'John', // First name
			'last_name'  => 'Doe', // Last name
			'role'       => 'author' // Set the role to 'author'
		);

		// Insert the user into the database
		$user_id       = wp_insert_user( $user_data );
		$date          = date( 'Y-m-d', strtotime( '-2 days' ) );
		$modified_date = date( 'Y-m-d H:i:s', strtotime( '2024-09-20 12:00:00' ) );
		$post_data     = array(
			'post_title'        => 'My Programmatically Created Post', // Title of the post
			'post_content'      => 'This is the content of the post created programmatically.', // Post content
			'post_status'       => 'publish', // Post status (publish, draft, pending, etc.)
			'post_author'       => $user_id, // Author ID (usually the admin ID or the current user)
			'post_type'         => 'post', // Post type (post, page, or custom post type)
			'post_date'         => $date, // Post date
			'post_modified'     => $modified_date, // Local modified date
			'post_modified_gmt' => get_gmt_from_date( $modified_date ) // GMT modified date
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $post_data );

		$this->post = get_post( $post_id );
	}

	public function tearDown(): void {
		// Your tear down methods here.

		// Then...
		parent::tearDown();
	}

	// Tests

	/**
	 * @throws \Exception
	 */
	public function test_factory(): void {
		$post = $this->post;

		$product = new \WC_Product_Simple();
		$product->set_name( 'Test Product' );
		$product->set_description( 'Test Description' );
		$product->set_sku( 'test-sku' );
		$product->set_price( 100 );
		$product->set_stock_status( 'instock' );
		$product->set_manage_stock( true );
		$product->set_stock_quantity( 10 );
		$product->set_status( 'publish' );
		$product->save();

//		$productData = new \Schemax\App\Data\ProductData();
//		$mappings = MappingFactory::get( 'product' );
//		//$data = $postData->fetchData( $mappings, $post );
//		$data = $productData->prepareData( $mappings, $product );

//		codecept_debug( $data );

//		// Initialize the MappingManager

		$service = new SchemaGenerationService();
		$schema  = $service->generateSchema( 'article', $post );

		codecept_debug( $schema->toArray() );

		$service = new SchemaGenerationService();
		$schema  = $service->generateSchema( 'product', $product );

		codecept_debug( $schema->toArray() );

	}

	public function testPostData() {

//		$postData = new \Schemax\App\Data\PostData();
//
//		$mappings = MappingFactory::get( 'article' );
//		//$data = $postData->fetchData( $mappings, $post );
//		$data = $postData->prepareData( $mappings, $this->post );
//
//		codecept_debug( $data );
	}
}
