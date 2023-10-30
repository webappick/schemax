<?php
/**
 * Schemax
 *
 * @package   Schemax
 * @author    Ohidul Islam <wahid0003@gmail.com>
 * @copyright 2023 WebAppick
 * @license   GPL 2.0+
 * @link      https://webappick.com
 */

namespace Schemax\Backend;

use I18n_Notice_WordPressOrg;
use Schemax\Engine\Base;

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		\wpdesk_wp_notice( \__( 'Updated Messages', SMAX_TEXTDOMAIN ), 'updated' );

		$builder = new \Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entropy() ) {
			\wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', SMAX_TEXTDOMAIN ), 'error', true );
		}

		/*
		 * Review plugin notice.
		 */
		new \WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => SMAX_TEXTDOMAIN,
				'rating'     => 5,
				'message'    => \__( 'Review me!', SMAX_TEXTDOMAIN ),
				'link_label' => \__( 'Click here to review', SMAX_TEXTDOMAIN ),
			)
		);

		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
		if ( \apply_filters( 'schemax_alert_localization', true ) ) {
			new I18n_Notice_WordPressOrg(
			array(
				'textdomain'  => SMAX_TEXTDOMAIN,
				'schemax' => SMAX_NAME,
				'hook'        => 'admin_notices',
			),
			true
			);
		}

	}

}
