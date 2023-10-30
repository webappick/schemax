<?php
/*
 * Retrieve these settings on front end in either of these ways:
 *   $my_setting = cmb2_get_option( SMAX_TEXTDOMAIN . '-settings', 'some_setting', 'default' );
 *   $my_settings = get_option( SMAX_TEXTDOMAIN . '-settings', 'default too' );
 * CMB2 Snippet: https://github.com/CMB2/CMB2-Snippet-Library/blob/master/options-and-settings-pages/theme-options-cmb.php
 */
?>
<div id="tabs-1" class="wrap">
			<?php
			$cmb = new_cmb2_box(
				array(
					'id'         => SMAX_TEXTDOMAIN . '_options',
					'hookup'     => false,
					'show_on'    => array( 'key' => 'options-page', 'value' => array( SMAX_TEXTDOMAIN ) ),
					'show_names' => true,
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Text', SMAX_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'      => 'text',
					'type'    => 'text',
					'default' => 'Default Text',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Color Picker', SMAX_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'      => 'colorpicker',
					'type'    => 'colorpicker',
					'default' => '#bada55',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Medium', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_textmedium',
					'type' => 'text_medium',
					// 'repeatable' => true,
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Website URL', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_url',
					'type' => 'text_url',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Email', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_email',
					'type' => 'text_email',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Time', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_time',
					'type' => 'text_time',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_textdate',
					'type' => 'text_date',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date Picker (UNIX timestamp)', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_textdate_timestamp',
					'type' => 'text_date_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Date/Time Picker Combo (UNIX timestamp)', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_datetime_timestamp',
					'type' => 'text_datetime_timestamp',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Test Money', SMAX_TEXTDOMAIN ),
					'desc'         => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'           => '_textmoney',
					'type'         => 'text_money',
					'before_field' => '€', // Override '$' symbol if needed
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_textarea',
					'type' => 'textarea',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Text Area for Code', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_textarea_code',
					'type' => 'textarea_code',
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Title Weeeee', SMAX_TEXTDOMAIN ),
					'desc' => __( 'This is a title description', SMAX_TEXTDOMAIN ),
					'id'   => '_title',
					'type' => 'title',
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Select', SMAX_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'               => '_select',
					'type'             => 'select',
					'show_option_none' => true,
					'options'          => array(
						'standard' => __( 'Option One', SMAX_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', SMAX_TEXTDOMAIN ),
						'none'     => __( 'Option Three', SMAX_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'             => __( 'Test Radio inline', SMAX_TEXTDOMAIN ),
					'desc'             => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'               => '_radio_inline',
					'type'             => 'radio_inline',
					'show_option_none' => 'No Selection',
					'options'          => array(
						'standard' => __( 'Option One', SMAX_TEXTDOMAIN ),
						'custom'   => __( 'Option Two', SMAX_TEXTDOMAIN ),
						'none'     => __( 'Option Three', SMAX_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Radio', SMAX_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'      => '_radio',
					'type'    => 'radio',
					'options' => array(
						'option1' => __( 'Option One', SMAX_TEXTDOMAIN ),
						'option2' => __( 'Option Two', SMAX_TEXTDOMAIN ),
						'option3' => __( 'Option Three', SMAX_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Radio', SMAX_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'       => '_text_taxonomy_radio',
					'type'     => 'taxonomy_radio',
					'taxonomy' => 'category', // Taxonomy Slug
					// 'inline'  => true, // Toggles display to inline
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Select', SMAX_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'       => '_taxonomy_select',
					'type'     => 'taxonomy_select',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name'     => __( 'Test Taxonomy Multi Checkbox', SMAX_TEXTDOMAIN ),
					'desc'     => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'       => '_multitaxonomy',
					'type'     => 'taxonomy_multicheck',
					'taxonomy' => 'category', // Taxonomy Slug
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Checkbox', SMAX_TEXTDOMAIN ),
					'desc' => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'   => '_checkbox',
					'type' => 'checkbox',
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test Multi Checkbox', SMAX_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'      => '_multicheckbox',
					'type'    => 'multicheck',
					'options' => array(
						'check1' => __( 'Check One', SMAX_TEXTDOMAIN ),
						'check2' => __( 'Check Two', SMAX_TEXTDOMAIN ),
						'check3' => __( 'Check Three', SMAX_TEXTDOMAIN ),
					),
				)
			);
			$cmb->add_field(
				array(
					'name'    => __( 'Test wysiwyg', SMAX_TEXTDOMAIN ),
					'desc'    => __( 'field description (optional)', SMAX_TEXTDOMAIN ),
					'id'      => '_wysiwyg',
					'type'    => 'wysiwyg',
					'options' => array( 'textarea_rows' => 5 ),
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'Test Image', SMAX_TEXTDOMAIN ),
					'desc' => __( 'Upload an image or enter a URL.', SMAX_TEXTDOMAIN ),
					'id'   => '_image',
					'type' => 'file',
				)
			);
			$cmb->add_field(
				array(
					'name'         => __( 'Multiple Files', SMAX_TEXTDOMAIN ),
					'desc'         => __( 'Upload or add multiple images/attachments.', SMAX_TEXTDOMAIN ),
					'id'           => '_file_list',
					'type'         => 'file_list',
					'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
				)
			);
			$cmb->add_field(
				array(
					'name' => __( 'oEmbed', SMAX_TEXTDOMAIN ),
					'desc' => __( 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', SMAX_TEXTDOMAIN ),
					'id'   => '_embed',
					'type' => 'oembed',
				)
			);
			$cmb->add_field(
				array(
					'name'         => 'Testing Field Parameters',
					'id'           => '_parameters',
					'type'         => 'text',
					'before_row'   => '<p>before_row_if_2</p>', // Callback
					'before'       => '<p>Testing <b>"before"</b> parameter</p>',
					'before_field' => '<p>Testing <b>"before_field"</b> parameter</p>',
					'after_field'  => '<p>Testing <b>"after_field"</b> parameter</p>',
					'after'        => '<p>Testing <b>"after"</b> parameter</p>',
					'after_row'    => '<p>Testing <b>"after_row"</b> parameter</p>',
				)
			);

			cmb2_metabox_form( SMAX_TEXTDOMAIN . '_options', SMAX_TEXTDOMAIN . '-settings' );
			?>

			<!-- @TODO: Provide other markup for your options page here. -->
		</div>
