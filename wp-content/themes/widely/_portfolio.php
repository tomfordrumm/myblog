<?php 
/*

Template Name: Portfolio

*/
get_header();

    $prefix = 'tk_';
    $show_home_content= get_theme_option(tk_theme_name.'_home_use_home_content');
    $show_call_to_action= get_theme_option(tk_theme_name.'_home_use_call_to_action');

    $page_headline = get_post_meta($post->ID, 'page_headline', true);
    $page_headline_link = get_post_meta($post->ID, 'page_headline_link', true);
        ?>

                            <?php if($page_headline) { ?>
                                    <div id="headline">
                                        <div id="high_light">
                                      <?php if($page_headline_link) { ?>      <a href="<?php echo $page_headline_link; ?>" class="learn_more"><?php } ?>
                                                <h2 class="high_light_h2"><?php echo $page_headline; ?></h2>
                                            <?php if($page_headline_link) { ?></a><?php } ?>
                                        </div><!--close high_light-->
                                    </div><!--close headline-->
                            <?php } ?>
                        
        <div class="title-line">
            <span class="page-title-text more-padd"><?php the_title();?></span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>

        <div id="wraper-inside">
        <div id="wraper-holder-wide">
            <div id="portfolio-loader"></div>

                        <?php
                          global $wpdb;
                          $post_type_ids = $wpdb->get_col("SELECT ID FROM $wpdb->posts WHERE post_type = 'pt_portfolio' AND post_status = 'publish'");
                          if(!empty ($post_type_ids )){
                            $post_type_cats = wp_get_object_terms( $post_type_ids, 'ct_portfolio' ,array('fields' => 'ids') );


                            if($post_type_cats){
                              $post_type_cats = array_unique($post_type_cats);
                              $allcat = implode(',',$post_type_cats);
                            }
                          }
                          $include_category = null;
                        ?>

                <div class="portfolio-cat-holder">                      
                        <ul id="filters">

                            <li class="cat_cell" ><a href="#" data-filter="*" class="all-cats"  ><?php _e('CATEGORIES:', tk_theme_name); ?></a></li>
                                  <?php
                                if(!empty ($post_type_ids )){
                                     $cat_count = count($post_type_cats);
                                     $cat_counter = 1;
                                     foreach ($post_type_cats as $category_list) {
                                        $cat = 	$category_list.",";
                                        $include_category = $include_category.$cat;
                                        $cat_name = get_term($category_list, 'ct_portfolio');
                                    ?>

                                        <li rev="<?php echo $category_list?>"  class="cat_cell">
                                                <a href="#" data-filter="<?php echo '.class-'.$category_list?>" >-  <?php echo $cat_name->name?></a>
                                        </li>

                                    <?php }} ?>
                        </ul>
                </div>

                <div id="portfolio-holder-relative" >
                    <div id="portfolio-holder">

                   <?php
                        $id_array = explode(',', $allcat);
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
                        $args=array( 'tax_query' => array(array('taxonomy' => 'ct_portfolio','field' => 'term_id', 'terms' => $id_array)),  'post_type' => 'pt_portfolio',  'paged' => $paged, 'post_status' => 'publish', 'ignore_sticky_posts'=> 1,'posts_per_page'=>-1, 'meta_key'=> '_thumbnail_id');

                        //The Query
                        $the_query = new WP_Query( $args );

                        $i=1;


                        //The Loop
                        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                       
                        $post_category = wp_get_post_terms( $post->ID, 'ct_portfolio');
                        $isotop_cat ='';
                        foreach ($post_category as $cat_id) {
                            $isotop_cat .= ' class-'.$cat_id->term_id;
                        }
                        if($i == 4) {
                            $nomargin = 'nomargin';
                        } else {
                            $nomargin = ' ';
                        }

                        $slide_images = get_post_meta($post->ID, $prefix.'repeatable', true);

                        if(!empty($slide_images)){
                            $images_src = tk_get_thumb_new(212, 140, $slide_images[0]);
                        }
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full' );
                    ?>


                        <div class="portfolio_box <?php echo $isotop_cat.' '.$nomargin; ?> isotope-item" >                      
                            <div class="portfolio_image_bg_3 portfolio_box_categories">
                                <div class="page-image-center">
                                    <span class="page-image">
                                        <?php if(has_post_thumbnail()) { ?>
                                            <a href="<?php echo $image[0]; ?>" class="pirobox" title="<?php the_title(); ?>"><?php the_post_thumbnail('portfolio-small'); ?></a>
                                        <?php } ?>
                                    </span>
                                </div>                 
                            </div><!-- close image_bg -->
                             <h2 class="portfolio-h2 portfolio-title"><?php the_title(); ?></h2>
                         </div>
                        <?php endwhile; endif; ?>


                    </div>
                    
                </div>
            </div>
        </div>
        <div class="clear-both"></div>
<?php get_footer(); ?>