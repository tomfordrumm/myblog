</div><!-- #content-wrapper -->
</div><!-- #main -->


<div class="clear-both"></div>
</div> <!-- ends wrapper -->
<div id="footer" >
    <?php
        $username = get_theme_option(tk_theme_name.'_social_twitter');     
        if(!empty($username)) {
        $show_twitter = get_theme_option(tk_theme_name.'_social_show_twitter');
       if($show_twitter){
    ?>
    <div class="twitter-holder">
<?php
            // Suffix - some text you want display after your latest tweet. (Same rules as the prefix.)
            $suffix = "";

            $feed = "http://search.twitter.com/search.atom?q=from:" . $username . "&rpp=1";
            $curl_handle = curl_init($feed);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT,10);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            $content = "";
            $content = curl_exec($curl_handle);
            curl_close($curl_handle);
            $parsed = "";
            if(isset($content)) {
                $result = new SimpleXMLElement($content);

                $parsed = $result->entry->content;
            }

            if(!empty($parsed)) { ?>

            <div class="footer_twitter">
                <div class="twitter-dialog">
                    <table class="twitter_table">
                        <thead>
                            <tr><th colspan="2"><div class="twitter-dialog-top"> </div></th></tr>
                        </thead>
                        <tbody>
                            <tr><td style="width:10px;vertical-align:top;">
                                    <a href="http://twitter.com/<?php echo get_option('footer_twitter');?>" class="twitter-link" title="Follow me on Twitter"><span class="bird"></span></a></td>
                                <td class="twitter-dialog-td-p">
                                        <?php echo $parsed.stripslashes($suffix);
                                        ;  ?>
                                </td>
                            </tr>
                            <tr><td colspan="2">
                                    <div class="twitter-dialog-down"> </div>
                                </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
</div><!--twitter holder-->

<?php } } ?>

    <div class="footer-container">
        <div id="footer_wrap">
            <div class="footer_widget_box">
                <div class="footer_box">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                    <?php endif; ?>
                </div> <!--close footer_box-->

                <div class="footer_box">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                    <?php endif; ?>
                </div><!--close footer_box-->

                <div class="footer_box">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                    <?php endif; ?>
                </div><!--close footer_box-->

                <div class="footer_box last">
                    <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 4')) : ?>
                    <?php endif; ?>
                </div><!--close footer_box-->

                <div class="clear-both"></div>
            </div><!--close footer box-->
        </div><!--close wrap -->
    </div><!--close container-->
</div><!--close footer-->

<?php
    $twitter = get_theme_option(tk_theme_name.'_social_twitter');
    $facebook = get_theme_option(tk_theme_name.'_social_facebook');
    $google_plus = get_theme_option(tk_theme_name.'_social_google_plus');
    $linkedin = get_theme_option(tk_theme_name.'_social_linked_in');
    $rssfeed = get_theme_option(tk_theme_name.'_social_rss_url');
    $rssfeedshow = get_theme_option(tk_theme_name.'_social_enable_rss');
?>
</div>

<div id="down-shadow"><div id="copyright-wrap">
    <div id="connect">
        <?php  if(!empty($twitter)) {  ?>
            <a href="<?php echo "http://www.twitter.com/".$twitter; ?>" class="footer-twitter"></a>
        <?php } ?>
                
        <?php if(!empty($facebook)) {    ?>
                <a href="http://facebook.com/<?php echo $facebook;?>" class="footer-facebook"></a>
        <?php } ?>

        <?php if(!empty($google_plus)) {    ?>
                <a href="https://plus.google.com/<?php echo $google_plus;?>" class="footer-gplus"></a>
        <?php } ?>

        <?php if(!empty($linkedin)) {    ?>
                <a href="<?php echo $linkedin;?>" class="footer-linkedin"></a>
        <?php } ?>


        <?php if($rssfeedshow) { ?>
        <?php if(!empty($rssfeed)) {    ?>
                <a href="<?php echo $rssfeed;?>" class="footer-rss"></a>
        <?php } else { ?>
                <a href="?php bloginfo('rss2_url'); ?>" class="footer-rss"></a>
        <?php } } ?>
    </div>

        <?php
        $copyright = get_theme_option(tk_theme_name.'_general_footer_copy');
        if(empty($copyright)) {
            $copyright = "<span class='thecopyright'>Copyright Information Goes Here 2010. All Rights Reserved. Designed by </span>&nbsp;<a href='http://www.themeskingdom.com'>Themes Kingdom</a>";
        }?>
        
        <p><span class='thecopyright'><?php echo $copyright; ?></span></p>
    </div><!--close copyright-wrap--></div>
<div id="copyright">
</div> <!--close copyright-->
<div class="clear-both"></div>
</div>
<?php wp_footer(); ?>
</body>
</html>