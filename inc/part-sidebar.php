<?php
$post1_cat  = velocity_berita5_kategori('posts_sidebar_1');
$post2_cat  = velocity_berita5_kategori('posts_sidebar_2');
$post2_sort = get_theme_mod('sortby_posts_sidebar_2', 'date');

/** Satu baris berita di tab sidebar. */
$tab_item = function ($kiri) {
    echo '<div class="tabpopular-post-item bg-light border p-2 mb-1">';
    echo '<div class="row g-2">';
    echo '<div class="col-3">' . $kiri . '</div>';
    echo '<div class="col">';
    echo '<a class="fw-bold" href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a>';
    echo '<div class="text-muted"><small>' . esc_html(get_the_date()) . '</small></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
};
?>
<aside id="sidebar-post-tabs" class="widget widget_berita_tabs">
    <ul class="nav nav-tabs p-0" id="beritaTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 bg-light active" id="popular-tab" data-bs-toggle="tab" data-bs-target="#berita-tab-popular" type="button" role="tab" aria-controls="berita-tab-popular" aria-selected="true">
                <?php esc_html_e('POPULER', 'justg'); ?>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 bg-light" id="comments-tab" data-bs-toggle="tab" data-bs-target="#berita-tab-comments" type="button" role="tab" aria-controls="berita-tab-comments" aria-selected="false">
                <?php esc_html_e('KOMENTAR', 'justg'); ?>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 bg-light" id="tags-tab" data-bs-toggle="tab" data-bs-target="#berita-tab-tags" type="button" role="tab" aria-controls="berita-tab-tags" aria-selected="false">
                <?php esc_html_e('TAG', 'justg'); ?>
            </button>
        </li>
    </ul>
    <div class="tab-content p-2" id="beritaTabsContent">
        <div class="tab-pane fade show active" id="berita-tab-popular" role="tabpanel" aria-labelledby="popular-tab" tabindex="0">
            <?php
            $popular_query = new WP_Query(array(
                'post_type'           => 'post',
                'posts_per_page'      => 4,
                'meta_key'            => 'hit',
                'orderby'             => 'meta_value_num',
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ));
            if ($popular_query->have_posts()) {
                echo '<div class="tabpopular-post-part">';
                while ($popular_query->have_posts()) {
                    $popular_query->the_post();
                    $gambar = has_post_thumbnail()
                        ? '<div class="ratio ratio-1x1 border border-3"><img src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async"></div>'
                        : '';
                    $tab_item($gambar);
                }
                echo '</div>';
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="tab-pane fade" id="berita-tab-comments" role="tabpanel" aria-labelledby="comments-tab" tabindex="0">
            <?php
            $postcomment_query = new WP_Query(array(
                'post_type'           => 'post',
                'posts_per_page'      => 4,
                'orderby'             => 'comment_count',
                'order'               => 'DESC',
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ));
            if ($postcomment_query->have_posts()) {
                echo '<div class="tabpopular-post-part">';
                while ($postcomment_query->have_posts()) {
                    $postcomment_query->the_post();
                    $tab_item('<div class="fst-italic text-muted text-center"><div class="fw-bold">' . esc_html(number_format_i18n(get_comments_number())) . '</div><small>' . esc_html__('Komentar', 'justg') . '</small></div>');
                }
                echo '</div>';
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="tab-pane fade" id="berita-tab-tags" role="tabpanel" aria-labelledby="tags-tab" tabindex="0">
            <?php
            $tags = get_tags(array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'number'  => 12,
            ));
            echo '<div class="tabpost_tags">';
            foreach ((array) $tags as $tag) {
                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="btn btn-sm btn-dark me-1 mb-1 bg-color-theme border-0 rounded-0">' . esc_html($tag->name) . '</a>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
</aside>

<aside id="iklan-sidebar" class="widget widget_berita_iklan">
    <?php get_berita_iklan('iklan_sidebar'); ?>
</aside>

<?php if ($post1_cat !== 'disable') : ?>
    <aside id="sidebar-post-berita1" class="widget widget_berita_posts part_posts_sidebar_1">
        <h3 class="widget-title">
            <span><?php echo esc_html(velocity_berita5_judul('posts_sidebar_1')); ?></span>
        </h3>
        <div class="px-2">
            <?php
            module_vdposts(array(
                'post_type'      => 'post',
                'cat'            => $post1_cat,
                'posts_per_page' => 5,
            ), 'posts4');
            ?>
        </div>
    </aside>
<?php endif; ?>

<aside id="iklan-sidebar2" class="widget widget_berita_iklan">
    <?php get_berita_iklan('iklan_sidebar_2'); ?>
</aside>

<?php if ($post2_cat !== 'disable') : ?>
    <aside id="sidebar-post-berita2" class="widget widget_berita_posts part_posts_sidebar_2">
        <h3 class="widget-title">
            <span><?php echo esc_html(velocity_berita5_judul('posts_sidebar_2')); ?></span>
        </h3>
        <div class="px-2">
            <?php
            module_vdposts(array(
                'post_type'      => 'post',
                'cat'            => $post2_cat,
                'posts_per_page' => 5,
                'sortby'         => $post2_sort,
            ), 'posts3');
            ?>
        </div>
    </aside>
<?php endif; ?>
