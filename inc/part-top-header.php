<div class="container-fluid bg-light top-header-berita">
    <div class="container bg-transparent">
        <div class="row align-items-center g-0">
            <div class="col-md-3 d-none d-md-block">
                <div class="py-2 px-3">
                    <?php echo esc_html(date_i18n('l, j F Y')); ?>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="py-2 px-3 d-flex align-items-center">
                    <span class="badge bg-color-theme rounded-0 me-2 flex-shrink-0"><?php esc_html_e('Terkini', 'justg'); ?></span>
                    <?php
                    $the_query = new WP_Query(array(
                        'post_type'           => 'post',
                        'posts_per_page'      => 5,
                        'ignore_sticky_posts' => true,
                        'no_found_rows'       => true,
                    ));
                    if ($the_query->have_posts()) {
                        echo '<div id="carouselTickerNews" class="carousel slide carousel-fade flex-grow-1 overflow-hidden" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';
                        $nm = 1;
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            if (get_the_title()) {
                                echo '<div class="carousel-item text-truncate' . ($nm == 1 ? ' active' : '') . '">';
                                echo '<a href="' . esc_url(get_the_permalink()) . '" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</a>';
                                echo '</div>';
                                $nm++;
                            }
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search" class="search-top-berita d-flex my-1 mx-2 mx-md-0">
                    <label class="visually-hidden" for="search-top-berita"><?php esc_html_e('Cari berita', 'justg'); ?></label>
                    <input type="search" id="search-top-berita" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Cari berita...', 'justg'); ?>" class="form-control form-control-sm rounded-0 border-0 bg-white">
                    <button type="submit" class="btn btn-sm bg-color-theme text-white rounded-0 px-3" aria-label="<?php esc_attr_e('Cari', 'justg'); ?>">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
