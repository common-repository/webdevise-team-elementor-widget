<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;

$image_url = ( $settings['person_image']['id'] ) ? Group_Control_Image_Size::get_attachment_image_src( $settings['person_image']['id'], 'imagesize', $settings ) : $settings['person_image']['url'];

$this->add_inline_editing_attributes( 'person_name', 'none' );
$this->add_render_attribute( 'person_name', 'class', 'name' );
$this->add_inline_editing_attributes( 'person_link_text', 'none' );

$this->add_render_attribute( 'person_photo', 'class', 'photo' );
$this->add_render_attribute( 'person_photo', 'href', '#' );
if ( 'yes' === ( $settings['grayscale_image'] ) ) {
	$this->add_render_attribute( 'person_photo', 'class', 'grayscale' );
}

if ( ! empty( $settings['person_link']['url'] ) ) {

	$target   = $settings['person_link']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['person_link']['nofollow'] ? ' rel="nofollow"' : '';

	$this->add_render_attribute( 'person_link', 'href', $settings['person_link']['url'] );
	$this->add_render_attribute( 'person_link', 'id', 'author' );

	if ( $settings['person_link']['is_external'] ) {
		$this->add_render_attribute( 'person_link', 'target', '_blank' );
	}

	if ( $settings['person_link']['nofollow'] ) {
		$this->add_render_attribute( 'person_link', 'rel', 'nofollow' );
	}
}
?>
<div class="team-1">
	<div class="team-item-wrapper">
		<div <?php echo $this->get_render_attribute_string( 'person_photo' ); ?>>
			<h1 <?php echo $this->get_render_attribute_string( 'person_name' ); ?>><?php echo wp_kses( $settings['person_name'], 'post' ); ?></h1>
			<img class="img-responsive" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo Control_Media::get_image_alt( $settings['person_image'] ); ?>">
			<div class="glow-wrap"><i class="glow"></i></div>
		</div>
		<a <?php echo $this->get_render_attribute_string( 'person_link' ); ?>><?php echo wp_kses( $settings['person_link_text'], 'post' ); ?></a>
	</div>
</div>
