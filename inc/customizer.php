<?php

/**
 * Pengaturan Berita 5 di Customizer bawaan WordPress (tanpa Kirki).
 *
 * Nama theme mod sama dengan versi Kirki (color_theme, image_iklan_*, link_iklan_*,
 * link_sosmed_*, title_posts_*, cat_posts_*, sortby_posts_sidebar_2) supaya nilai
 * yang sudah tersimpan tetap terbaca sesudah tema diperbarui.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/** Warna bawaan demo berita5.velocitydeveloper.com. */
define('VELOCITY_BERITA5_WARNA', '#39960b');
define('VELOCITY_BERITA5_WARNA_2', '#40731c');

/**
 * Slot iklan: id => [label, keterangan ukuran]. Ukuran di keterangan dibaca installer
 * untuk membuat banner "Ruang Iklan" seukuran slot.
 */
function velocity_berita5_slot_iklan()
{
    return array(
        'iklan_header_1'     => array('Iklan Header', 'Iklan Header 728x90'),
        'iklan_home_2'       => array('Iklan Home Kolom Kiri', 'Iklan Halaman Depan 300x250'),
        'iklan_home_bawah_1' => array('Iklan Home Bawah 1', 'Iklan Halaman Depan Bawah 600x80'),
        'iklan_home_bawah_2' => array('Iklan Home Bawah 2', 'Iklan Halaman Depan Bawah 600x80'),
        'iklan_content'      => array('Iklan Single', 'Iklan Single post 600x80'),
        'iklan_content_2'    => array('Iklan Single 2', 'Iklan Single post 300x250'),
        'iklan_sidebar'      => array('Iklan Sidebar', 'Iklan Sidebar Kanan 300x250'),
        'iklan_sidebar_2'    => array('Iklan Sidebar 2', 'Iklan Sidebar Kanan 300x250'),
        'iklan_archive'      => array('Iklan Archive', 'Iklan Arsip post 600x60'),
        'iklan_archive_2'    => array('Iklan Archive 2', 'Iklan Arsip post 600x60'),
    );
}

function velocity_berita5_sosmed()
{
    return array(
        'facebook'  => 'Facebook',
        'twitter'   => 'Twitter / X',
        'instagram' => 'Instagram',
        'youtube'   => 'YouTube',
    );
}

/**
 * Blok berita: id => [label, seksi, boleh dinonaktifkan].
 * Blok yang bisa dinonaktifkan memakai pilihan "Nonaktifkan" (nilai 'disable', sama dengan versi Kirki).
 */
function velocity_berita5_blok()
{
    return array(
        'carousel_home'       => array('Carousel Home', 'section_homeberita', true),
        'posts_home_1'        => array('Home Headline', 'section_homeberita', false),
        'posts_home_3'        => array('Posts Home Kiri Atas', 'section_homeberita', false),
        'posts_home_4'        => array('Posts Home Main', 'section_homeberita', false),
        'posts_home_5'        => array('Posts Home Kiri Bawah', 'section_homeberita', false),
        'posts_home_footer_1' => array('Posts Home Footer 1', 'section_homeberita', false),
        'posts_home_footer_2' => array('Posts Home Footer 2', 'section_homeberita', false),
        'posts_home_footer_3' => array('Posts Home Footer 3', 'section_homeberita', false),
        'posts_sidebar_1'     => array('Posts 1', 'section_sidebarberita', true),
        'posts_sidebar_2'     => array('Posts 2', 'section_sidebarberita', true),
    );
}

function velocity_berita5_sanitize_kategori($value, $setting)
{
    $value = (string) $value;
    if ($value === '' || $value === 'disable') {
        $control = $setting->manager->get_control($setting->id);
        return ($value === '' || ($control && isset($control->choices['disable']))) ? $value : '';
    }
    return term_exists((int) $value, 'category') ? (string) absint($value) : '';
}

function velocity_berita5_sanitize_urutan($value)
{
    return in_array($value, array('date', 'view'), true) ? $value : 'date';
}

add_action('customize_register', 'velocity_berita5_customize_register', 20);
function velocity_berita5_customize_register(WP_Customize_Manager $wp_customize)
{
    $wp_customize->add_panel('panel_berita', array(
        'priority' => 10,
        'title'    => esc_html__('Berita', 'justg'),
    ));

    // Warna.
    $wp_customize->add_section('section_colorberita', array(
        'panel'       => 'panel_berita',
        'title'       => esc_html__('Warna', 'justg'),
        'description' => esc_html__('Kosongkan untuk memakai warna utama tema (Primary Color) atau warna bawaan demo.', 'justg'),
        'priority'    => 10,
    ));
    $warna = array(
        'color_theme'        => esc_html__('Warna Tema', 'justg'),
        'color_theme_second' => esc_html__('Warna Tema Kedua (menu bawah)', 'justg'),
    );
    foreach ($warna as $id => $label) {
        $wp_customize->add_setting($id, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
        ));
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, array(
            'label'   => $label,
            'section' => 'section_colorberita',
        )));
    }

    // Iklan.
    $wp_customize->add_section('section_iklanberita', array(
        'panel'       => 'panel_berita',
        'title'       => esc_html__('Iklan', 'justg'),
        'description' => esc_html__('Slot tanpa gambar tidak ditampilkan.', 'justg'),
        'priority'    => 20,
    ));
    foreach (velocity_berita5_slot_iklan() as $id => $slot) {
        $wp_customize->add_setting('image_' . $id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'image_' . $id, array(
            'label'       => sprintf(esc_html__('Gambar %s', 'justg'), $slot[0]),
            'description' => $slot[1],
            'section'     => 'section_iklanberita',
        )));
        $wp_customize->add_setting('link_' . $id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('link_' . $id, array(
            'type'    => 'url',
            'label'   => sprintf(esc_html__('Link %s', 'justg'), $slot[0]),
            'section' => 'section_iklanberita',
        ));
    }

    // Sosial media.
    $wp_customize->add_section('section_sosmedberita', array(
        'panel'       => 'panel_berita',
        'title'       => esc_html__('Sosial Media', 'justg'),
        'description' => esc_html__('Kosongkan link untuk menyembunyikan ikonnya.', 'justg'),
        'priority'    => 30,
    ));
    foreach (velocity_berita5_sosmed() as $id => $label) {
        $wp_customize->add_setting('link_sosmed_' . $id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('link_sosmed_' . $id, array(
            'type'    => 'url',
            'label'   => sprintf(esc_html__('Link %s', 'justg'), $label),
            'section' => 'section_sosmedberita',
        ));
    }

    // Blok berita beranda & kolom kanan.
    $wp_customize->add_section('section_homeberita', array(
        'panel'       => 'panel_berita',
        'title'       => esc_html__('Home', 'justg'),
        'description' => esc_html__('Judul kosong = nama kategori yang dipilih.', 'justg'),
        'priority'    => 40,
    ));
    $wp_customize->add_section('section_sidebarberita', array(
        'panel'    => 'panel_berita',
        'title'    => esc_html__('Kolom Kanan', 'justg'),
        'priority' => 50,
    ));

    $kategori = array('' => esc_html__('Semua Kategori (terbaru)', 'justg'));
    foreach (get_categories(array('hide_empty' => false)) as $term) {
        $kategori[(string) $term->term_id] = $term->name;
    }

    foreach (velocity_berita5_blok() as $id => $blok) {
        list($label, $section, $bisa_mati) = $blok;
        if ($id !== 'carousel_home') {
            $wp_customize->add_setting('title_' . $id, array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('title_' . $id, array(
                'type'    => 'text',
                'label'   => sprintf(esc_html__('Judul %s', 'justg'), $label),
                'section' => $section,
            ));
        }
        $wp_customize->add_setting('cat_' . $id, array(
            'default'           => '',
            'sanitize_callback' => 'velocity_berita5_sanitize_kategori',
        ));
        $wp_customize->add_control('cat_' . $id, array(
            'type'    => 'select',
            'label'   => sprintf(esc_html__('Kategori %s', 'justg'), $label),
            'section' => $section,
            'choices' => $bisa_mati ? $kategori + array('disable' => esc_html__('Nonaktifkan', 'justg')) : $kategori,
        ));
    }

    $wp_customize->add_setting('sortby_posts_sidebar_2', array(
        'default'           => 'date',
        'sanitize_callback' => 'velocity_berita5_sanitize_urutan',
    ));
    $wp_customize->add_control('sortby_posts_sidebar_2', array(
        'type'    => 'select',
        'label'   => esc_html__('Urutkan Posts 2 berdasarkan', 'justg'),
        'section' => 'section_sidebarberita',
        'choices' => array(
            'date' => esc_html__('Tanggal', 'justg'),
            'view' => esc_html__('Tayangan', 'justg'),
        ),
    ));
}

/**
 * Warna tema: pilihan Customizer Berita, lalu Primary Color induk (diisi installer dari
 * warna klien), lalu warna demo.
 */
function velocity_berita5_warna()
{
    $warna = sanitize_hex_color((string) get_theme_mod('color_theme', ''));
    if (!$warna) {
        $utama = sanitize_hex_color((string) get_theme_mod('primary_color', ''));
        $warna = ($utama && strtolower($utama) !== '#1e73be') ? $utama : VELOCITY_BERITA5_WARNA;
    }
    return $warna;
}

function velocity_berita5_warna_kedua()
{
    $warna = sanitize_hex_color((string) get_theme_mod('color_theme_second', ''));
    if ($warna) {
        return $warna;
    }
    $utama = velocity_berita5_warna();
    if (strtolower($utama) === VELOCITY_BERITA5_WARNA) {
        return VELOCITY_BERITA5_WARNA_2;
    }
    // Warna tema digelapkan 25%.
    $rgb = array_map('hexdec', str_split(ltrim($utama, '#'), 2));
    return vsprintf('#%02x%02x%02x', array_map(function ($c) {
        return (int) round($c * 0.75);
    }, $rgb));
}

add_action('wp_head', 'velocity_berita5_css_warna', 100);
function velocity_berita5_css_warna()
{
    printf(
        '<style id="velocity-berita5-warna">:root{--color-theme:%1$s;--color-theme-second:%2$s;}.border-color-theme{--bs-border-color:%1$s;}</style>' . "\n",
        esc_attr(velocity_berita5_warna()),
        esc_attr(velocity_berita5_warna_kedua())
    );
}

/** URL gambar iklan; Kirki lama bisa menyimpan id lampiran. */
function velocity_berita5_url_gambar($nilai)
{
    if (is_numeric($nilai)) {
        return (string) wp_get_attachment_url((int) $nilai);
    }
    if (is_array($nilai)) {
        $nilai = isset($nilai['url']) ? $nilai['url'] : (isset($nilai['id']) ? wp_get_attachment_url((int) $nilai['id']) : '');
    }
    return (string) $nilai;
}

/**
 * Judul blok: isian Customizer, lalu nama kategori, lalu "Berita Terbaru".
 * "Recent Posts" adalah bawaan versi Kirki, jadi diperlakukan sebagai kosong.
 */
function velocity_berita5_judul($id)
{
    $judul = trim((string) get_theme_mod('title_' . $id, ''));
    if ($judul !== '' && $judul !== 'Recent Posts') {
        return $judul;
    }
    $cat = get_theme_mod('cat_' . $id, '');
    $term = ($cat && $cat !== 'disable') ? get_term((int) $cat, 'category') : null;
    return ($term && !is_wp_error($term)) ? $term->name : __('Berita Terbaru', 'justg');
}

/** Id kategori blok untuk WP_Query ('' = semua, 'disable' = blok disembunyikan). */
function velocity_berita5_kategori($id)
{
    $cat = (string) get_theme_mod('cat_' . $id, '');
    return ($cat === 'disable') ? 'disable' : ($cat === '' ? '' : (string) absint($cat));
}

/** Kepala blok: judul + tombol ke arsip kategori (bila kategori dipilih). */
function velocity_berita5_kepala_blok($id, $kelas = '', $kelas_judul = '')
{
    $cat = velocity_berita5_kategori($id);
    echo '<h3 class="widget-title d-flex align-items-center justify-content-between ' . esc_attr($kelas) . '">';
    echo '<span class="' . esc_attr($kelas_judul) . '">' . esc_html(velocity_berita5_judul($id)) . '</span>';
    if ($cat !== '' && $cat !== 'disable') {
        echo '<a class="btn btn-warning btn-sm py-0 px-1 me-1" href="' . esc_url(get_category_link((int) $cat)) . '" aria-label="' . esc_attr(sprintf(__('Lihat semua %s', 'justg'), velocity_berita5_judul($id))) . '">';
        echo '<i class="fa fa-angle-right" aria-hidden="true"></i>';
        echo '</a>';
    }
    echo '</h3>';
}
