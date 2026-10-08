<footer class="site-footer container bg-dark text-white py-2 px-3" id="colophon">
    <div class="row footer-widget text-start mx-auto px-2 pt-4">
        <?php for ($x = 1; $x <= 3; $x++) { ?>
            <?php if (is_active_sidebar('footer-widget-' . $x)) { ?>
                <div class="col-md">
                    <?php dynamic_sidebar('footer-widget-' . $x); ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="row align-items-center footer-bawah border-top border-secondary pt-2 mt-2">
        <div class="col-md-6">
            <div class="site-info">
                <small>
                    &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Hak cipta dilindungi.', 'justg'); ?>
                    <br>
                    Design by <a class="text-secondary" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer">Velocity Developer</a>
                </small>
            </div>
            <!-- .site-info -->
        </div>
        <div class="col-md-6 text-md-end pt-2 pt-md-0">
            <?php
            foreach (velocity_berita5_sosmed() as $key => $label) {
                $datalink = get_theme_mod('link_sosmed_' . $key, '');
                if ($datalink) {
                    echo '<a class="btn btn-sm btn-secondary ms-1" href="' . esc_url($datalink) . '" target="_blank" rel="noopener" aria-label="' . esc_attr($label) . '"><i class="fa fa-' . esc_attr($key) . '" aria-hidden="true"></i></a>';
                }
            }
            ?>
            <a class="btn btn-sm btn-secondary ms-1" href="<?php echo esc_url(get_feed_link()); ?>" target="_blank" rel="noopener" aria-label="RSS"><i class="fa fa-rss" aria-hidden="true"></i></a>
        </div>
    </div>
</footer>