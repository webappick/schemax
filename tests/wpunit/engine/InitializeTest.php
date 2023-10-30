<?php

namespace Schemax\Tests\WPUnit;

class InitializeTest extends \Codeception\TestCase\WPTestCase {
	/**
	 * @var string
	 */
	protected $root_dir;

	public function setUp(): void {
		parent::setUp();

		// your set up methods here
		$this->root_dir = dirname( dirname( dirname( __FILE__ ) ) );

		wp_set_current_user(0);
		wp_logout();
		wp_safe_redirect(wp_login_url());

		do_action('plugins_loaded');
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * it should be front
	 */
	public function it_should_be_front() {
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
		$classes[] = 'Schemax\Frontend\Enqueue';
		$classes[] = 'Schemax\Frontend\Extras\Body_Class';

		$all_classes = get_declared_classes();
		foreach( $classes as $class ) {
			$this->assertTrue( in_array( $class, $all_classes ) );
		}
	}

}
