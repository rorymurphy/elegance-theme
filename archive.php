<?php
get_header();
get_template_part('templates/page-header');
?>
<section id="main-content">
    <div class="container">
        <?php if(have_posts()): ?>
            <header class="page-header">
                    <h1 class="page-title">
                            <?php if ( is_day() ) : ?>
                                    <?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
                            <?php elseif ( is_month() ) : ?>
                                    <?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
                            <?php elseif ( is_year() ) : ?>
                                    <?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
                            <?php else : ?>
                                    <?php _e( 'Blog Archives', 'twentyeleven' ); ?>
                            <?php endif; ?>
                    </h1>
            </header>
            <div class="row">
                <div class="col-md-9">
                    <?php while(have_posts()) :
                        the_post();
                        get_template_part('templates/post', 'loop');
                    endwhile;
                    ?>
                </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-9"></div>
        <?php endif; ?>
            <div class="col-md-3">
                <?php dynamic_sidebar('blog-rail'); ?>
            </div>
        </div>   
    </div>
</section>
<?php get_footer();
