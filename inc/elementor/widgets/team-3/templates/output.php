<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Icons_Manager;

$image_url = ( $settings['person_image']['id'] ) ? Group_Control_Image_Size::get_attachment_image_src( $settings['person_image']['id'], 'imagesize', $settings ) : $settings['person_image']['url'];
$person_information_container_link = $settings['person_information_container_link']['url'];

$this->add_inline_editing_attributes( 'person_name', 'none' );
$this->add_inline_editing_attributes( 'person_position', 'none' );
$this->add_inline_editing_attributes( 'person_aboutme', 'none' );

$this->add_render_attribute( 'team_container', 'class', 'team-3' );

$this->add_render_attribute( 'person_information_container', 'class', 'team-title' );
$this->add_render_attribute( 'person_information_container', 'href', $settings['person_information_container_link']['url'] );

if ( 'top' === ( $settings['team_title_position'] ) ) {
    $this->add_render_attribute( 'team_container', 'class', 'team-title-top' );
}


if ( ! empty( $person_information_container_link ) ) {

	$target   = $settings['person_information_container_link']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['person_information_container_link']['nofollow'] ? ' rel="nofollow"' : '';

	$this->add_render_attribute( 'person_information_container_link', 'href', $settings['person_information_container_link']['url'] );

	if ( $settings['person_information_container_link']['is_external'] ) {
		$this->add_render_attribute( 'person_information_container_link', 'target', '_blank' );
	}

	if ( $settings['person_information_container_link']['nofollow'] ) {
		$this->add_render_attribute( 'person_information_container_link', 'rel', 'nofollow' );
	}
}
?>

<div <?php echo $this->get_render_attribute_string( 'team_container' ); ?>>
    <div class="team-member">
        <div class="team-img">
            <img class="img-responsive" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo Control_Media::get_image_alt( $settings['person_image'] ); ?>" >
        </div>
        <div class="team-hover">
            <div class="description">
                <p <?php echo $this->get_render_attribute_string( 'person_aboutme' ); ?>><?php echo wp_kses( $settings['person_aboutme'], 'post' ); ?></p>
            </div>
        </div>
    </div>

    <a <?php echo $this->get_render_attribute_string( 'person_information_container' ); ?>>
        <h5 <?php echo $this->get_render_attribute_string( 'person_name' ); ?>><?php echo wp_kses( $settings['person_name'], 'post' ); ?></h5>
        <span <?php echo $this->get_render_attribute_string( 'person_position' ); ?>><?php echo wp_kses( $settings['person_position'], 'post' ); ?></span>
    </a>

    <?php if ( 'yes' === ( $settings['show_social_icons'] ) ) : ?>
        <div class="s-link">
        <?php
            $migration_allowed = Icons_Manager::is_migration_allowed();
            foreach ( $settings['social_icon_list'] as $index => $item ) {
            $migrated = isset( $item['__fa4_migrated']['social_icon'] );
            $is_new = empty( $item['social'] ) && $migration_allowed;
            $social = '';

            if ( ! empty( $item['social'] ) ) {
                $social = str_replace( 'fa fa-', '', $item['social'] );
            }

            if ( ( $is_new || $migrated ) && 'svg' !== $item['social_icon']['library'] ) {
                $social = explode( ' ', $item['social_icon']['value'], 2 );
                if ( empty( $social[1] ) ) {
                    $social = '';
                } else {
                    $social = str_replace( 'fa-', '', $social[1] );
                }
            }
            if ( 'svg' === $item['social_icon']['library'] ) {
                $social = get_post_meta( $item['social_icon']['value']['id'], '_wp_attachment_image_alt', true );
            }

            $link_key = 'link_' . $index;

            $this->add_render_attribute( $link_key, 'class', [
                'elementor-icon',
                'elementor-social-icon',
                'elementor-social-icon-' . $social,
                'elementor-repeater-item-' . $item['_id'],
            ] );

            $this->add_link_attributes( $link_key, $item['link'] );

        ?>
            <a <?php $this->print_render_attribute_string( $link_key ); ?>>
                <span class="elementor-screen-only"><?php echo esc_html( ucwords( $social ) ); ?></span>
                <?php
                if ( $is_new || $migrated ) {
                    Icons_Manager::render_icon( $item['social_icon'] );
                } else { ?>
                    <i class="<?php echo esc_attr( $item['social'] ); ?>"></i>
                <?php } ?>
            </a>
            <?php } ?>                
        </div>    
    <?php endif; ?>
</div>
