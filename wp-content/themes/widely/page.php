<?php get_header();
    $prefix = 'tk_';
    $page_headline = get_post_meta($post->ID, 'page_headline', true);
    $page_headline_link = get_post_meta($post->ID, 'page_headline_link', true);
?>

        <?php if($page_headline) { ?>
                <div id="headline">
                    <div id="high_light">
                      <?php if($page_headline_link) { ?>  <a href="<?php echo $page_headline_link; ?>" class="learn_more"><?php } ?>
                            <h2 class="high_light_h2"><?php echo $page_headline; ?></h2>
                        <?php if($page_headline_link) { ?></a><?php } ?>
                    </div><!--close high_light-->
                </div><!--close headline-->
        <?php } ?>

        <div class="title-line">
            <div class="clear"></div>
            <h3 class="page_title"><?php echo the_title();?></h3><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>

            <div class="shortcodes">
                    <?php
                    wp_reset_query();
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                    else:
                    endif;
                    wp_reset_query();
                    ?>
            </div>

        <div class="clear-both"></div>
<?php get_footer(); ?>