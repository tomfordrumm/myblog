<?php get_header();
$prefix = 'tk_';
$author = get_userdata( $post->post_author );
$post_type = get_post_type();
$video_link = get_post_meta($post->ID, 'tk_video_link', true);
?>





<?php 
           $get_page = get_option('title_blog_page');           
            if($get_page) {
?>
        <div class="title-line">
            <span class="page-title-text more-padd"><?php echo $get_page;?></span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>
<?php } ?>

        <div class="posts-one-row">
                <div class="single-all-wrap">
                    <div class="blog-info-holder">
                      <?php
                      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                        
                      
                        <div class="info-text admin-icon"><?php the_author_posts_link(); ?></div>
                     
                        <div class="info-text"><img src="<?php echo get_template_directory_uri(); ?>/style/img/calendar-post.png" /><br /><?php the_time('F');?> <?php the_time('d');?>, <?php the_time('Y');?></div>
                        <div class="info-text"><img src="<?php echo get_template_directory_uri(); ?>/style/img/comments.png" /><br /><a href="<?php the_permalink(); ?>"><?php echo comments_number('0', '1', '%'); ?></a></div>
                    </div>

                    <div class="single-post-wrap">
                        
                        <div class="blog-post-title"><?php the_title(); ?></div>

                <?php
                        $i=1;
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


                <?php if(!empty($embed_code)) { ?>
                    <?php echo $embed_code; ?>
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

                    <div id="slider<?php echo $i; ?>" class="blog-slider"  style="float:right;">
                        <?php echo $images; ?>
                    </div>

                        
                <?php } else if (has_post_thumbnail()) {
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
                  
                    ?>
                    <div class="blog-page-image-holder">
                        <div class="blog-page-image-center">
                            <span class="blog-page-image">
                                <a href="<?php echo $image[0]; ?>" class="pirobox" ><?php the_post_thumbnail('blog'); ?></a>
                            </span>
                        </div>
                    </div><!--Closes blog-page-image-holder-->
                <?php }?>
            


                    <div class="blog-content-holder">
                        <div class="blog-post-text shortcodes">
                            <?php

                                        the_content();
                                    endwhile;
                                else:
                                endif;
                                wp_reset_query();
                            ?>
                        </div>
                    </div>
           
                        <div class="clear-both"></div>

                    </div><!--closes single-post-wrap-->
                </div><!--closes one_cell-->
                <div class="clear-both"></div>
        </div>


        <?php if ( comments_open() ) : ?>

        <div class="clear-both"></div>
        <?php comments_template(); // Get wp-comments.php template ?>
        <?php endif; ?>
        

<?php get_footer(); ?>