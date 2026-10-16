<?php
    // Customer quotes. Missing rating shows as 5 stars.

    $page_id = get_queried_object_id();

    $testi_title   = get_field( 'home_testimonials_title', $page_id );
    $testi_content = get_field( 'home_testimonials_content', $page_id );

    $testi_query = new WP_Query(
        array(
            'post_type'      => 'testimonial',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        )
    );

    $testi_posts = ! empty( $testi_query->posts ) && is_array( $testi_query->posts )
        ? $testi_query->posts
        : array();

    $has_testi = ! empty( $testi_title ) || ! empty( $testi_content ) || ! empty( $testi_posts );

    if ( $has_testi ) :
    ?>
    <!-- Testimonials Section Start -->
    <section class="testimonials white-text">
        <div class="testimonials-bg">
            <img src="<?php echo esc_url( home_url( '/wp-content/uploads/2026/08/see-what-our-customers-are-saying.jpg' ) ); ?>" alt="" title="See what our customers are saying" width="1520" height="867">
        </div>

        <div class="testimonials-ornament" aria-hidden="true">
            <div class="testimonials-ornament-shape"></div>

            <div class="testimonials-ornament-badge">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/quote.svg' ); ?>" alt="" title="Quote" width="64" height="64">
            </div>
        </div>

        <div class="container">
            <div class="section-head testimonials-head text-center">
                <div class="section-head-title-group">
                    <?php if ( ! empty( $testi_title ) ) : ?>
                        <h2 class="h3-title section-head-title mb-0 wow fadeup-animation" data-wow-delay="0.2s"><?php echo esc_html( $testi_title ); ?></h2>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $testi_content ) ) : ?>
                    <div class="section-head-desc text-l wow fadeup-animation" data-wow-delay="0.2s">
                        <?php echo wp_kses_post( $testi_content ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $testi_posts ) ) : ?>
                <div class="testimonials-slider-wp wow fadeup-animation" data-wow-delay="0.2s">
                    <div class="testimonials-slider">
                        <div class="custom-arrow-wrapper"></div>
    
                        <div class="testimonials-swiper">
                            <?php
                            foreach ( $testi_posts as $testi_post ) :
    
                                if ( ! $testi_post instanceof WP_Post ) {
                                    continue;
                                }
    
                                $testi_quote = $testi_post->post_content;
    
                                if ( empty( $testi_quote ) ) {
                                    continue;
                                }
    
                                $testi_name   = get_the_title( $testi_post->ID );
                                $testi_rating = get_field( 'star_rating', $testi_post->ID );
    
                                if ( is_array( $testi_rating ) ) {
                                    $testi_rating = $testi_rating['value'] ?? 0;
                                }
    
                                $testi_rating = is_numeric( $testi_rating ) ? (float) $testi_rating : 5;
                                $testi_rating = min( 5, max( 0, $testi_rating ) );
                                $testi_fill   = ( $testi_rating / 5 ) * 100;
                                ?>
    
                                <div class="testimonials-item">
                                    <div class="testimonials-card">
                                        <div class="star-rating-wp">
                                            <div class="star-rating">
                                                <span class="star-rating-fill" style="width:<?php echo esc_attr( $testi_fill ); ?>%"></span>
                                            </div>
                                        </div>
    
                                        <div class="testimonials-card-text overflow-text" data-simplebar>
                                            <?php echo apply_filters( 'the_content', $testi_quote ); ?>
                                        </div>
    
                                        <div class="testimonials-card-author">
                                            <h3 class="text-s mb-0"><?php echo esc_html( $testi_name ); ?></h3>
                                        </div>
                                    </div>
                                </div>
    
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <!-- Testimonials Section End -->
    <?php endif; ?>