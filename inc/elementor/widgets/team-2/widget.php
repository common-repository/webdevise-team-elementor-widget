<?php
namespace Devise_Elementor\Widgets\Team2;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

if ( ! defined( 'ABSPATH' ) ) exit;



/**
 * Elementor widget for Team2.
 */
class Devise_Team2 extends Widget_Base {

	/**
	 * Presets
	 * @access protected
	 * @var array $presets Array objects presets.
	 */

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_2_DIR' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_2_DIR', rtrim( __DIR__, ' /\\' ) );
		}

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_2_URL' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_2_URL', rtrim( plugin_dir_url( __FILE__ ), ' /\\' ) );
		}
		wp_register_style( 'devise-team-2', DEVISE_ELEMENTOR_WIDGET_TEAM_2_URL . '/assets/css/devise-team-2.min.css', array(), null );
	}


	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'devise-team-2';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team 2', 'web-devise-tew' );
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
		return [ 'devise-team-2' ];
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
			'person_image',
			[
				'label' => __( 'Choose Image', 'web-devise-tew' ),
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
				'default' => 'team-2-photo',
				'separator' => 'none',
				'condition' => [ 'person_image[url]!' => Utils::get_placeholder_image_src() ],
			]
		);

		$this->add_control(
			'_social_networks',
			[
				'label' => __( 'Social Networks', 'web-devise-tew' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'person_link_facebook',
			[
				'label' => __( 'Facebook', 'web-devise-tew' ),
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
			'person_link_twitter',
			[
				'label' => __( 'Twitter', 'web-devise-tew' ),
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
			'person_link_linkedin',
			[
				'label' => __( 'LinkedIn', 'web-devise-tew' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
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
				'selector' => '{{WRAPPER}} .team-2 .team-2-username',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_family' => [
						'default' => 'Roboto',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
					'font_weight' => [
						'default' => '500',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '42',
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
					'{{WRAPPER}} .team-2 .team-2-username' => 'color: {{VALUE}};',
				],
				'default' => '#313435',
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$control->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography', 'web-devise-tew' ),
				'name' => 'person_position_typography',
				'selector' => '{{WRAPPER}} .team-2 .team-2-user-position',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_family' => [
						'default' => 'Roboto',
					],
					'font_size' => [
						'default' => [
							'unit' => 'px',
							'size' => '14',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '38',
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
					'{{WRAPPER}} .team-2 .team-2-user-position' => 'color: {{VALUE}};',
				],
				'default' => '#333333',
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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Devise_Team2() );
