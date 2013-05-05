<?php
/*

Template Name: Contact

*/
get_header();
$prefix = 'tk_';

?>
        <?php
            $page_headline = get_post_meta($post->ID, 'page_headline', true);
            $page_headline_link = get_post_meta($post->ID, 'page_headline_link', true);
        ?>

        <?php if($page_headline) { ?>
                <div id="headline">
                    <div id="high_light">
                       <?php if($page_headline_link) { ?> <a href="<?php echo $page_headline_link; ?>" class="learn_more"><?php } ?>
                            <h2 class="high_light_h2"><?php echo $page_headline; ?></h2>
                       <?php if($page_headline_link) { ?> </a><?php } ?>
                    </div><!--close high_light-->
                </div><!--close headline-->
        <?php } ?>
                        
        <div class="title-line">
            <div class="clear"></div>
            <span class="page-title-text more-padd"><?php the_title();?></span><div class="title-width-line"></div>
            <div class="clear-both"></div>
        </div>

               <?php
                    $x_coord = get_option(tk_theme_name.'_contact_googlemap_x');
                    $y_coord = get_option(tk_theme_name.'_contact_googlemap_y');
                    $zoom_factor = get_option(tk_theme_name.'_contact_googlemap_zoom');
                    $map_type = get_option(tk_theme_name.'_contact_google_map_type');
                    $marker_title = get_option(tk_theme_name.'_contact_marker_title');
                    if(empty($x_coord)) {$x_coord = 45.256024;}
                    if(empty($y_coord)) {$y_coord = 19.853861;}
                    if(empty($zoom_factor)) {$zoom_factor = 15;}
                    if(empty($map_type)) {$map_type = 'ROADMAP';}

                    $show_map = get_theme_option(tk_theme_name.('_contact_show_map'));
                ?>

                <div class="contact-content left">

                <?php if($show_map) { ?>
                    <div class="bg-maps left">
                        <div class="map-contact left">
                            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
                            <div id="map_canvas" style="width: 100%; height: 350px; min-height: 0px;" class="contact-img"></div>

                            <script type="text/javascript">

                                var latlng = new google.maps.LatLng(<?php echo $x_coord?>, <?php echo $y_coord?>);

                                var myOptions = {
                                    zoom: <?php echo $zoom_factor ?>,
                                    center: latlng,
                                    mapTypeControl: false,
                                    streetViewControl: false,
                                    overviewMapControl: false,
                                    mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>,
                                    scrollwheel: false
                                };

                                var mapa = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                <?php if(!empty($marker_title)) { ?>
                                  var marker = new google.maps.Marker({
                                      position: latlng,
                                      map: mapa,
                                      title:"<?php echo $marker_title?>"
                                  });
                              <?php }?>

                            </script>
                        </div><!--/map-contact-->
                    </div><!--/bg-maps-->
                    <?php } ?>

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


             <?php
                $subject_error_msg = get_option(tk_theme_name.'_contact_subject_error_message');
                $name_error_msg = get_option(tk_theme_name.'_contact_name_error_message');
                $email_error_msg = get_option(tk_theme_name.'_contact_email_error_message');
                $message_error_msg = get_option(tk_theme_name.'_contact_message_error_message');
                $mail_success_msg = get_option(tk_theme_name.'_contact_message_successful');
                $mail_error_msg = get_option(tk_theme_name.'_contact_message_unsuccessful');
                ?>


                <!-- Validate script -->
                <script type="text/javascript">
                    function validate_email(field,alerttxt)
                    {
                        with (field)
                        {
                            apos=value.indexOf("@");
                            dotpos=value.lastIndexOf(".");
                            if (apos<1||dotpos-apos<2)
                            {jQuery('#contact-error').empty().append(alerttxt);return false;}
                            else {return true;}
                        }
                    }

                    function check_field(field,alerttxt,checktext){
                        with (field)
                        {
                            var checkfalse = 0;
                            if(field.value == ""){
                                jQuery('#contact-error').empty().append(alerttxt);
                                field.focus();checkfalse=1;}

                            if(field.value==checktext)
                            {
                                jQuery('#contact-error').empty().append(alerttxt);
                                field.focus();checkfalse=1;}

                            if(checkfalse==1){return false;}else{return true;}
                        }
                    }

                    function checkForm(thisform)
                    {
                        with (thisform)
                        {
                            var error = 0;

                            var message = document.getElementById('message');
                            if(check_field(message,"<?php echo $message_error_msg?>","Message")==false){
                                error = 1;
                            }

                            var email = document.getElementById('contactemail');
                            if (validate_email(email,"<?php echo $email_error_msg?>")==false)
                            {email.focus();error = 1;}

                            var contactname = document.getElementById('contactname');
                            if(check_field(contactname,"<?php echo $name_error_msg?>","Name")==false){
                                error = 1;
                            }


                            if(error == 0){
                                var contactname = document.getElementById('contactname').value;
                                var email = document.getElementById('contactemail').value;
                                var message = document.getElementById('message').value;

                                return true;
                            }
                            return false;
                        }
                    }
                </script>
                <!-- end of script -->

                <div class="contact-wrap">
                    <h2><?php _e('Say Hello', tk_theme_name); ?></h2>
                    <div class="contact-form">                         
                        <div class="form left">                          
                            <form method="POST" id="contactform" onsubmit="return checkForm(this)" action="<?php echo get_template_directory_uri().'/sendcontact.php'?>" >
                              <p>
                                   <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="Name" name="contactname" class="contact_input_text focusField" id="contactname" tabindex="2"/>
                              </p>
                              <p>
                                   <input type="text" onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" value="E-Mail" name="email" class="contact_input_text last focusField" id="contactemail" tabindex="3"/>
                              </p>

                              <p>
                                  <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" class="input form-textarea focusField" name="message"><?php _e('Message', tk_theme_name); ?></textarea>
                              </p>

                              <div class="color-buttons">
                                      <div class="contact-send-button">
                                          <div class="contact-send-button-left"></div>
                                          <div class="contact-send-button-center">
                                              <input type="submit" class="contact-submit" name="submit-comment" value="<?php _e('Send', tk_theme_name);?>">
                                          </div>
                                      <div class="contact-send-button-right"></div>
                                  </div>
                              </div>
                        </div>

                    <input type="hidden" name="returnurl" value="<?php echo get_permalink();  ?>">
                        <div id="contact-success">
                            <?php if(isset($_GET['sent'])) {
                                $what = $_GET['sent'];
                                if($what == 'success') {
                                    echo $mail_success_msg;
                                        }
                                    }
                                    ?>
                        </div>
                        <div id="contact-error">
                                <?php if(isset($_GET['sent'])) {
                                
                            $what = $_GET['sent'];
                                                if($what == 'error') {
                                                    echo $mail_error_msg;
                                        }
                                    }
                            ?>
                        </div>
                            </form>
                        </div><!--/form-->

                        <?php
                            $contact_text = get_theme_option(tk_theme_name.'_contact_contact_text')
                        ?>

                        <div class="contact-right shortcodes">
                            <?php echo $contact_text; ?>
                        </div>
                </div><!-- contact-wrap -->

        <div class="clear-both"></div>
<?php get_footer(); ?>




