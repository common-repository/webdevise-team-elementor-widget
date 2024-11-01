<?php

if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Utils;

$image_url    = ( $settings['person_image']['id'] ) ? Group_Control_Image_Size::get_attachment_image_src( $settings['person_image']['id'], 'imagesize', $settings ) : $settings['person_image']['url'];
$facebook_url = $settings['person_link_facebook']['url'];
$twitter_url  = $settings['person_link_twitter']['url'];
$linkedin_url = $settings['person_link_linkedin']['url'];

$this->add_render_attribute( 'team-2-container', 'class', [ 'team-2', 'team-2-container' ] );

if ( Utils::get_placeholder_image_src() === ( $settings['person_image']['url'] ) ) {
	$this->add_render_attribute( 'team-2-container', 'class', 'default-image' );
}

$this->add_inline_editing_attributes( 'person_name', 'none' );
$this->add_render_attribute( 'person_name', 'class', 'team-2-username' );
$this->add_render_attribute( 'person_position', 'class', 'team-2-user-position' );
$this->add_inline_editing_attributes( 'person_link_text', 'none' );

if ( ! empty( $facebook_url ) ) {

	$target   = $settings['person_link_facebook']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['person_link_facebook']['nofollow'] ? ' rel="nofollow"' : '';

	$this->add_render_attribute( 'person_link_facebook', 'href', $settings['person_link_facebook']['url'] );

	if ( $settings['person_link_facebook']['is_external'] ) {
		$this->add_render_attribute( 'person_link_facebook', 'target', '_blank' );
	}

	if ( $settings['person_link_facebook']['nofollow'] ) {
		$this->add_render_attribute( 'person_link_facebook', 'rel', 'nofollow' );
	}
}
if ( ! empty( $twitter_url ) ) {

	$target   = $settings['person_link_twitter']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['person_link_twitter']['nofollow'] ? ' rel="nofollow"' : '';

	$this->add_render_attribute( 'person_link_twitter', 'href', $settings['person_link_twitter']['url'] );

	if ( $settings['person_link_twitter']['is_external'] ) {
		$this->add_render_attribute( 'person_link_twitter', 'target', '_blank' );
	}

	if ( $settings['person_link_twitter']['nofollow'] ) {
		$this->add_render_attribute( 'person_link_twitter', 'rel', 'nofollow' );
	}
}
if ( ! empty( $linkedin_url ) ) {

	$target   = $settings['person_link_linkedin']['is_external'] ? ' target="_blank"' : '';
	$nofollow = $settings['person_link_linkedin']['nofollow'] ? ' rel="nofollow"' : '';

	$this->add_render_attribute( 'person_link_linkedin', 'href', $settings['person_link_linkedin']['url'] );

	if ( $settings['person_link_linkedin']['is_external'] ) {
		$this->add_render_attribute( 'person_link_linkedin', 'target', '_blank' );
	}

	if ( $settings['person_link_linkedin']['nofollow'] ) {
		$this->add_render_attribute( 'person_link_linkedin', 'rel', 'nofollow' );
	}
}
?>

<div <?php echo $this->get_render_attribute_string( 'team-2-container' ); ?>>
	<div class="team-2-item">
		<div class="team-2-user">
			<div class="team-2-user-avatar"><img class="img-responsive" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo Control_Media::get_image_alt( $settings['person_image'] ); ?>" ></div>

				<div <?php echo $this->get_render_attribute_string( 'person_name' ); ?>><?php echo wp_kses( $settings['person_name'], 'post' ); ?></div>

				<div <?php echo $this->get_render_attribute_string( 'person_position' ); ?>><?php echo wp_kses( $settings['person_position'], 'post' ); ?></div>

				<ul class="team-2-social">

					<?php if ( ! empty( $facebook_url ) ) : ?>
						<li class="team-2-social-item facebook"><a <?php echo $this->get_render_attribute_string( 'person_link_facebook' ); ?>>
								<svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
									<path d="M14 9h3l-.375 3H14v9h-3.89v-9H8V9h2.11V6.984c0-1.312.327-2.304.984-2.976C11.75 3.336 12.844 3 14.375 3H17v3h-1.594c-.594 0-.976.094-1.148.281-.172.188-.258.5-.258.938V9z" fill-rule="evenodd"></path>
								</svg></a></li>
					<?php endif; ?>

					<?php if ( ! empty( $twitter_url ) ) : ?>      
						<li class="team-2-social-item twitter"><a <?php echo $this->get_render_attribute_string( 'person_link_twitter' ); ?>>
								<svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
									<path d="M20.875 7.5v.563c0 3.28-1.18 6.257-3.54 8.93C14.978 19.663 11.845 21 7.938 21c-2.5 0-4.812-.687-6.937-2.063.5.063.86.094 1.078.094 2.094 0 3.969-.656 5.625-1.968a4.563 4.563 0 0 1-2.625-.915 4.294 4.294 0 0 1-1.594-2.226c.375.062.657.094.844.094.313 0 .719-.063 1.219-.188-1.031-.219-1.899-.742-2.602-1.57a4.32 4.32 0 0 1-1.054-2.883c.687.328 1.375.516 2.062.516C2.61 9.016 1.938 7.75 1.938 6.094c0-.782.203-1.531.609-2.25 2.406 2.969 5.515 4.547 9.328 4.734-.063-.219-.094-.562-.094-1.031 0-1.281.438-2.36 1.313-3.234C13.969 3.437 15.047 3 16.328 3s2.375.484 3.281 1.453c.938-.156 1.907-.531 2.907-1.125-.313 1.094-.985 1.938-2.016 2.531.969-.093 1.844-.328 2.625-.703-.563.875-1.312 1.656-2.25 2.344z" fill-rule="evenodd"></path>
								</svg></a></li>
					<?php endif; ?>   

					<?php if ( ! empty( $linkedin_url ) ) : ?>
						<li class="team-2-social-item linkedin"><a <?php echo $this->get_render_attribute_string( 'person_link_linkedin' ); ?>>
								<svg viewBox="0 0 24 24" width="18" height="18" xmlns="http://www.w3.org/2000/svg">
									<path d="M19.547 3c.406 0 .75.133 1.031.398.281.266.422.602.422 1.008v15.047c0 .406-.14.766-.422 1.078a1.335 1.335 0 0 1-1.031.469h-15c-.406 0-.766-.156-1.078-.469C3.156 20.22 3 19.86 3 19.453V4.406c0-.406.148-.742.445-1.008C3.742 3.133 4.11 3 4.547 3h15zM8.578 18V9.984H6V18h2.578zM7.36 8.766c.407 0 .743-.133 1.008-.399a1.31 1.31 0 0 0 .399-.96c0-.407-.125-.743-.375-1.009C8.14 6.133 7.813 6 7.406 6c-.406 0-.742.133-1.008.398C6.133 6.664 6 7 6 7.406c0 .375.125.696.375.961.25.266.578.399.984.399zM18 18v-4.688c0-1.156-.273-2.03-.82-2.624-.547-.594-1.258-.891-2.133-.891-.938 0-1.719.437-2.344 1.312V9.984h-2.578V18h2.578v-4.547c0-.312.031-.531.094-.656.25-.625.687-.938 1.312-.938.875 0 1.313.578 1.313 1.735V18H18z" fill-rule="evenodd"></path>
								</svg></a></li>
					<?php endif; ?>  

				</ul>

		</div>
	</div>
</div>
