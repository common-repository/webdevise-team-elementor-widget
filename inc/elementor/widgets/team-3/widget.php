<?php
namespace Devise_Elementor\Widgets\Team3;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Elementor widget for Team3.
 */
class Devise_Team3 extends Widget_Base {

	/**
	 * Presets
	 * @access protected
	 * @var array $presets Array objects presets.
	 */

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_3_DIR' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_3_DIR', rtrim( __DIR__, ' /\\' ) );
		}

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_3_URL' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_3_URL', rtrim( plugin_dir_url( __FILE__ ), ' /\\' ) );
		}
		wp_register_style( 'devise-team-3', DEVISE_ELEMENTOR_WIDGET_TEAM_3_URL . '/assets/css/devise-team-3.min.css', array(), null );
	}


	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'devise-team-3';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team 3', 'web-devise-tew' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'web_devise_elements' ];
	}

	public function get_style_depends() {
		return [ 'devise-team-3' ];
	}

	/*Show reload button*/
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Register the widget controls.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'_content_settings',
			[
				'label' => __( 'Content', 'web-devise-tew' ),
			]
		);

		$this->add_control(
			'person_name',
			[
				'label' => __( 'Name', 'web-devise-tew' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Person Name', 'web-devise-tew' ),
				'default' => __( 'Person Name', 'web-devise-tew' ),
			]
		);

		$this->add_control(
			'person_position',
			[
				'label' => __( 'Position', 'web-devise-tew' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Person Position', 'web-devise-tew' ),
				'default' => __( 'Person Position', 'web-devise-tew' ),
			]
		);

		$this->add_control(
			'team_title_position',
			[
				'label' => __( 'Team Titles Position', 'web-devise-tew' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'default' => 'bottom',
				'options' => [
					'top' => __( 'Top', 'web-devise-tew' ),
					'bottom' => __( 'Bottom', 'web-devise-tew' ),
				],
			]
		);

		$this->add_responsive_control(
			'person_information_alignment',
			[
				'label' => __( 'Content Align', 'web-devise-tew' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'web-devise-tew' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'web-devise-tew' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'web-devise-tew' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'selectors_dictionary' => [
					'left'   => 'text-align: left; justify-content: flex-start;',
					'center' => 'text-align: center;',
					'right'  => 'text-align: right; justify-content: flex-end;',

				],
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title, {{WRAPPER}} .team-3 .s-link' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'person_information_container_link',
			[
				'label' => __( 'Person Information Link', 'web-devise-tew' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_control(
			'person_aboutme',
			[
				'label' => __( 'About Me', 'web-devise-tew' ),
				'type' => Controls_Manager::TEXTAREA,
				'separator' => 'before',
				'placeholder' => __( 'I love to introduce myself as a hardcore Web Designer.', 'web-devise-tew' ),
				'default' => __( 'I love to introduce myself as a hardcore Web Designer.', 'web-devise-tew' ),
			]
		);

		$this->add_control(
			'person_image',
			[
				'label' => __( 'Choose Image', 'web-devise-tew' ),
				'description' => __( 'Choose Team-3 image size with suffix -w to get vertical image', 'web-devise-tew' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'imagesize',
				'default' => 'team-3-photo-h',
				'separator' => 'none',
				'condition' => [ 'person_image[url]!' => Utils::get_placeholder_image_src() ],
			]
		);

		$this->add_control(
			'show_social_icons',
			[
				'label' => __( 'Show Social Icons', 'web-devise-tew' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'web-devise-tew' ),
				'label_off' => __( 'No', 'web-devise-tew' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => __( 'Icon', 'web-devise-tew' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-facebook',
					'library' => 'fa-brands',
				],
				'recommended' => [
					'fa-brands' => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'web-devise-tew',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mix',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px',
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss',
					],
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'web-devise-tew' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'is_external' => 'true',
				],
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'web-devise-tew' ),
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label' => __( 'Social Icons', 'web-devise-tew' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_icon' => [
							'value' => 'fab fa-linkedin',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, social = ( "undefined" === typeof social ) ? false : social; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, social, true, migrated, true ) }}}',
				'condition' => [
					'show_social_icons' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->add_styles_controls( $this );

	}

	/**
	 * Controls call
	 * @access public
	 */
	public function add_styles_controls( $control ) {

		$this->control = $control;

		/**
		 *  Person Name Styles
		 */
		$this->person_name_styles( $control );

		/**
		 *  Person Position Styles
		 */
		$this->person_position_styles( $control );

	}

	/**
	 * Person Name Styles
	 * @access protected
	 */
	protected function person_name_styles( $control ) {

		$control->start_controls_section(
			'person_name_style_section',
			[
				'label' => __( 'Person Name Style', 'web-devise-tew' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography', 'web-devise-tew' ),
				'name' => 'person_name_typography',
				'selector' => '{{WRAPPER}} .team-3 .team-title h5',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_family' => [
						'default' => 'Open Sans',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '500',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
				],
			]
		);

		$control->add_responsive_control(
			'person_name_color',
			[
				'label' => __( 'Color', 'web-devise-tew' ),
				'type' => Controls_Manager::COLOR,
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title h5' => 'color: {{VALUE}};',
				],
				'default' => '#333333',
			]
		);

		$control->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'person_name_background',
				'label' => __( 'Background', 'web-devise-tew' ),
				'types' => [ 'classic', 'gradient' ],
				'default' => 'classic',
				'selector' => '{{WRAPPER}} .team-3 .team-title h5',
			]
		);

		$control->remove_control( 'person_name_background_image' );

		$control->add_responsive_control(
			'person_name_padding',
			[
				'label' => __( 'Padding', 'web-devise-tew' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$control->add_responsive_control(
			'person_name_margin',
			[
				'label' => __( 'Margin', 'web-devise-tew' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Person Position Styles
	 * @access protected
	 */
	protected function person_position_styles( $control ) {

		$control->start_controls_section(
			'person_position_style_section',
			[
				'label' => __( 'Person Position Style', 'web-devise-tew' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography', 'web-devise-tew' ),
				'name' => 'person_position_typography',
				'selector' => '{{WRAPPER}} .team-3 .team-title span',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_family' => [
						'default' => 'Open Sans',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '12',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
				],
			]
		);

		$control->add_responsive_control(
			'person_position_color',
			[
				'label' => __( 'Color', 'web-devise-tew' ),
				'type' => Controls_Manager::COLOR,
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title span' => 'color: {{VALUE}};',
				],
				'default' => '#a5a5a5',
			]
		);

		$control->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'person_position_background',
				'label' => __( 'Background', 'web-devise-tew' ),
				'types' => [ 'classic', 'gradient' ],
				'default' => 'classic',
				'selector' => '{{WRAPPER}} .team-3 .team-title span',
			]
		);

		$control->remove_control( 'person_position_background_image' );

		$control->add_responsive_control(
			'person_postition_padding',
			[
				'label' => __( 'Padding', 'web-devise-tew' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$control->add_responsive_control(
			'person_postition_margin',
			[
				'label' => __( 'Margin', 'web-devise-tew' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .team-3 .team-title span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	public function render() {
		$settings = $this->get_settings_for_display();

		$preset_path = __DIR__ . '/templates/output.php';

		if ( ! empty( $preset_path ) && file_exists( $preset_path ) ) {
			include $preset_path;
		}
	}
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Devise_Team3() );
