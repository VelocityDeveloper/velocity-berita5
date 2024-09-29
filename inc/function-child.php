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


    if (class_exists('Kirki')) :

        Kirki::add_panel('panel_berita', [
            'priority'    => 10,
            'title'       => esc_html__('Berita', 'justg'),
            'description' => esc_html__('', 'justg'),
        ]);

        ///Section Color
        Kirki::add_section('section_colorberita', [
            'panel'    => 'panel_berita',
            'title'    => __('Warna', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'color',
            'settings'    => 'color_theme',
            'label'       => __('Color Theme', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'section_colorberita',
            'default'     => 'green',
            'transport'   => 'auto',
            'output'      => [
                [
                    'element'   => ':root',
                    'property'  => '--color-theme',
                ],
                [
                    'element'   => '.border-color-theme',
                    'property'  => '--bs-border-color',
                ]
            ],
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'color',
            'settings'    => 'color_theme_second',
            'label'       => __('Color Theme Secondary', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'section_colorberita',
            'default'     => 'green',
            'transport'   => 'auto',
            'output'      => [
                [
                    'element'   => ':root',
                    'property'  => '--color-theme-second',
                ]
            ],
        ]);

        ///Section Iklan
        Kirki::add_section('section_iklanberita', [
            'panel'    => 'panel_berita',
            'title'    => __('Iklan', 'justg'),
            'priority' => 10,
        ]);
        $fieldiklan = [
            'iklan_header_1'  => [
                'label'            => 'Iklan Header',
                'description'    => 'Iklan Header 310x350',
            ],
            'iklan_home_2'  => [
                'label'            => 'Iklan Home  Sidebar Kiri',
                'description'    => 'Iklan Halaman Depan 300x250',
            ],
            'iklan_home_bawah_1'  => [
                'label'            => 'Iklan Home Bawah 1',
                'description'    => 'Iklan Halaman Depan Bawah 600x80',
            ],
            'iklan_home_bawah_2'  => [
                'label'            => 'Iklan Home Bawah 2',
                'description'    => 'Iklan Halaman Depan Bawah 600x80',
            ],
            'iklan_content'  => [
                'label'            => 'Iklan Single',
                'description'    => 'Iklan Single post 600x80 ',
            ],
            'iklan_content_2'  => [
                'label'            => 'Iklan Single 2',
                'description'    => 'Iklan Single post 300x250 ',
            ],
            'iklan_sidebar'  => [
                'label'            => 'Iklan Sidebar',
                'description'    => 'Iklan Sidebar Kanan 300x250 ',
            ],
            'iklan_sidebar_2'  => [
                'label'            => 'Iklan Sidebar 2',
                'description'    => 'Iklan Sidebar Kanan 300x250 ',
            ],
            'iklan_archive'  => [
                'label'            => 'Iklan Archive',
                'description'    => 'Iklan Arsip post 600x60',
            ],
            'iklan_archive_2'  => [
                'label'            => 'Iklan Archive 2',
                'description'    => 'Iklan Arsip post 600x60',
            ]
        ];
        foreach ($fieldiklan as $idfield => $datafield) {
            Kirki::add_field('justg_config', [
                'type'        => 'image',
                'settings'    => 'image_' . $idfield,
                'label'       => esc_html__('Gambar ' . $datafield['label'], 'kirki'),
                'description' => esc_html__($datafield['description'], 'kirki'),
                'section'     => 'section_iklanberita',
                'default'     => '',
                'partial_refresh'    => [
                    'partial_' . $idfield => [
                        'selector'        => '.part_' . $idfield,
                        'render_callback' => '__return_false'
                    ]
                ],
            ]);
            Kirki::add_field('justg_config', [
                'type'     => 'link',
                'settings' => 'link_' . $idfield,
                'label'    => __('Link ' . $datafield['label'], 'kirki'),
                'section'  => 'section_iklanberita',
                'default'  => '',
                'priority' => 10,
            ]);
        }

        ///Section Sosmed
        Kirki::add_section('section_sosmedberita', [
            'panel'    => 'panel_berita',
            'title'    => __('Sosial Media', 'justg'),
            'priority' => 10,
        ]);
        $fieldsosmed = [
            'facebook'  => [
                'label'    => 'Facebook',
            ],
            'twitter'  => [
                'label'    => 'Twitter',
            ],
            'instagram'  => [
                'label'    => 'Instagram',
            ],
            'youtube'  => [
                'label'    => 'Youtube',
            ]
        ];
        foreach ($fieldsosmed as $idfield => $datafield) {
            Kirki::add_field('justg_config', [
                'type'     => 'link',
                'settings' => 'link_sosmed_' . $idfield,
                'label'    => __('Link ' . $datafield['label'], 'kirki'),
                'section'  => 'section_sosmedberita',
                'default'  => 'https://' . $idfield . '.com/',
                'priority' => 10,
            ]);
        }

        ///Section Home
        Kirki::add_section('section_homeberita', [
            'panel'    => 'panel_berita',
            'title'    => __('Home', 'justg'),
            'priority' => 10,
        ]);

        ///Section Kolom Kanan
        Kirki::add_section('section_sidebarberita', [
            'panel'    => 'panel_berita',
            'title'    => __('Kolom Kanan', 'justg'),
            'priority' => 10,
        ]);

        ///field set posts
        $fieldposts = [
            'carousel_home'  => [
                'label'        => 'Carousel Home',
                'section'    => 'section_homeberita',
            ],
            'posts_home_1'  => [
                'label'        => 'Home Headline',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_3'  => [
                'label'        => 'Posts Home Kiri Atas',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_4'  => [
                'label'        => 'Posts Home Main',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_5'  => [
                'label'        => 'Posts Home Kiri Bawah',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_footer_1'  => [
                'label'        => 'Posts Home Footer 1',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_footer_2'  => [
                'label'        => 'Posts Home Footer 2',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_home_footer_3'  => [
                'label'        => 'Posts Home Footer 3',
                'section'    => 'section_homeberita',
                'title'        => 'Recent Posts',
            ],
            'posts_sidebar_1'  => [
                'label'        => 'Posts 1',
                'section'    => 'section_sidebarberita',
                'title'        => 'Recent Posts',
            ],
            'posts_sidebar_2'  => [
                'label'        => 'Posts 2',
                'section'    => 'section_sidebarberita',
                'title'        => 'Recent Posts',
                'sortby'    => true,
            ],
        ];
        $categories = Kirki_Helper::get_terms('category');
        $categories['disable'] = 'Nonaktifkan';
        unset($categories[1]);
        foreach ($fieldposts as $idfield => $datafield) {
            if (isset($datafield['title'])) {
                Kirki::add_field('justg_config', [
                    'type'     => 'text',
                    'settings' => 'title_' . $idfield,
                    'label'    => esc_html__('Judul ' . $datafield['label'], 'kirki'),
                    'section'  => $datafield['section'],
                    'default'  => esc_html__($datafield['title'], 'kirki'),
                    'priority' => 10,
                ]);
            }
            Kirki::add_field('justg_config', [
                'type'        => 'select',
                'settings'    => 'cat_' . $idfield,
                'label'       => esc_html__('Kategori ' . $datafield['label'], 'kirki'),
                'section'     => $datafield['section'],
                'default'     => '',
                'placeholder' => esc_html__('Pilih kategori', 'kirki'),
                'priority'    => 10,
                'multiple'    => 1,
                'choices'     => $categories,
                'partial_refresh'    => [
                    'partial_' . $idfield => [
                        'selector'        => '.part_' . $idfield,
                        'render_callback' => '__return_false'
                    ]
                ],
            ]);
            if (isset($datafield['sortby']) && $datafield['sortby'] == true) {
                Kirki::add_field('justg_config', [
                    'type'     => 'select',
                    'settings' => 'sortby_' . $idfield,
                    'label'    => esc_html__('Urutkan ' . $datafield['label'] . ' berdasarkan', 'kirki'),
                    'section'  => $datafield['section'],
                    'default'  => 'date',
                    'priority' => 10,
                    'multiple' => 1,
                    'choices'  => [
                        'date'    => esc_html__('Tanggal', 'kirki'),
                        'view'    => esc_html__('Tayangan', 'kirki'),
                    ],
                ]);
            }
        }

    endif;

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
    $iklan_content  = velocitytheme_option('image_' . $idiklan, '');
    echo '<div class="part_' . $idiklan . '">';
    if ($iklan_content) {
        $linkiklan = velocitytheme_option('link_' . $idiklan, '');
        echo '<div class="text-center">';
        echo $linkiklan ? '<a href="' . $linkiklan . '" target="_blank">' : '';
        echo '<img class="img-fluid" src="' . $iklan_content . '" loading="lazy">';
        echo $linkiklan ? '</a>' : '';
        echo '</div>';
    }
    echo '</div>';
}

function vdberita_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
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
                'after_widget'  => '</div></aside>',
                'before_title'  => '<h3 class="widget-title fw-bold"><span>',
                'after_title'   => '</span></h3><div class="mt-4 mb-2">',
                'show_in_rest'   => false,
            )
        );

        // Register footer widget area
        register_sidebar(
            array(
                'name'          => __('Footer Widget Area 1', 'justg'),
                'id'            => 'footer-widget-1',
                'description'   => __('', 'justg'),
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
                'description'   => __('', 'justg'),
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
                'description'   => __('', 'justg'),
                'before_widget' => '<aside id="%1$s" class="mb-3 widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title"><span>',
                'after_title'   => '</span></h3>',
            )
        );
    }
}
