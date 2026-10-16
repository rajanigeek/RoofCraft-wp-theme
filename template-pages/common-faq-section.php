<?php
// FAQ accordion. First question starts open.
$faq_title  = get_field( 'service_faq_title' );
$faq_content = get_field( 'service_faq_content' );
$faq_details = get_field( 'service_faq_details' );
$faq_details = is_array( $faq_details ) ? $faq_details : array();

if ( empty( $faq_title ) && empty( $faq_content ) && empty( $faq_details ) ) {
    return;
}
?>
<!-- FAQ Section Start -->
<section class="faq">
    <div class="container">
        <?php if ( ! empty( $faq_title ) || ! empty( $faq_content ) ) : ?>
            <div class="section-head faq-head text-center">
                <?php if ( ! empty( $faq_title ) ) : ?>
                    <h2 class="h4-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $faq_title ); ?></h2>
                <?php endif; ?>
                <?php if ( ! empty( $faq_content ) ) : ?>
                    <div class="section-head-desc wow fadeup-animation" data-wow-delay="0.2s">
                        <?php echo wp_kses_post( $faq_content ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ( ! empty( $faq_details ) ) : ?>
            <div class="faq-accordion accordion wow fadeup-animation" data-wow-delay="0.2s">
                <?php
                $faq_index = 0;
                foreach ( $faq_details as $faq_item ) :
                    $question = ! empty( $faq_item['question'] ) ? $faq_item['question'] : '';
                    $answer  = ! empty( $faq_item['answer'] ) ? $faq_item['answer'] : '';
                    if ( empty( $question ) && empty( $answer ) ) {
                        continue;
                    }
                    $faq_active = ( 0 === $faq_index ) ? ' accordion-box-active' : '';
                    $faq_index++;
                    ?>
                    <div class="accordion-box<?php echo esc_attr( $faq_active ); ?>">
                        <?php if ( ! empty( $question ) ) : ?>
                            <div class="accordion-box-title">
                                <h3 class="h6-title mb-0"><?php echo esc_html( $question ); ?></h3>
                                <span class="accordion-box-toggle-icon">
                                    <iconify-icon icon="ci:chevron-down"></iconify-icon>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $answer ) ) : ?>
                            <div class="accordion-box-content">
                                <div class="accordion-box-content-inr">
                                    <?php echo wp_kses_post( $answer ); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- FAQ Section End -->