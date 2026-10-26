<?php get_header(); // load header ?>

<?php 
// 1. Fetch Archive Page Background Color from the first portfolio post
$archive_bg_color = '#f8f9fa'; // Fallback default
if ( have_posts() ) {
    // Look ahead at the first post to get the main archive page background
    $first_post_id    = $posts[0]->ID;
    $custom_archive_bg = get_post_meta( $first_post_id, 'archive_bg_color', true );
    if ( ! empty( $custom_archive_bg ) ) {
        $archive_bg_color = $custom_archive_bg;
    }
}
?>

<section class="py-5" style="background-color: <?php echo esc_attr( $archive_bg_color ); ?>; min-height: 80vh;">
    <div class="container px-5 my-5">
        <div class="text-center mb-5">
            <h1 class="fw-bolder">Our Work</h1>
            <p class="lead fw-normal text-muted mb-0">Company portfolio</p>
        </div>

        <div class="row gx-5">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php 
                    // 2. Fetch Card Background Color for Main Page from Pods field 'archive_card_bg'
                    $card_bg = get_post_meta( get_the_ID(), 'archive_card_bg', true );
                    if ( empty( $card_bg ) ) {
                        $card_bg = '#ffffff'; // Fallback default card color
                    }
                    ?>

                    <div class="col-lg-6 mb-5">
                        <div class="card h-100 shadow border-0 overflow-hidden" style="background-color: <?php echo esc_attr( $card_bg ); ?>;">

                            <?php 
                            // 1. Check if a Featured Image is set
                            if ( has_post_thumbnail() ) : 
                            ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img class="card-img-top" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title_attribute(); ?>" />
                                </a>

                            <?php 
                            // 2. If no Featured Image, automatically grab the picture added with 'Add Media'
                            else : 
                                $content = get_the_content();
                                preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $content, $matches);
                                $first_img = !empty($matches[1][0]) ? $matches[1][0] : '';

                                if ( !empty($first_img) ) :
                            ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="card-img-top" src="<?php echo esc_url($first_img); ?>" alt="<?php the_title_attribute(); ?>" />
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <a class="text-decoration-none link-dark stretched-link" href="<?php the_permalink(); ?>">
                                    <h5 class="card-title mb-3"><?php the_title(); ?></h5>
                                </a>
                                <p class="card-text mb-0"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                            </div>

                        </div>
                    </div>

                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-12 text-center">
                    <p>No portfolio items found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); // load footer ?>