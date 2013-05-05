
<span class="comment-start"><div class='comment_popup_wrap'><span class='comment_popup'>
        <?php
        if (get_comments_number() == '0') { ?>
            <?php _e('No comments', tk_theme_name);?>
        <?php } else {?>
                <?php comments_number( '0', '1', '%' ); ?> <?php _e('Comments', tk_theme_name)?>
        <?php }?>

        </span></div><span class='comment_popup_border'>
</span>

                
<?php
function tk_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; 
    ?>

<!-- ONE COMMENT -->  
		<div class="single-comment-holder">
			<div class="comment-left-side">
                            
				<div class="single-comment-content">
                                    <div class="single-comment-title"><span class="bold"><?php _e('BY:', tk_theme_name); ?></span> <a href="#"><?php echo $comment->comment_author ?></div></a>
                                    <div class="single-comment-date"><span class="bold"><?php _e('ON:',tk_theme_name); ?></span>
                                                <a href="">
                                                    <?php echo $comment->comment_date ?>
                                                </a>
                                            </div>
				</div>
                        <?php edit_comment_link(__('Edit ', tk_theme_name),'  ','') ?>
			<div class="reply"><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
			
			</div>
			<div class="comment-right-side">

				<div class="comment-image-holder"><span class="comment-post-image">
					<?php echo get_avatar($comment,$size='50' ); ?>
				</span></div>
				<div class="comment-text">
					<p><?php comment_text() ?></p>
				</div><!--full width text -->

			</div>
			<div class="clear-both"></div>
		</div><!--single comment holder -->
		

<?php } ?>



<!-- COMMENTS LIST -->

        <?php wp_list_comments('type=comment&callback=tk_comments'); ?>
        <?php if ( comments_open() ) : ?>
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <div class="comment-title left"><?php _e('You must be', tk_theme_name)?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', tk_theme_name) ?></a> <?php _e('to post a comment.', tk_theme_name) ?></div>
                <?php else : ?>

<!-- FORM CHECKING -->

<script type="text/javascript">
function validate_email(field)
{
    with (field)
    {
        apos=value.indexOf("@");
        dotpos=value.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {jQuery('#message').empty().append('Please insert your email');return false;}
        else {return true;}
    }
}
    
function checkForm(){
    var errors = 0;

    if(jQuery('#comment').val() == 'Message'){
        jQuery('#message').html('Please insert your message');
        errors++;jQuery('#comment').focus();
    }

    var email = document.getElementById('comment-email');
    if (validate_email(email)==false)
    {errors++;jQuery('#comment-email').focus();}

    if(jQuery('#author').val() == 'Name (required)'){
        jQuery('#message').html('Please insert your name');
        errors++;jQuery('#author').focus();
    }

    if(errors == 0){
        return true;
    }else{
        return false;
    }
}
</script>


<!-- COMMENT FORM -->

    <div class="form left" style="margin-top: 40px; float:left;">
        <div class="title-form left"></div><!--/title-form-->
        
            <!--<a id="respond" name="respond"></a>-->
        
<?php if ( comments_open() ) : ?>
<div class="comment_popup_wrap"><span class="comment_popup"><?php _e('COMMENT', tk_theme_name); ?> </span></div><span class='comment_popup_border'></span>
<div id="respond" class="respond-style">

    <!--COMMNET FORM-->

    <div class="cancel-comment-reply">
        <small><?php cancel_comment_reply_link(); ?></small>
    </div> <!-- end cancel-comment-reply div -->

    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p class="comment-p-style"><?php _e('You must be',THEME_NAME)?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in',tk_theme_name) ?></a> <?php _e('to post a comment.',tk_theme_name) ?></p>
    <?php else : ?>
    <div class="form-holder-comments">
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform contact-form" class="commnet">
                <?php if ( $user_ID ) : ?>

            <div class="comment-form-left margintop15" >
                <p><?php  _e('Logged in as',tk_theme_name) ?> <a  href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;',tk_theme_name) ?></a></p>
            </div>
                <?php else : ?>

            <div class="comment-form-left margintop15" >
                <input class="form-field" type="text" spellcheck="false" name="author" id="contactname" value="Name" class="contact_input_text" tabindex="1" />
                <input class="form-field" type="text" spellcheck="false" name="email" id="email" value="E-mail" class="contact_input_text" tabindex="2" />
                <input class="form-field" type="text" spellcheck="false" name="url" id="url" value="Website" class="contact_input_text" tabindex="3" />
            </div> <!-- close comment-form-left -->

                <?php endif; ?>
                                <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

            <textarea onfocus="if(value==defaultValue)value=''" onblur="if(value=='')value=defaultValue" name="comment" spellcheck="false" id="message" class="input comment-textarea" tabindex="4"><?php _e('Message', tk_theme_name); ?></textarea>

            <div class="form-send-button"><div class="form-send-button-left"></div><div class="form-send-button-center">
                    <input type="submit" class="blog-send-button" name="submit-comment"  value="<?php _e('Send', tk_theme_name); ?>" />
                </div>
                <div class="form-send-button-right"></div>
            </div>
<?php endif; ?>
            <div class="clear-both"></div>
                <?php comment_id_fields(); ?>
                <?php do_action('comment_form', $post->ID);
                ?>
        </form>

        <div class="clear-both"></div>

    </div><!--form holder -->
    <?php endif; // If registration required and not logged in ?>           
    </div>
        <?php endif; ?>
<?php else : ?>
<div class="comment-title left"><?php _e('Comments are closed', tk_theme_name)?></div>
<?php endif; ?>