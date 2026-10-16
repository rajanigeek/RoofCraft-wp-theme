<?php /* Template Name: Contact */
get_header();

// Contact copy, phone, and the form all come from options.
$contact_title       = get_field( 'contact_title', 'option' );
$contact_description = get_field( 'contact_description', 'option' );
$contact_form        = get_field( 'contact_form', 'option' );
$footer_options      = get_field( 'footer_options', 'option' );

$pr_phone_number = get_field( 'pr_phone_number', 'option' );
$phone_url       = '';
$phone_title     = '';
if ( is_array( $pr_phone_number ) ) {
	$phone_url   = ! empty( $pr_phone_number['url'] ) ? $pr_phone_number['url'] : '';
	$phone_title = ! empty( $pr_phone_number['title'] ) ? $pr_phone_number['title'] : $phone_url;
} elseif ( ! empty( $pr_phone_number ) ) {
	$phone_title = (string) $pr_phone_number;
	$digits      = preg_replace( '/\D+/', '', $phone_title );
	$phone_url   = $digits ? 'tel:' . $digits : '';
}

$email_id   = get_field( 'email_id', 'option' );
$email_url  = '';
$email_text = '';
if ( is_array( $email_id ) ) {
	$email_url  = ! empty( $email_id['url'] ) ? $email_id['url'] : '';
	$email_text = ! empty( $email_id['title'] ) ? $email_id['title'] : $email_url;
} elseif ( ! empty( $email_id ) ) {
	$email_text = (string) $email_id;
	$email_url  = 'mailto:' . sanitize_email( $email_text );
}

$address_text = get_field( 'address_text', 'option' );
$address_url  = get_field( 'address_url', 'option' );

$form_id    = 0;
$form_title = '';
if ( is_object( $contact_form ) && ! empty( $contact_form->ID ) ) {
	$form_id    = (int) $contact_form->ID;
	$form_title = ! empty( $contact_form->post_title ) ? $contact_form->post_title : '';
} elseif ( is_numeric( $contact_form ) ) {
	$form_id = (int) $contact_form;
}

$has_phone   = $phone_url && $phone_title;
$has_email   = $email_url && $email_text;
$has_address = $address_text || $address_url;
$has_stack   = $has_email || $has_address;
$has_meta    = is_string( $footer_options ) && $footer_options !== '';
$has_form    = $form_id > 0;
$has_head    = $contact_title || $contact_description;
$has_details = $has_phone || $has_stack || $has_meta;
$has_left    = $has_head || $has_details;
$has_contact = $has_left || $has_form;
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
        <?php get_template_part('template-pages/common','inner-banner-section'); ?>

		<?php if ( $has_contact ) : ?>
		<!-- Contact Start -->
		<section class="contact-6">
			<div class="container">
				<div class="row contact-6-row">
					<?php if ( $has_left ) : ?>
					<div class="col-lg-6">
						<div class="contact-6-content">
							<?php if ( $has_head ) : ?>
							<div class="section-head contact-6-head wow fadeup-animation" data-wow-delay="0.2s">
								<?php if ( ! empty( $contact_title ) ) : ?>
									<h2 class="h2-title section-head-title mb-0"><?php echo esc_html( $contact_title ); ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $contact_description ) ) : ?>
									<div class="section-head-desc">
										<?php echo wp_kses_post( $contact_description ); ?>
									</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
							<?php if ( $has_details ) : ?>
							<div class="contact-6-details wow fadeup-animation" data-wow-delay="0.2s">
								<?php if ( $has_phone ) : ?>
								<a class="contact-6-phone" href="<?php echo esc_url( $phone_url ); ?>" title="<?php echo esc_attr( $phone_title ); ?>">
									<span class="contact-6-phone-icon">
										<iconify-icon icon="mdi:phone"></iconify-icon>
									</span>
									<span class="h4-title mb-0"><?php echo esc_html( $phone_title ); ?></span>
								</a>
								<?php endif; ?>
								<?php if ( $has_stack ) : ?>
								<div class="contact-6-stack">
									<?php if ( $has_email ) : ?>
									<div class="contact-6-label">Email:</div>
									<div class="contact-6-value text-l">
										<a href="<?php echo esc_url( $email_url ); ?>" title="<?php echo esc_attr( $email_text ); ?>"><?php echo esc_html( $email_text ); ?></a>
									</div>
									<?php endif; ?>
									<?php if ( $has_address ) : ?>
									<div class="contact-6-label">Address:</div>
									<div class="contact-6-value text-l">
										<?php if ( $address_url ) : ?>
											<a href="<?php echo esc_url( $address_url ); ?>" title="<?php echo esc_attr( $address_text ? $address_text : $address_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $address_text ? $address_text : $address_url ); ?></a>
										<?php else : ?>
											<?php echo esc_html( $address_text ); ?>
										<?php endif; ?>
									</div>
									<?php endif; ?>
								</div>
								<?php endif; ?>
								<?php if ( $has_meta ) : ?>
								<div class="contact-6-meta text-l">
									<?php echo wp_kses_post( $footer_options ); ?>
								</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php if ( $has_form ) : ?>
					<div class="col-lg-6">
						<div class="form-wp wow fadeup-animation" data-wow-delay="0.2s">
							<?php echo do_shortcode( '[contact-form-7 id="' . esc_attr( $form_id ) . '"' . ( $form_title ? ' title="' . esc_attr( $form_title ) . '"' : '' ) . ']' ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<!-- Contact End -->
		<?php endif; ?>

        <div class="section-separator bg-white"><span class="section-separator-inner bg-orange-100"></span></div>
		
		<div class="contact-service-area">
			<?php get_template_part('template-pages/common','service-area-section'); ?>
		</div>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>
