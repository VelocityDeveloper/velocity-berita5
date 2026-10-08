<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card shadow-sm bg-light pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                while (have_posts()) {
                    the_post();
                ?>

                    <?php the_title('<h1 class="entry-title h4 fw-bold">', '</h1>'); ?>


                    <?php velocity_berita5_info_post(); ?>

                    <div class="entry-content">

                        <?php
                        if (has_post_thumbnail() && $format !== 'video') {
                            echo '<figure class="mb-3">';
                            the_post_thumbnail('large', array('class' => 'img-fluid w-100', 'alt' => esc_attr(get_the_title()), 'loading' => false, 'fetchpriority' => 'high'));
                            $caption = get_the_post_thumbnail_caption();
                            if ($caption) {
                                echo '<figcaption class="small text-muted mt-1">' . esc_html($caption) . '</figcaption>';
                            }
                            echo '</figure>';
                        }
                        ?>

                        <?php the_content(); ?>
                        
                        <div class="pb-3">
                            <?php get_berita_iklan('iklan_content'); ?>
                        </div>

                        <?php
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                    <div class="related-post">
                        <div class="related-post-title border-bottom border-color-theme border-3 mb-2">
                            <span class="bg-color-theme text-white py-2 px-3 d-inline-block"><?php esc_html_e('BERITA TERKAIT', 'justg'); ?></span>
                        </div>
                        <div class="related-post-carousel overflow-hidden">
                            <?php
                            module_vdposts(array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 5,
                                'post__not_in'      => [get_the_ID()],
                                'category__in'      => wp_get_post_categories(get_the_ID()),
                            ), 'carousel');
                            ?>
                        </div>
                    </div>

                    <div class="single-post-nav d-md-flex justify-content-between border-top border-bottom pt-1 my-3">
                        <div class="share-post">
                            <?php echo justg_share(); ?>
                        </div>
                        <div class="nav-post">
                            <div class="btn-group" role="group" aria-label="Navigation Post">
                                <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if (!empty($prev_post)) {
                                    echo '<a href="' . esc_url(get_permalink($prev_post->ID)) . '" class="btn btn-sm btn-light border" title="' . esc_attr(get_the_title($prev_post)) . '">&laquo; ' . esc_html__('Sebelumnya', 'justg') . '</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . esc_url(get_permalink($next_post->ID)) . '" class="btn btn-sm btn-light border" title="' . esc_attr(get_the_title($next_post)) . '">' . esc_html__('Berikutnya', 'justg') . ' &raquo;</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="mostview-post">
                        <div class="row">
                            <div class="col-md-6 col-xl-7">
                                <h6 class="mb-3 fw-bold"><?php esc_html_e('BERITA TERPOPULER', 'justg'); ?></h6>
                                <div class="mostview-post-loop">
                                    <?php
                                    module_vdposts(array(
                                        'post_type'      => 'post',
                                        'posts_per_page' => 5,
                                        'post__not_in'   => array(get_the_ID()),
                                        'sortby'         => 'view',
                                    ), 'posts4');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-5">
                                <?php get_berita_iklan('iklan_content_2'); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $sosmed_warna = array('facebook' => '#2d59a1', 'twitter' => '#14171a', 'instagram' => '#e72283', 'youtube' => '#DD2C26');
                    $sosmed_ada   = array_filter(array_map(function ($key) {
                        return get_theme_mod('link_sosmed_' . $key, '');
                    }, array_combine(array_keys($sosmed_warna), array_keys($sosmed_warna))));
                    ?>
                    <?php if ($sosmed_ada) : ?>
                        <div class="sosmed-single alert alert-light rounded-0 shadow-sm my-3">
                            <h6 class="fw-bold"><?php esc_html_e('IKUTI KAMI', 'justg'); ?></h6>
                            <div class="row g-2">
                                <?php foreach ($sosmed_ada as $key => $datalink) : ?>
                                    <div class="col">
                                        <a class="btn border-0 shadow-sm rounded-0 w-100 btn-secondary" style="--bs-btn-bg:<?php echo esc_attr($sosmed_warna[$key]); ?>" href="<?php echo esc_url($datalink); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr(ucfirst($key)); ?>"><i class="fa fa-<?php echo esc_attr($key); ?>" aria-hidden="true"></i></a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
