<?php
/**
 * Register the community widgets in elementor
 *
 * @since   1.0.0
 */

namespace KeckObservatory\Elementor;

use Elementor\Widget_Base;
use Elementor\Core\Schemes\Typography;

defined( 'ABSPATH' ) || exit();

class Community_Slider extends Widget_Base {
	/**
	 * @param $base Base
	 *
	 * @since 1.0.0
	 */
	public $base;

	public function get_name() {
		return 'keck_observatory_community_slider';
	}

	public function get_title() {
		return esc_html__( 'Community Slider', 'keck-observatory' );
	}

	public function get_icon() {
		return 'eicon-product-images';
	}

	public function get_categories() {
		return array( 'keck-observatory' );
	}

	protected function _register_controls() {
		$this->start_controls_section( 'content_section', array(
			'label' => __( 'Content', '' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
		) );
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slide_title',
			array(
				'label'       => __( 'Title', 'keck-observatory' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Friends in Hawaii', 'keck-observatory' ),
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'slide_content',
			array(
				'label'      => __( 'Content', 'keck-observatory' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'default'    => __( 'Friends in Hawaii', 'keck-observatory' ),
				'show_label' => false,
			)
		);
		$repeater->add_control(
			'slide_image',
			array(
				'label'   => __( 'Image', 'keck-observatory' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			)
		);
		$repeater->add_control(
			'slide_url',
			array(
				'label' => __( 'Url', 'keck-observatory' ),
				'type'  => \Elementor\Controls_Manager::URL,
			)
		);

		$this->add_control(
			'slides',
			[
				'label'       => __( 'Slides', 'plugin-domain' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ slide_title }}}',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section( 'style_section', array(
			'label' => __( 'Style', 'keck-observatory' ),
			'tab'   => \Elementor\Controls_Manager::TAB_STYLE
		) );

		$this->add_control(
			'title_color',
			array(
				'label'    => __( 'Title Font Color', 'keck-observatory' ),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'scheme'   => array(
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				),
				'selector' => array(
					'{{WRAPPER}} .slide_title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'keck-observatory' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slide_title',
			)
		);
		$this->add_control(
			'desc_color',
			array(
				'label'    => __( 'Desc Font Color', 'keck-observatory' ),
				'type'     => \Elementor\Controls_Manager::COLOR,
				'scheme'   => array(
					'type'  => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				),
				'selector' => array(
					'{{WRAPPER}} .slide_content' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'desc_typography',
				'label'    => __( 'Description Typography', 'keck-observatory' ),
				'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .slide_content',
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( $settings['slides'] ) {
			echo '<div class="our-community owl-carousel">';
			foreach ( $settings['slides'] as $slide ) {
				?>
                <div class="slide_item">
                    <div class="slide_item_img">
                        <img src="<?php echo esc_url( $slide['slide_image']['url'] ); ?>" alt="" class="img-fluid">
                        <a href="<?php echo esc_url( $slide['slide_url']['url'] ); ?>" class="slide_item_url"></a>
                    </div>
                    <div class="slide_item_content">
                        <h2 class="slide_title" style="color:<?php echo $settings['title_color'] ?>"><?php echo $slide['slide_title']; ?></h2>
                        <div class="slide_content" style="color:<?php echo $settings['desc_color'] ?>"><?php echo $slide['slide_content']; ?></div>
                    </div>
                </div>
				<?php
			}
			echo '</div>';
		}
	}


}