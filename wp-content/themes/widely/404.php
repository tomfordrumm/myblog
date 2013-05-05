<?php
get_header(); ?>

        <div class="title-line">
            <div class="clear"></div>
            <span class="page-title-text more-padd">404</span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>
        <div id="container-full">
            <div class="container 404">
                <div class="left_content">
                    <span class="page404span"><?php _e('Looks like the page you were looking for does not exist.
                        Sorry about that.', tk_theme_name); ?></span>
                    <span class="notice404"><?php _e('Check the web address for typos, visit the ', tk_theme_name); ?><a href="<?php echo get_site_url(); ?>"><?php _e('home page', tk_theme_name) ?></a> <?php _e('or use our site search below.', tk_theme_name); ?></span>
                    <span class="search404"><?php get_search_form(); ?></span>
                </div>
                <!--close front_left_cell--> <div class="clear-both"></div>
            </div>
        </div>
    
<?php get_footer(); ?>
