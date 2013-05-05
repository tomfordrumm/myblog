<?php
require_once( 'settings.php' );
global $shortcode_output;

$popup = trim( $_GET['popup'] );
$shortcode = create_shortcode( $popup );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head></head>
    <body>
        <div id="popup-window">
            <div style="padding: 25px">
                <div style="float: left">
                    <form method="post" id="popup-form">
                        <table id="popup-table">
                            <?php echo $shortcode_output ?>
                            <tbody>
                                <tr style="height: 30px;">
                                    <td class="field" ><a href="#" class="button insert" ><?php _e("Insert Shortcode", tk_theme_name)?></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div style="float:right;width: 210px;">
                    <?php  if( $popup == 'button' ) {?>
                    <iframe src="<?php echo get_template_directory_uri() ?>/inc/shortcodes/preview.php?sc=" width="210" frameborder="0" id="sk-preview"></iframe>
                        <?php } ?>
                    <?php  if( $popup == 'list' ) {?>
                    <iframe src="<?php echo get_template_directory_uri() ?>/inc/shortcodes/preview.php?sc=" width="210" frameborder="0" id="sk-preview"></iframe>
                        <?php } ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </body>
</html>