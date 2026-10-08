<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="container-home-first container p-3 bg-white">
        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
            <div class="row">
                <!-- Do the left sidebar check -->
                <?php do_action('justg_before_content'); ?>

                <div class="col-md">
                    <?php $carousel_cat = velocity_berita5_kategori('carousel_home'); ?>
                    <?php if ($carousel_cat !== 'disable') : ?>
                        <div class="part_carousel_home mb-3">
                            <div class="part-carousel-home">
                                <?php
                                module_vdposts(array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 6,
                                    'cat'            => $carousel_cat,
                                ), 'carousel');
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <main class="site-main col order-2" id="main">
                        <?php $post1_cat = velocity_berita5_kategori('posts_home_1'); ?>
                        <div class="widget part_posts_home_1 bg-color-theme p-2">
                            <div class="part-post-home-1">
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <?php
                                        module_vdposts(array(
                                            'post_type'      => 'post',
                                            'cat'            => $post1_cat,
                                            'posts_per_page' => 1,
                                        ), 'image');
                                        ?>
                                    </div>
                                    <div class="col-md">
                                        <?php
                                        module_vdposts(array(
                                            'post_type'      => 'post',
                                            'cat'            => $post1_cat,
                                            'posts_per_page' => 1,
                                        ), 'heading');
                                        ?>
                                        <div class="related-home text-white pt-2"><b><?php esc_html_e('Berita Terkait', 'justg'); ?></b></div>
                                        <?php
                                        module_vdposts(array(
                                            'post_type'      => 'post',
                                            'cat'            => $post1_cat,
                                            'posts_per_page' => 2,
                                            'offset'         => 1,
                                        ), 'title-half');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="part-home-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="widget part_posts_home_3 shadow-sm">
                                        <?php velocity_berita5_kepala_blok('posts_home_3', 'p-0 mb-0', 'bg-white text-dark p-2'); ?>
                                        <div class="part-post-home-3">
                                            <div class="col-post p-3">
                                                <?php
                                                module_vdposts(array(
                                                    'post_type'      => 'post',
                                                    'cat'            => velocity_berita5_kategori('posts_home_3'),
                                                    'posts_per_page' => 5,
                                                ), 'posts5');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <?php get_berita_iklan('iklan_home_2'); ?>
                                    </div>

                                    <div class="widget part_posts_home_5">
                                        <?php velocity_berita5_kepala_blok('posts_home_5'); ?>
                                        <div class="part-post-home-5">
                                            <div class="col-posts">
                                                <?php
                                                module_vdposts(array(
                                                    'post_type'      => 'post',
                                                    'cat'            => velocity_berita5_kategori('posts_home_5'),
                                                    'posts_per_page' => 4,
                                                ), 'posts2');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="widget part_posts_home_4 bg-color-theme">
                                        <?php velocity_berita5_kepala_blok('posts_home_4'); ?>
                                        <div class="part-post-home-4">
                                            <div class="col-posts-first px-2">
                                                <?php
                                                module_vdposts(array(
                                                    'post_type'      => 'post',
                                                    'cat'            => velocity_berita5_kategori('posts_home_4'),
                                                    'posts_per_page' => 11,
                                                ), 'posts3');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </main><!-- #main -->
                </div>

                <!-- Do the right sidebar check. -->
                <?php do_action('justg_after_content'); ?>

            </div><!-- .row -->

            <div class="row home-bottom">
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                    <?php
                    $postf_id  = 'posts_home_footer_' . $i;
                    $postf_cat = velocity_berita5_kategori($postf_id);
                    ?>
                    <div class="col-md-4">
                        <div class="widget post-home-footer part_<?php echo esc_attr($postf_id); ?>">
                            <?php velocity_berita5_kepala_blok($postf_id, 'p-0 mb-0', 'p-2'); ?>
                            <div class="col-post p-3 part_cat_<?php echo esc_attr($postf_id); ?>">
                                <?php
                                module_vdposts(array(
                                    'post_type'      => 'post',
                                    'cat'            => $postf_cat,
                                    'posts_per_page' => 1,
                                ), 'posts-head-footer');
                                module_vdposts(array(
                                    'post_type'      => 'post',
                                    'cat'            => $postf_cat,
                                    'posts_per_page' => 2,
                                    'offset'         => 1,
                                ), '');
                                ?>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <?php get_berita_iklan('iklan_home_bawah_1'); ?>
                </div>
                <div class="col-md-6">
                    <?php get_berita_iklan('iklan_home_bawah_2'); ?>
                </div>
            </div>

        </div><!-- #content -->

    </div><!-- #index-wrapper -->

    <?php
    get_footer();
