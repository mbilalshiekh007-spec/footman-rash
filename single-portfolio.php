<?php get_header(); // load header ?>

<?php 
if ( have_posts() ) :
    while ( have_posts() ) : the_post(); 

        // 1. Fetch Single Page Background Color ('portfolio_bg_color')
        $portfolio_bg_color = get_post_meta( get_the_ID(), 'portfolio_bg_color', true );
        if ( empty( $portfolio_bg_color ) ) {
            $portfolio_bg_color = '#ffffff'; // Fallback default page background
        }

        // 2. Fetch Single Card/Box Color ('portfolio_card_color')
        $box_color = get_post_meta( get_the_ID(), 'portfolio_card_color', true );
        if ( empty( $box_color ) ) {
            $box_color = '#ffffff'; // Fallback default card color
        }
?>

<section class="py-5" style="background-color: <?php echo esc_attr( $portfolio_bg_color ); ?>; min-height: 80vh;">
    <div class="container px-5 my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <!-- 3. Apply Card/Box Background Color -->
                <div class="portfolio-item-box p-4 p-md-5 rounded-4 shadow-sm mb-4" style="background-color: <?php echo esc_attr( $box_color ); ?>;">

                    <!-- Project Title -->
                    <h1 class="fw-bolder mb-3"><?php the_title(); ?></h1>

                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="mb-4">
                            <img class="img-fluid rounded-3 w-100" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>" />
                        </div>
                    <?php endif; ?>

                    <!-- Post Content -->
                    <div class="portfolio-content fs-5 mb-0">
                        <?php the_content(); ?>
                    </div>

                </div><!-- /.portfolio-item-box -->

                <!-- Back to Portfolio Grid Button -->
                <div class="mt-4">
                    <a href="<?php echo esc_url( get_post_type_archive_link('portfolio') ); ?>" class="btn btn-primary btn-lg">
                        &larr; Back to Portfolio
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

<?php 
    endwhile;
endif; 
?>

<?php get_footer(); // load footer ?>