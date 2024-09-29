<?php

/**
 * Template Function
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


if (!function_exists('justg_header_open')) {
    /**
     * Display header open
     * 
     */
    function justg_header_open()
    {
        $header_container = velocitytheme_option('select_header_container', 'full');
        $header_position    = velocitytheme_option('select_header_position', 'relative');
        $header1 = [
            'fixed'     => 'container mx-auto px-3 bg-transparent',
            'full'      => 'py-2',
            'stretch'   => 'p-2',
        ];
        $header2 = [
            'fixed'     => '',
            'full'      => 'container mx-auto px-0 bg-transparent',
            'stretch'   => '',
        ];

        echo '<header id="wrapper-header" class="bg-header header-' . $header_container . ' ' . $header_position . '">';
        echo '<div id="wrapper-navbar" class="' . $header1[$header_container] . '" itemscope itemtype="http://schema.org/WebSite">';
        echo '<div class="' . $header2[$header_container] . '">';
    }
}

if (!function_exists('justg_header_menu')) {
    /**
     * Display Header Menu
     * 
     */
    function justg_header_menu()
    {
        $container = velocitytheme_option('justg_container_type', 'container');
?>
        <nav id="main-nav" class="navbar navbar-expand-md navbar-light py-3" aria-labelledby="main-nav-label">

            <h2 id="main-nav-label" class="screen-reader-text">
                <?php esc_html_e('Main Navigation', 'justg'); ?>
            </h2>

            <div class="<?php echo esc_attr($container); ?>">

                <!-- Your site title as branding in the menu -->
                <?php if (!has_custom_logo()) { ?>

                    <?php if (is_front_page() && is_home()) : ?>

                        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

                    <?php else : ?>

                        <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                    <?php endif; ?>

                <?php
                } else {
                    the_custom_logo();
                }
                ?>
                <!-- end custom logo -->

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

                    <div class="offcanvas-header justify-content-end">
                        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 4,
                            'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </div><!-- .offcanvas -->

            </div><!-- .container(-fluid) -->

        </nav><!-- .site-navigation -->
        <?php
    }
}

if (!function_exists('justg_header_close')) {
    /**
     * Display header close
     * 
     */
    function justg_header_close()
    {
        echo '</div></div></header>';
    }
}

if (!function_exists('justg_breadcrumb')) {
    /**
     * Function Breadcrumb
     * 
     */
    function justg_breadcrumb()
    {

        $sep = velocitytheme_option('text_breadcrumb_separator', '/');
        $sep = '<span class="separator"> ' . $sep . ' </span>';

        $breadcrumbdisable   = velocitytheme_option('breadcrumb_disable', array());
        $breadcrumb_position = velocitytheme_option('breadcrumb_position', 'justg_before_title');
        $showbreadcrumb     = true;

        if (is_front_page() && in_array('disable-on-home', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if (!is_front_page() && is_singular('page') && in_array('disable-on-page', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if (is_archive() && in_array('disable-on-archive', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if (is_singular('post') && in_array('disable-on-post', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if (is_404() && in_array('disable-on-404', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if (in_array('disable-on-all', $breadcrumbdisable)) {
            $showbreadcrumb = false;
        }

        if ($showbreadcrumb) {

            echo '<div class="justg-breadcrumbs breadcrumbs-' . $breadcrumb_position . '">';

            if ($breadcrumb_position == 'justg_top_content') {
                echo '<div class="container mt-2">';
            }

            echo '<div class="breadcrumbs pb-2"  itemscope itemtype="https://schema.org/BreadcrumbList">';
            echo '<div class="breadcrumbs-inner">';

            // Home Url
            $sethome = velocitytheme_option('text_breadcrumb_home', 'home');
            echo '<a href="' . get_home_url() . '">';
            echo ($sethome == 'home') ? 'Home' : bloginfo('name');
            echo '</a>';

            // Check if the current page is a category, an archive or a single page
            if (is_category() || is_single()) {
                if (get_the_category() && isset(get_the_category()[0])) {
                    echo $sep;
                    echo '<a href="' . get_term_link(get_the_category()[0]->term_id) . '">' . get_the_category()[0]->name . '</a>';
                }
            } elseif (is_archive() || is_single()) {
                if (is_day()) {
                    echo $sep;
                    printf(__('%s', 'justg'), get_the_date());
                } elseif (is_month()) {
                    echo $sep;
                    printf(__('%s', 'justg'), get_the_date(_x('F Y', 'monthly archives date format', 'justg')));
                } elseif (is_year()) {
                    echo $sep;
                    printf(__('%s', 'justg'), get_the_date(_x('Y', 'yearly archives date format', 'justg')));
                } elseif (is_tax()) {
                    echo $sep;
                    echo single_term_title('', false);
                } else {
                    echo $sep;
                    echo post_type_archive_title('', false);
                }
            }


            // Singgle post and separator
            if (is_single()) {
                echo $sep;
                the_title();
            }

            // Static page title.
            if (is_page()) {
                echo $sep;
                the_title();
            }

            // Show search query
            if (is_search()) {
                echo $sep;
                the_search_query();
            }

            // if you have a static page assigned to be you posts list page
            if (is_home()) {
                global $post;
                $page_for_posts_id = get_option('page_for_posts');
                if ($page_for_posts_id) {
                    $post = get_page($page_for_posts_id);
                    setup_postdata($post);
                    the_title();
                    rewind_posts();
                }
            }

            // if 404
            if (is_404()) {
                echo $sep;
                echo esc_html_e('Not Found', 'justg');
            }

            echo '</div>';
            echo '</div>';

            if ($breadcrumb_position == 'justg_top_content') {
                echo '</div>';
            }

            echo '</div>';
        }
    }
}

if (!function_exists('justg_left_sidebar_check')) {
    /**
     * Left sidebar check
     * 
     */
    function justg_left_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position', 'default');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position', 'default');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position', 'default');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');
        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }


        if ('left' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar')) {
                return;
            }
        ?>
            <div class="widget-area left-sidebar pr-md-3 pl-md-0 col-sm-12 order-md-1 order-3" id="left-sidebar" role="complementary">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
        <?php
        }
    }
}

if (!function_exists('justg_right_sidebar_check')) {
    /**
     * Right sidebar check
     * 
     */
    function justg_right_sidebar_check()
    {
        $sidebar_pos            = velocitytheme_option('justg_sidebar_position', 'right');
        $pages_sidebar_pos      = velocitytheme_option('justg_pages_sidebar_position');
        $singular_sidebar_pos   = velocitytheme_option('justg_blogs_sidebar_position');
        $archives_sidebar_pos   = velocitytheme_option('justg_archives_sidebar_position');
        $shop_sidebar_pos       = velocitytheme_option('justg_shop_sidebar_position', 'default');

        if ($sidebar_pos === 'disable') {
            return;
        }

        if (is_page() && !in_array($pages_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $pages_sidebar_pos;
        }

        if (is_singular() && !in_array($singular_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $singular_sidebar_pos;
        }

        if (is_archive() && !in_array($archives_sidebar_pos, array('', 'default'))) {
            $sidebar_pos = $archives_sidebar_pos;
        }

        if (is_singular('fl-builder-template')) {
            return;
        }

        if ('right' === $sidebar_pos) {
            if (!is_active_sidebar('main-sidebar') && !has_action('justg_before_main_sidebar') && !has_action('justg_after_main_sidebar')) {
                return;
            }

        ?>
            <div class="widget-area right-sidebar pl-md-3 pr-md-0 col-sm-4 order-3" id="right-sidebar" role="complementary">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('justg_the_footer_open')) {
    /**
     * Footer open function
     * 
     */
    function justg_the_footer_open()
    {
        $footer_container = velocitytheme_option('option_footer_container', 'full');
        $footer1 = [
            'fixed'     => 'container mx-auto p-3 block-footer text-white',
            'full'      => 'py-3 block-footer text-white',
            'stretch'   => 'p-3 block-footer text-white',
        ];
        $footer2 = [
            'fixed'     => '',
            'full'      => 'container mx-auto px-md-0',
            'stretch'   => '',
        ];

        echo '<div class="bg-footer footer', $footer_container . '" id="wrapper-footer">';
        echo '<div class="' . $footer1[$footer_container] . '">';
        echo '<footer class="site-footer ' . $footer2[$footer_container] . '" id="colophon">';
    }
}

if (!function_exists('justg_the_footer_content')) {
    /**
     * Footer content function
     * 
     */
    function justg_the_footer_content()
    {

        $footer_widget = velocitytheme_option('footer_widget_setting', '0');
        if ($footer_widget != '0') {
            echo '<div class="row">';

            for ($x = 1; $x <= $footer_widget; $x++) {

                echo '<div class="col-md col-12 footer-widget-1" >';

                if (is_active_sidebar('footer-widget-' . $x)) {
                    dynamic_sidebar('footer-widget-' . $x);
                } elseif (current_user_can('edit_theme_options')) {
            ?>
                    <aside class="mb-3 widget">
                        <p class='no-widget-text'>
                            <a href='<?php echo esc_url(admin_url('widgets.php')); ?>'>
                                <?php esc_html_e('Click here to edit widget.', 'justg'); ?>
                            </a>
                        </p>
                    </aside>
        <?php
                }

                echo '</div>';
            }

            echo '</div>';
        }
        ?>

        <div class="site-info">
            <div class="text-center">© <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.</div>
        </div><!-- .site-info -->
    <?php
    }
}

if (!function_exists('justg_the_footer_close')) {
    /**
     * Footer Close function
     * 
     */
    function justg_the_footer_close()
    {
    ?>
        </footer><!-- #colophon -->
        </div><!-- container end -->
        </div><!-- wrapper end -->
        <?php
    }
}

if (!function_exists('justg_share')) {
    function justg_share()
    {
        global $post;
        $post_id    = $post->ID;
        $sb_url     = urlencode(get_permalink($post_id));
        $sb_title   = str_replace(' ', '%20', get_the_title($post_id));
        $datasosmed = [
            'facebook' => [
                'link'  => 'https://www.facebook.com/sharer/sharer.php?u=' . $sb_url,
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/> </svg>',
                'color' => '#2d59a1',
            ],
            'twitter' => [
                'link'  => 'https://twitter.com/intent/tweet?text=' . $sb_title . '&amp;url=' . $sb_url,
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16"> <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/> </svg>',
                'color' => '#079be3',
            ],
            'whatsapp' => [
                'link'  => 'https://api.whatsapp.com/send?text=' . $sb_title . ' ' . $sb_url,
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/> </svg>',
                'color' => '#27B932',
            ],
            'telegram' => [
                'link'  => 'https://telegram.me/share/url?url=' . $sb_url . '',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16"> <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/> </svg>',
                'color' => '#31A8DC',
            ],
            'linkedin' => [
                'link'  => 'https://www.linkedin.com/shareArticle?mini=true&url=' . $sb_url . '&amp;title=' . $sb_title,
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"> <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/> </svg>',
                'color' => '#09608b',
            ],
            'pinterest' => [
                'link'  => 'https://pinterest.com/pin/create/button/?url=' . $sb_url . '&amp;description=' . $sb_title,
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16"> <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0z"/> </svg>',
                'color' => '#DD2C26',
            ],
            'email' => [
                'link'  => 'mailto:?subject=I wanted you to see this site&amp;body=' . $sb_title . ' ' . $sb_url . ' ',
                'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16"> <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/> </svg>',
            ],
        ];

        foreach ($datasosmed as $key => $data) {
            $style = isset($data['color']) ? 'style="--bs-btn-bg:' . $data['color'] . '" href="' . $data['link'] . '"' : '';
            echo '<a class="btn btn-secondary btn-sm me-1 mb-1 s-' . $key . ' border-0 postshare-button" ' . $style . ' target="_blank" rel="nofollow">' . $data['icon'] . '</a>';
        }
    }
}

/// shortcode bws_google_captcha for wpcf7
if (class_exists('WPCF7') && !function_exists('justg_add_form_tag_bws_google_captcha')) {
    add_action('wpcf7_init', 'justg_add_form_tag_bws_google_captcha');
    function justg_add_form_tag_bws_google_captcha()
    {
        wpcf7_add_form_tag('bws_google_captcha', 'justg_bws_google_captcha_tag_handler');
    }
    function justg_bws_google_captcha_tag_handler($tag)
    {
        return do_shortcode('[bws_google_captcha]');
    }
}


if (!function_exists('justg_the_button_floating')) {
    /**
     * Footer Floating function
     * 
     */
    function justg_the_button_floating()
    {
        $whatsapp_position  = velocitytheme_option('whatsapp_position', 'right');
        $scroll_position    = velocitytheme_option('scroll_to_top_position', 'right');

        echo '<div class="floating-footer float-wa-' . $whatsapp_position . ' float-scrolltop-' . $scroll_position . '">';
        do_action('justg_button_floating');
        echo '</div>';
    }
}


add_action('justg_button_floating', 'justg_footer_whatsapp');
if (!function_exists('justg_footer_whatsapp')) {
    /**
     * wp footer whatsapp floating
     */
    function justg_footer_whatsapp()
    {
        $whatsapp_number        = velocitytheme_option('whatsapp_number', '');
        $whatsapp_text          = velocitytheme_option('whatsapp_text', 'Butuh Bantuan?');
        $whatsapp_message       = velocitytheme_option('whatsapp_message', 'Halo..');
        $whatsapp_enable        = velocitytheme_option('whatsapp_enable', false);
        $whatsapp_position      = velocitytheme_option('whatsapp_position', 'right');
        $scroll_to_top_enable   = velocitytheme_option('scroll_to_top_enable', true);
        $scroll_to_top_position = velocitytheme_option('scroll_to_top_position', 'right');
        $scroll_to_top_enable   = $scroll_to_top_enable ? 'scroll-active scroll-' . $scroll_to_top_position : '';
        // replace all except numbers
        $whatsapp_number        = $whatsapp_number ? preg_replace('/[^0-9]/', '', $whatsapp_number) : $whatsapp_number;
        // replace 0 with 62 if first digit is 0
        if (substr($whatsapp_number, 0, 1) == 0) {
            $whatsapp_number    = substr_replace($whatsapp_number, '62', 0, 1);
        }
        if ($whatsapp_enable) {
        ?>
            <div class="whatsapp-floating floating-button <?php echo $whatsapp_position . ' ' . $scroll_to_top_enable; ?> ">
                <a href="https://wa.me/<?php echo $whatsapp_number; ?>?text=<?php echo $whatsapp_message; ?>" class="text-white" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                    <?php if ($whatsapp_text) : ?>
                        <span class="d-none d-md-inline-block"><?php echo $whatsapp_text; ?></span>
                    <?php endif; ?>
                </a>
            </div>
        <?php
        }
    }
}

add_action('justg_button_floating', 'justg_footer_scroll_to_top');
if (!function_exists('justg_footer_scroll_to_top')) {
    /**
     * wp footer scroll to top
     */
    function justg_footer_scroll_to_top()
    {
        $scroll_to_top_enable   = velocitytheme_option('scroll_to_top_enable', true);
        $scroll_to_top_position = velocitytheme_option('scroll_to_top_position', 'right');
        if ($scroll_to_top_enable) {
        ?>
            <div class="scroll-to-top floating-button <?php echo $scroll_to_top_position; ?>" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
                </svg>
            </div>
<?php
        }
    }
}

if (!function_exists('justg_counter_viewer_single')) {
    add_action('wp_head', 'justg_counter_viewer_single');
    function justg_counter_viewer_single()
    {
        if (is_singular('post') && !current_user_can('administrator')) {
            global $post;
            $postID     = $post->ID;
            $countKey   = 'hit';
            if (class_exists('WP_Statistics')) {
                global $wpdb;
                $table_name = $wpdb->prefix . "statistics_pages";
                $results    = $wpdb->get_results("SELECT sum(count) as result_value FROM $table_name WHERE id = $post->ID");
                $count      = $results ? $results[0]->result_value : '0';
                update_post_meta($postID, $countKey, $count);
            } else {
                $count      = get_post_meta($postID, $countKey, true);
                if ($count == '') {
                    $count = 0;
                    delete_post_meta($postID, $countKey);
                    add_post_meta($postID, $countKey, '1');
                } else {
                    $count++;
                    update_post_meta($postID, $countKey, $count);
                }
            }
        }
    }
}

if (!class_exists('WP_Statistics')) {
    /**
     * Custom columns HIT post.
     */
    add_filter('manage_post_posts_columns', 'set_vdhit_posts_columns');
    function set_vdhit_posts_columns($columns)
    {
        $columns['hit']     = __('Hits', 'justg');
        return $columns;
    }
    add_action('manage_post_posts_custom_column', 'set_vdhit_post_column', 10, 2);
    function set_vdhit_post_column($column, $post_id)
    {
        switch ($column) {
            case 'hit':
                echo get_post_meta($post_id, 'hit', true);
                break;
        }
    }
}
