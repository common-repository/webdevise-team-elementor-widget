<?php
namespace Devise_Elementor\Widgets\Team1;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Elementor widget for Team1.
 */
class Devise_Team1 extends Widget_Base {

	/**
	 * Presets
	 * @access protected
	 * @var array $presets Array objects presets.
	 */

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_1_DIR' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_1_DIR', rtrim( __DIR__, ' /\\' ) );
		}

		if ( ! defined( 'DEVISE_ELEMENTOR_WIDGET_TEAM_1_URL' ) ) {
			define( 'DEVISE_ELEMENTOR_WIDGET_TEAM_1_URL', rtrim( plugin_dir_url( __FILE__ ), ' /\\' ) );
		}
		wp_register_style( 'devise-team-1', DEVISE_ELEMENTOR_WIDGET_TEAM_1_URL . '/assets/css/devise-team-1.min.css', array(), null );
	}


	/**
	 * Retrieve the widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'devise-team-1';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Team 1', 'web-devise-tew' );
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
		return [ 'devise-team-1' ];
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
				'default' => 'team-1-photo',
				'separator' => 'none',
				'condition' => [ 'person_image[url]!' => Utils::get_placeholder_image_src() ],
			]
		);

		$this->add_control(
			'grayscale_image',
			[
				'label' => __( 'Grayscale Image', 'web-devise-tew' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'web-devise-tew' ),
				'label_off' => __( 'Off', 'web-devise-tew' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'person_link',
			[
				'label' => __( 'Link', 'web-devise-tew' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'person_link_text',
			[
				'label' => __( 'Link Text', 'web-devise-tew' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'About Me', 'web-devise-tew' ),
				'default' => __( 'About Me', 'web-devise-tew' ),
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
				'selector' => '{{WRAPPER}} .team-1 h1.name',
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
							'size' => '40',
						],
					],
					'font_weight' => [
						'default' => '500',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '48',
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
					'{{WRAPPER}} .team-1 h1.name' => 'color: {{VALUE}};',
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

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Devise_Team1() );
