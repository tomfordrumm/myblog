<?php get_header();?>




        <div class="title-line">
            <span class="page-title-text more-padd"><?php _e('Archive', tk_theme_name);?></span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>

        <div class="posts-one-row">
                <?php
                    $i=1;

                    //The Loop
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                    $video_link = get_post_meta($post->ID, 'tk_video_link', true);
                    $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);

                    $embed_code = wp_oembed_get($video_link, array('width'=>804));
                            $images = '';
                            if(!empty($slide_images)){
                                foreach($slide_images as $slide) {

                                if($slide != ''){
                                $images .= '<img src="'.tk_get_thumb_new(804, 330, $slide).'"/> ';
                                }
                            }
                    }
                ?>

            <div class="blog-one-post">
            <div class="blog-image-right">
                <div class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                <?php if(!empty($embed_code)) { ?>
                    <div class="video-holder"><?php echo $embed_code; ?></div>
                <?php } else if(!empty($images)) { ?>

                <script type="text/javascript">
                        jQuery(window).load(function() {
                            jQuery('#slider<?php echo $i; ?>').nivoSlider({
                                effect: 'fade',
                                directionNav: false,
                                controlNav: true
                            });
                        });
                </script>

                    
                        <div id="slider<?php echo $i; ?>" class="blog-slider" style="float:right;">
                            <?php echo $images; ?>
                        </div>
                  

                <?php } else if (has_post_thumbnail()) { ?>
                    <div class="blog-page-image-holder">
                        <div class="blog-page-image-center">
                            <span class="blog-page-image">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('blog'); ?></a>
                            </span>
                        </div>
                    </div><!--Closes blog-page-image-holder-->
                <?php }?>

            </div><!-- blog-image-right -->

                <div class="blog-info-holder">
                    <div class="info-text admin-icon"><?php the_author_posts_link(); ?></div>
                    <div class="info-text"><img src="<?php echo get_template_directory_uri(); ?>/style/img/calendar-post.png" /><br /><?php the_time('F');?> <?php the_time('d');?>, <?php the_time('Y');?></div>
                    <div class="info-text"><img src="<?php echo get_template_directory_uri(); ?>/style/img/comments.png" /><br /><a href="<?php the_permalink(); ?>"><?php echo comments_number('0', '1', '%'); ?></a></div>
                </div>

                <div class="blog-content-holder">
                    <div class="blog-post-text shortcodes"><?php the_excerpt_length(800); ?></div>
                    <a class="blog-cell_read_more" href="<?php the_permalink(); ?>"><?php _e('More', tk_theme_name); ?></a>
                </div>

                <div class="clear-both"></div>
                <div class="post-separator"></div>
                <div class="clear-both"></div>
            </div><!--closes one_cell-->

            <?php $i++;  endwhile; endif; ?>

            <div class="pagination">

                <ul class="paging tk_pagination pageing">
                    <?php
                        global $wp_query;

                        $big = 999999999; // need an unlikely integer

                        $pageing =  paginate_links( array(
                                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                'format' => '?paged=%#%',
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages
                        ) );


                        echo $pageing;
                    ?>
                </ul>
            </div>
        </div><!--close one row-->




<?php get_footer(); ?>