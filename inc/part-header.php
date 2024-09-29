<nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light shadow-sm p-0" aria-labelledby="main-nav-label">

    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e('Main Navigation', 'justg'); ?>
    </h2>
    <div class="head-part-top bg-transparent mb-2">
        <div class="row align-items-center">
            <div class="col-md-5 col-xl-4">
                <?php echo the_custom_logo(); ?>
            </div>
            <div class="col-md d-none d-md-block">
                <?php get_berita_iklan('iklan_header_1'); ?>
            </div>
        </div>
    </div>
    <div class="container head-part-menu navbar-dark bg-color-theme">
        <div class="menu-header">

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                <span class="navbar-toggler-icon"></span>
                <small>Menu</small>
            </button>

            <div class="offcanvas bg-dark offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

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
                        'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                        'fallback_cb'     => '',
                        'menu_id'         => 'main-menu',
                        'depth'           => 4,
                        'walker'          => new justg_WP_Bootstrap_Navwalker(),
                    )
                );
                ?>
            </div><!-- .offcanvas -->
        </div>
        <div class="search-header">

        </div>
    </div>
    <div class="secondary-menu position-relative bg-color-theme-secondary">
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'secondary',
                'container_class' => 'secondary-menu-body',
                'container_id'    => '',
                'menu_class'      => 'navbar-nav navbar-dark justify-content-start flex-grow-1 px-2',
                'fallback_cb'     => '',
                'menu_id'         => 'secondary-menu',
                'depth'           => 1,
                'walker'          => new justg_WP_Bootstrap_Navwalker(),
            )
        );
        ?>
    </div>
</nav><!-- .site-navigation -->