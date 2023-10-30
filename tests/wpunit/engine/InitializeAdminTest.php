<?php

namespace Schemax\Tests\WPUnit;

class InitializeAdminTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		$user_id = $this->factory->user->create( array( 'role' => 'administrator' ) );
		wp_set_current_user( $user_id );
		set_current_screen( 'edit.php' );
		add_filter( 'wp_doing_ajax', '__return_false' );
		do_action('plugins_loaded');
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be admin
	 */
	public function it_should_be_admin() {
		$classes   = array();
		$classes[] = 'Schemax\Internals\PostTypes';
		$classes[] = 'Schemax\Internals\Shortcode';
		$classes[] = 'Schemax\Internals\Transient';
		$classes[] = 'Schemax\Integrations\CMB';
		$classes[] = 'Schemax\Integrations\Cron';
		$classes[] = 'Schemax\Integrations\Template';
		$classes[] = 'Schemax\Integrations\Widgets\My_Recent_Posts_Widget';
		$classes[] = 'Schemax\Ajax\Ajax';
		$classes[] = 'Schemax\Ajax\Ajax_Admin';
		$classes[] = 'Schemax\Backend\ActDeact';
		$classes[] = 'Schemax\Backend\Enqueue';
		$classes[] = 'Schemax\Backend\ImpExp';
		$classes[] = 'Schemax\Backend\Notices';
		$classes[] = 'Schemax\Backend\Pointers';
		$classes[] = 'Schemax\Backend\Settings_Page';

		$all_classes = get_declared_classes();
		foreach( $classes as $class ) {
			$this->assertTrue( in_array( $class, $all_classes ) );
		}
	}

}
