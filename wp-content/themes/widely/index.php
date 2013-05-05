<?php get_header();
$prefix = 'tk_';
$show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
$show_call_to_action= get_theme_option(tk_theme_name.'_home_use_call_to_action');
?>

            <div id="slider">
                    <?php

                  $args=array('post_type' => 'pt_slides',  'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>-1);

                  //The Query
                  $the_query = new WP_Query( $args );
                  //The Loop
                  if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                  $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                  $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'slide' );                        
                  ?>

                <img src="<?php echo $image[0]; ?>"  title="<a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>" rev="<?php echo the_excerpt_length(420); ?>" />

                <?php               
                endwhile;
                endif;
                ?>
                
            </div>
                    <script type="text/javascript">
                        jQuery(window).load(function() {
                            jQuery('#slider').nivoSlider({
                                effect:'fade'
                            });
                        });
                    </script>

        <?php
            $show_news = get_theme_option(tk_theme_name.'_home_show_latest_news');
        ?>


<?php if($show_news) { ?>
        <div class="title-line">
            <span class="page-title-text"><?php _e('Latest News', tk_theme_name); ?></span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>
        <div class="posts-one-row">

<?php
            $i=1;
            $args=array('post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => 4, 'ignore_sticky_posts'=> 1);

            //The Query
            query_posts($args);

            //The Loop
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            $video_link = get_post_meta($post->ID, 'tk_video_link', true);
            if($i==4) { $lastclass='last-front'; } else { $lastclass=''; }

            ?>
            <div class="one-post <?php echo $lastclass?>">
                <div class="page-image-holder">
                    <div class="page-image-center">
                        <div class="page-image">
                                    <?php if (has_post_thumbnail()) {	?>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-posts'); ?></a>
                                        <?php }
                                    else echo '<div class="front-blank-image"></div>';?>
                        </div>
                    </div>
                </div><!--ends page-image-holder -->

                <div class="front-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                <div class="front-post-text"><?php the_excerpt_length(100); ?></div>
                <a class="cell_read_more" href="<?php the_permalink(); ?>"><?php _e('More', tk_theme_name); ?></a>
                <div class="clear-both"></div>
            </div><!--closes one_cell-->
            
            <?php $i++; ?>
            <?php endwhile; endif; ?>

            <div class="clear-both"></div>
        </div><!--close one row-->

        <?php }                 
                $call_to_action_text = get_theme_option(tk_theme_name.'_home_call_to_action_text');
                $call_to_action_button_text = get_theme_option(tk_theme_name.'_home_call_to_action_button_text');
                $call_to_action_button_url = get_theme_option(tk_theme_name.'_home_call_to_action_button_url');
                    if($show_call_to_action == 'yes') {
                ?>
        
        <div class="front-info-box">
            <div class="front-info-box-text"><?php echo $call_to_action_text ?></div>
            <a href="<?php echo $call_to_action_button_url; ?>">
                   <?php echo $call_to_action_button_text; ?>
            </a>
        </div>

            <?php } 
                $show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
                if($show_home_content == 'yes') {
        ?>


            <div class="shortcodes">
                           <?php
                        /* Run the loop to output the page.
                                                 * If you want to overload this in a child theme then include a file
                                                 * called loop-page.php and that will be used instead.
                        */
                        wp_reset_query();
                        query_posts( 'page_id=' . get_theme_option(tk_theme_name.'_home_home_content') );
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                                the_content();
                            endwhile;
                        else:
                        endif;
                        wp_reset_query();
                        ?>
                </div><!-- shortcodes -->
                <?php } ?>
                <div class="clear-both"></div>

        </div>
        <?php get_footer(); ?>