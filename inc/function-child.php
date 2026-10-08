<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{
    // Pengaturan tema ada di inc/customizer.php (Customizer bawaan, tanpa Kirki).

    register_nav_menus(
        array(
            'secondary' => __('Secondary Menu', 'justg'),
        )
    );

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
}

///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_before_header', 'justg_top_header_berita');
function justg_top_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-top-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

function get_berita_iklan($idiklan)
{
    $gambar = velocity_berita5_url_gambar(get_theme_mod('image_' . $idiklan, ''));
    echo '<div class="part_' . esc_attr($idiklan) . '">';
    if ($gambar) {
        $link  = (string) get_theme_mod('link_' . $idiklan, '');
        $slot  = velocity_berita5_slot_iklan();
        $label = isset($slot[$idiklan]) ? $slot[$idiklan][0] : __('Iklan', 'justg');
        echo '<div class="berita-iklan text-center">';
        echo $link ? '<a href="' . esc_url($link) . '" target="_blank" rel="noopener sponsored">' : '';
        echo '<img class="img-fluid" src="' . esc_url($gambar) . '" alt="' . esc_attr($label) . '" loading="lazy" decoding="async">';
        echo $link ? '</a>' : '';
        echo '</div>';
    }
    echo '</div>';
}

function vdberita_limit_text($text, $limit)
{
    return wp_trim_words($text, $limit, '...');
}
if (!function_exists('justg_get_hit')) {
    function justg_get_hit($post_id = null)
    {
        if (empty($post_id)) {
            global $post;
            $post_id = $post->ID;
        }
        $hit = get_post_meta($post_id, 'hit', true);

        return $hit ? $hit : '0';
    }
}
//register widget
add_action('widgets_init', 'justg_widgets_init', 20);
if (!function_exists('justg_widgets_init')) {
    function justg_widgets_init()
    {
        register_sidebar(
            array(
                'name'          => __('Main Sidebar', 'justg'),
                'id'            => 'main-sidebar',
                'description'   => __('Main sidebar widget area', 'justg'),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title fw-bold"><span>',
                'after_title'   => '</span></h3>',
                'show_in_rest'   => false,
            )
        );

        // Register footer widget area
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 1', 'justg'),
                'id'            => 'footer-widget-1',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 2', 'justg'),
                'id'            => 'footer-widget-2',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 3', 'justg'),
                'id'            => 'footer-widget-3',
                'description'   => '',
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
    }
}

/** Bar info berita (penulis, tanggal, tag, komentar) di artikel & arsip. */
function velocity_berita5_info_post()
{
    echo '<div class="info-post d-flex mt-2 justify-content-between align-items-center py-1 px-2 border-bottom border-top text-muted bg-light mb-3">';
    echo '<div>';
    if (get_the_author()) {
        echo '<small class="me-2">' . esc_html__('Oleh', 'justg') . ': ' . esc_html(get_the_author()) . '</small>';
    }
    echo '<small>' . esc_html(get_the_date()) . '</small>';
    $tags = get_the_tags(get_the_ID());
    if ($tags) {
        $tautan = array();
        foreach (array_slice($tags, 0, 3) as $tag) {
            $tautan[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
        }
        echo '<small class="ms-2 d-none d-sm-inline">' . esc_html__('Tag', 'justg') . ': ' . implode(', ', $tautan) . '</small>';
    }
    echo '</div>';
    if (comments_open() || get_comments_number()) {
        $jumlah = (int) get_comments_number();
        echo '<div class="d-none d-md-inline-block">';
        echo '<a class="btn btn-sm btn-light border shadow-sm" style="--bs-btn-font-size: .65rem;" href="' . esc_url(get_the_permalink()) . '#respond">';
        echo $jumlah ? esc_html(sprintf(_n('%s komentar', '%s komentar', $jumlah, 'justg'), number_format_i18n($jumlah))) : esc_html__('Tanggapi', 'justg');
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}

/**
 * Tombol bagikan. justg_share() pindah dari tema induk ke Velocity Addons 2.x; situs dengan
 * Velocity Addons lama + induk baru tidak punya fungsinya (dulu fatal error di artikel).
 */
function velocity_berita5_share()
{
    if (function_exists('justg_share')) {
        return justg_share();
    }
    $url   = rawurlencode(get_permalink());
    $judul = rawurlencode(get_the_title());
    $tujuan = array(
        'facebook' => array('Facebook', '#2d59a1', 'https://www.facebook.com/sharer/sharer.php?u=' . $url),
        'twitter'  => array('Twitter', '#14171a', 'https://twitter.com/intent/tweet?text=' . $judul . '&url=' . $url),
        'whatsapp' => array('WhatsApp', '#25d366', 'https://wa.me/?text=' . $judul . '%20' . $url),
        'telegram' => array('Telegram', '#0088cc', 'https://t.me/share/url?url=' . $url . '&text=' . $judul),
        'envelope' => array('Email', '#444444', 'mailto:?subject=' . $judul . '&body=' . $url),
    );
    $html = '<div class="berita-share py-2"><small class="fw-bold d-block mb-1">' . esc_html__('Bagikan', 'justg') . '</small>';
    foreach ($tujuan as $ikon => $t) {
        $html .= '<a class="btn btn-sm text-white rounded-0 me-1 mb-1" style="background:' . esc_attr($t[1]) . '" href="' . esc_url($t[2]) . '" target="_blank" rel="noopener" aria-label="' . esc_attr($t[0]) . '"><i class="fa fa-' . esc_attr($ikon) . '" aria-hidden="true"></i></a>';
    }
    return $html . '</div>';
}
