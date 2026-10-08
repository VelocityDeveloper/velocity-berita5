<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card shadow-sm bg-light pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <?php
                        the_archive_title('<h1 class="page-title text-uppercase">', '</h1>');
                        the_archive_description('<div class="taxonomy-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->
                    <?php
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                    ?>
                        <article class="block-primary mb-4">
                            <?php if ($postcount === 1) : ?>
                                <div class="post-tumbnail position-relative border border-4">
                                    <div class="ratio ratio-21x9 bg-light overflow-hidden">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')) . '" alt="' . esc_attr(get_the_title()) . '" /></a>';
                                        } else {
                                            echo '<a class="vdposts-noimg" href="' . esc_url(get_permalink()) . '" aria-label="' . esc_attr(get_the_title()) . '"></a>';
                                        } ?>
                                    </div>
                                    <div class="position-absolute px-3 pt-2 bottom-0 end-0 start-0 bg-dark" style="--bs-bg-opacity: 0.90;">
                                        <?php
                                        the_title(
                                            sprintf('<h2 class="h5 fw-bold"><a href="%s" class="text-white" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h2>'
                                        );
                                        ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="post-tumbnail position-relative border border-4">
                                            <div class="ratio ratio-4x3 bg-light overflow-hidden">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    echo '<a href="' . esc_url(get_permalink()) . '"><img src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async"/></a>';
                                                } else {
                                                    echo '<a class="vdposts-noimg" href="' . esc_url(get_permalink()) . '" aria-label="' . esc_attr(get_the_title()) . '"></a>';
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="post-text">
                                            <?php
                                            the_title(
                                                sprintf('<h2 class="h6 mb-md-3 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                                '</a></h2>'
                                            );
                                            ?>
                                            <div class="post-excerpt text-muted">
                                                <div class="d-none d-md-block">
                                                    <?php echo vdposts_ringkas(25); ?>
                                                </div>
                                                <div class="d-md-none">
                                                    <small>
                                                        <?php echo vdposts_ringkas(10); ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php velocity_berita5_info_post(); ?>

                        </article>

                <?php

                        if ($postcount == 1) :
                            echo '<div class="mb-3">';
                                get_berita_iklan('iklan_archive');
                            echo '</div>';
                        endif;
                        if ($postcount == 8) :
                            echo '<div class="mb-3">';
                                get_berita_iklan('iklan_archive_2');
                            echo '</div>';
                        endif;

                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
