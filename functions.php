<?php

/**
 * Child theme functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Text Domain: justg
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

/**
 * Load other required files
 *
 */

$inc = get_stylesheet_directory() . '/inc';
$includes = [
	'enqueue.php',
	'customizer.php',
	'function-child.php',
	'function-vdposts.php',
	'shortcodes.php'
];

foreach ($includes as $include) {
	require_once($inc . '/' . $include);
}

// Kolom Kanan (part-sidebar.php, dari Customizer) tetap tampil walau widget Main Sidebar kosong: induk velocity
// 2.7.5 hanya merender sidebar bila main-sidebar aktif (tribunnewsupdate.com 2026-10-20).
add_filter('is_active_sidebar', function ($aktif, $index) {
	return $index === 'main-sidebar' ? true : $aktif;
}, 10, 2);

//action add before main widget
add_action('justg_before_main_sidebar', 'sidebar_kanan_konten');
function sidebar_kanan_konten()
{
	require_once(get_stylesheet_directory() . '/inc/part-sidebar.php');
}
