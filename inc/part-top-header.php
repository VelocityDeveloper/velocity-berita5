<div class="container-fluid bg-light">
    <div class="container bg-transparent">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="py-2 px-3">
                <?php echo date('l jS F Y', current_time('timestamp', 0)); ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="py-2 px-3">
                <?php
                    // The Query
                    $args = array(
                        'post_type'     => 'post',
                        'posts_per_page' => 5
                    );
                    $the_query = new WP_Query($args);

                    // The Loop
                    $nm = 1;
                    if ($the_query->have_posts()) {
                        echo '<div id="carouselTickerNews" class="carousel slide carousel-fade" data-bs-ride="carousel">';
                        echo '<div class="carousel-inner">';
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            if (get_the_title()) {
                                echo '<div class="carousel-item text-truncate' . ($nm == 1 ? ' active' : '') . '">';
                                echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title(). '</a>';
                                echo '</div>';
                            }
                            $nm++;
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    /* Restore original Post Data */
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="col-md-4 bg-success text-dark bg-opacity-10">
                <form action="" method="get" class="d-flex overflow-hidden border border-0 border-dark my-1 bg-transparent">
                    <input type="text" name="s" placeholder="Search" style="width:80%;" class="bg-transparent form-control-sm bg-light border border-0 rounded-0">
                    <button type="submit" class="btn btn-link text-secondary py-1 px-2">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
