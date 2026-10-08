<?php
/**
 * Gambar unggulan berita untuk kotak .ratio (object-fit: cover di css/custom.css).
 * Tanpa gambar unggulan: kotak abu polos (tetap bertautan ke berita).
 */
function vdposts_gambar($ukuran = 'thumbnail', $lazy_flickity = false)
{
    if (!has_post_thumbnail()) {
        echo '<a class="vdposts-noimg" href="' . esc_url(get_the_permalink()) . '" aria-label="' . esc_attr(get_the_title()) . '"></a>';
        return;
    }
    $src = get_the_post_thumbnail_url(get_the_ID(), $ukuran);
    echo '<a href="' . esc_url(get_the_permalink()) . '">';
    if ($lazy_flickity) {
        echo '<img data-flickity-lazyload="' . esc_url($src) . '" alt="' . esc_attr(get_the_title()) . '">';
    } else {
        echo '<img src="' . esc_url($src) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async">';
    }
    echo '</a>';
}

function vdposts_meta($views = true)
{
    echo '<small>' . esc_html(get_the_date());
    if ($views) {
        echo ' / ' . esc_html(number_format_i18n((int) justg_get_hit())) . ' ' . esc_html__('dilihat', 'justg');
    }
    echo '</small>';
}

function vdposts_ringkas($kata)
{
    return esc_html(vdberita_limit_text(wp_strip_all_tags(strip_shortcodes(get_the_content())), $kata));
}

function module_vdposts($args = null, $style = null)
{
    if (isset($args['sortby'])) {
        if ($args['sortby'] == 'view') {
            $args['orderby']    = 'meta_value_num';
            $args['meta_key']   = 'hit';
        }
        unset($args['sortby']);
    }
    $args['ignore_sticky_posts'] = true;

    // The Query
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) {
        echo '<div class="module-vdposts module-vdposts-' . esc_attr($style) . '">';
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $link  = esc_url(get_the_permalink());
            $judul = esc_attr(get_the_title());

            switch ($style) {
                case 'posts1':
?>
                    <div class="posts-item pb-1 mb-2">
                        <div class="ratio ratio-16x9 bg-light border border-4 mb-2">
                            <?php vdposts_gambar('medium'); ?>
                        </div>
                        <div class="post-text">
                            <a class="fw-bold mb-2 d-block h6" href="<?php echo $link; ?>">
                                <?php the_title(); ?>
                            </a>
                            <div class="post-excerpt mb-2 text-muted">
                                <small><?php echo vdposts_ringkas(25); ?></small>
                            </div>
                            <div class="py-1 px-2 border-bottom border-top text-muted bg-light">
                                <?php vdposts_meta(); ?>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts2':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row g-2">
                            <div class="col-4 col-md-3">
                                <div class="ratio ratio-1x1 bg-light border border-4">
                                    <?php vdposts_gambar(); ?>
                                </div>
                            </div>
                            <div class="col-8 col-md-9">
                                <div class="post-date"><?php vdposts_meta(); ?></div>
                                <a class="fw-bold" href="<?php echo $link; ?>" title="<?php echo $judul; ?>">
                                    <?php echo esc_html(vdberita_limit_text(get_the_title(), 8)); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'carousel':
                ?>
                    <div class="carousel-post-item px-1">
                        <div class="card p-2 border-secondary-subtle shadow-sm bg-light h-100">
                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="ratio ratio-1x1 bg-light">
                                        <?php vdposts_gambar('thumbnail', true); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="post-date"><?php vdposts_meta(false); ?></div>
                                    <a href="<?php echo $link; ?>" title="<?php echo $judul; ?>">
                                        <?php echo esc_html(vdberita_limit_text(get_the_title(), 7)); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'image':
                ?>
                    <div class="ratio ratio-4x3 bg-light">
                        <?php vdposts_gambar('medium_large'); ?>
                    </div>
                <?php
                    break;
                case 'posts3':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row g-2">
                            <div class="col-4">
                                <div class="ratio ratio-1x1 bg-light border border-4">
                                    <?php vdposts_gambar(); ?>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="post-date"><?php vdposts_meta(); ?></div>
                                <a class="fw-bold" href="<?php echo $link; ?>" title="<?php echo $judul; ?>">
                                    <?php echo esc_html(vdberita_limit_text(get_the_title(), 10)); ?>
                                </a>
                                <div class="post-excerpt">
                                    <small><?php echo vdposts_ringkas(8); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts-head-footer':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row g-2">
                            <div class="col-4">
                                <div class="ratio ratio-1x1 bg-light border border-4">
                                    <?php vdposts_gambar(); ?>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="post-date"><?php vdposts_meta(); ?></div>
                                <a class="fw-bold" href="<?php echo $link; ?>" title="<?php echo $judul; ?>">
                                    <?php echo esc_html(vdberita_limit_text(get_the_title(), 8)); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts4':
                    echo '<a class="d-flex w-100 border-bottom pb-1 mb-1" href="' . $link . '">';
                    echo '<i class="fa fa-file-text-o mt-1 me-2" aria-hidden="true"></i>';
                    echo '<span>' . esc_html(get_the_title()) . '</span>';
                    echo '</a>';
                    break;
                case 'posts5':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="post-date"><?php vdposts_meta(); ?></div>
                        <a class="fw-bold" href="<?php echo $link; ?>" title="<?php echo $judul; ?>">
                            <?php echo esc_html(vdberita_limit_text(get_the_title(), 10)); ?>
                        </a>
                    </div>
                <?php
                    break;
                case 'title-half':
                    echo '<a class="title-half d-inline-block align-top pb-1 mb-1" href="' . $link . '">';
                    echo '<span>' . esc_html(get_the_title()) . '</span>';
                    echo '</a>';
                    break;
                case 'heading':
                    echo '<h3 class="h4 fw-bold"><a class="d-block pb-1 mb-1" href="' . $link . '">' . esc_html(get_the_title()) . '</a></h3>';
                    echo '<div class="post-excerpt"><small>' . vdposts_ringkas(25) . '</small></div>';
                    break;
                case 'homespecial':
                ?>
                    <div class="posts-item bg-white p-2 shadow mb-2 position-relative">
                        <span class="position-absolute z-1 top-0 start-0 translate-middle-y">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pin-angle-fill text-warning" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146z" />
                            </svg>
                        </span>
                        <div class="ratio ratio-16x9 bg-light mb-2">
                            <?php vdposts_gambar('medium'); ?>
                        </div>
                        <div class="post-text">
                            <div class="py-2 px-1 text-muted"><?php vdposts_meta(); ?></div>
                            <a class="fw-bold mb-2 d-block h6" href="<?php echo $link; ?>">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </div>
<?php
                    break;
                default:
                    echo '<div class="posts-item border-bottom pb-1 mb-2">';
                    echo '<a href="' . $link . '">' . esc_html(get_the_title()) . '</a>';
                    echo '</div>';
                    break;
            }
        }
        echo '</div>';
    }
    /* Restore original Post Data */
    wp_reset_postdata();
}
