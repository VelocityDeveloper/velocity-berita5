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
                    <div class="part_carousel_home mb-3">
                        <?php
                        $carousel_cat = velocitytheme_option('cat_carousel_home');
                        if ($carousel_cat !== 'disable') {
                            echo '<div class="part-carousel-home pt-3">';
                            module_vdposts(array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 6,
                                'cat'               => $carousel_cat,
                            ), 'carousel');
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <main class="site-main col order-2" id="main">
                        <?php
                        $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                        $post1_cat      = velocitytheme_option('cat_posts_home_1');
                        ?>
                        <div class="widget part_posts_home_1 bg-color-theme p-2">
                            <div class="part-post-home-1">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php
                                        $post1_args = array(
                                            'post_type' => 'post',
                                            'cat'       => $post1_cat,
                                            'posts_per_page' => 1,
                                        );
                                        module_vdposts($post1_args, 'image');
                                        ?>
                                    </div>
                                    <div class="col-md">
                                        <?php
                                        $post1_args = array(
                                            'post_type' => 'post',
                                            'cat'       => $post1_cat,
                                            'posts_per_page' => 1,
                                        );
                                        module_vdposts($post1_args, 'heading');
                                        ?>
                                        <div class="related-home text-white pt-2"><b>Related post</b></div>
                                        <?php
                                        $post1_args = array(
                                            'post_type' => 'post',
                                            'cat'       => $post1_cat,
                                            'posts_per_page' => 2,
                                            'offset' => 1,
                                        );
                                        module_vdposts($post1_args, 'title-half');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="part-home-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php
                                    $post3_title    = velocitytheme_option('title_posts_home_3', 'Recent Posts');
                                    $post3_cat      = velocitytheme_option('cat_posts_home_3');
                                    ?>
                                    <div class="widget part_posts_home_3 shadow">
                                        <h3 class="widget-title p-0 d-flex align-items-center justify-content-between mb-0">
                                            <span class="bg-white text-dark p-2"><?php echo $post3_title; ?></span>
                                            <?php if ($post3_cat && $post3_cat !== 'disable') : ?>
                                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post3_cat); ?>">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            <?php endif; ?>
                                        </h3>
                                        <div class="part-post-home-3">
                                            <div class="col-post p-3">
                                                <?php
                                                $post3_args = array(
                                                    'post_type' => 'post',
                                                    'cat'       => $post3_cat,
                                                    'posts_per_page' => 5,
                                                );
                                                module_vdposts($post3_args, 'posts5');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <?php get_berita_iklan('iklan_home_2'); ?>
                                    </div>

                                    <?php
                                    $post5_title    = velocitytheme_option('title_posts_home_5', 'Recent Posts');
                                    $post5_cat      = velocitytheme_option('cat_posts_home_5');
                                    ?>
                                    <div class="widget part_posts_home_5">
                                        <h3 class="widget-title d-flex align-items-center justify-content-between">
                                            <span><?php echo $post5_title; ?></span>
                                            <?php if ($post5_cat && $post5_cat !== 'disable') : ?>
                                                <a class="btn btn-warning btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post5_cat); ?>">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            <?php endif; ?>
                                        </h3>
                                        <div class="part-post-home-5">
                                            <div class="col-posts">
                                                <?php
                                                $post5_args = array(
                                                    'post_type' => 'post',
                                                    'cat'       => $post5_cat,
                                                    'posts_per_page' => 4,
                                                );
                                                module_vdposts($post5_args, 'posts2');
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col">

                                    <?php
                                    $post4_title    = velocitytheme_option('title_posts_home_4', 'Recent Posts');
                                    $post4_cat      = velocitytheme_option('cat_posts_home_4');
                                    ?>
                                    <div class="widget part_posts_home_4 bg-color-theme">
                                        <h3 class="widget-title d-flex align-items-center justify-content-between">
                                            <span><?php echo $post4_title; ?></span>
                                            <?php if ($post4_cat && $post4_cat !== 'disable') : ?>
                                                <a class="btn btn-warning text-dark btn-sm shadow py-0 px-1" href="<?php echo get_tag_link($post4_cat); ?>">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            <?php endif; ?>
                                        </h3>
                                        <div class="part-post-home-4">
                                            <div class="col-posts-first px-2">
                                                <?php
                                                $post4_args = array(
                                                    'post_type' => 'post',
                                                    'cat'       => $post4_cat,
                                                    'posts_per_page' => 11,
                                                );
                                                module_vdposts($post4_args, 'posts3');
                                                ?>
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

            <div class="row widget home-bottom">
                <div class="col-md-4">
                    <div class="post-home-footer  part_posts_home_footer_1">
                        <?php
                        $postf1_title    = velocitytheme_option('title_posts_home_footer_1', 'Recent Posts');
                        $postf1_cat      = velocitytheme_option('cat_posts_home_footer_1');
                        ?>
                        <h3 class="widget-title p-0 d-flex align-items-center justify-content-between mb-0">
                            <span class="p-2"><?php echo $postf1_title; ?></span>
                            <?php if ($postf1_cat && $postf1_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1 me-2" href="<?php echo get_tag_link($postf1_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="col-post p-3 part_cat_posts_home_footer_1">
                            <?php
                            $postf1_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf1_cat,
                                'posts_per_page' => 1,
                            );
                            module_vdposts($postf1_args, 'posts-head-footer');
                            ?>
                            <?php
                            $postf1_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf1_cat,
                                'posts_per_page' => 2,
                                'offset' => 1
                            );
                            module_vdposts($postf1_args, '');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-home-footer  part_posts_home_footer_2">
                        <?php
                        $postf2_title    = velocitytheme_option('title_posts_home_footer_2', 'Recent Posts');
                        $postf2_cat      = velocitytheme_option('cat_posts_home_footer_2');
                        ?>
                        <h3 class="widget-title p-0 d-flex align-items-center justify-content-between mb-0">
                            <span class="p-2"><?php echo $postf2_title; ?></span>
                            <?php if ($postf2_cat && $postf2_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1 me-2" href="<?php echo get_tag_link($postf2_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="col-post p-3 part_cat_posts_home_footer_2">
                            <?php
                            $postf2_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf2_cat,
                                'posts_per_page' => 1,
                            );
                            module_vdposts($postf2_args, 'posts-head-footer');
                            ?>
                            <?php
                            $postf2_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf2_cat,
                                'posts_per_page' => 2,
                                'offset' => 1
                            );
                            module_vdposts($postf2_args, '');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="post-home-footer  part_posts_home_footer_3">
                        <?php
                        $postf3_title    = velocitytheme_option('title_posts_home_footer_3', 'Recent Posts');
                        $postf3_cat      = velocitytheme_option('cat_posts_home_footer_3');
                        ?>
                        <h3 class="widget-title p-0 d-flex align-items-center justify-content-between mb-0">
                            <span class="p-2"><?php echo $postf3_title; ?></span>
                            <?php if ($postf3_cat && $postf3_cat !== 'disable') : ?>
                                <a class="btn btn-warning btn-sm shadow py-0 px-1 me-2" href="<?php echo get_tag_link($postf3_cat); ?>">
                                    <i class="fa fa-rss"></i>
                                </a>
                            <?php endif; ?>
                        </h3>
                        <div class="col-post p-3 part_cat_posts_home_footer_1">
                            <?php
                            $postf3_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf3_cat,
                                'posts_per_page' => 1,
                            );
                            module_vdposts($postf3_args, 'posts-head-footer');
                            ?>
                            <?php
                            $postf3_args = array(
                                'post_type' => 'post',
                                'cat'       => $postf1_cat,
                                'posts_per_page' => 2,
                                'offset' => 1
                            );
                            module_vdposts($postf3_args, '');
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
