<?php

require( '../../../../../wp-load.php' );

$shortcode = base64_decode( trim( $_GET['sc'] ) );
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all" />
        <?php wp_head(); ?>
        <style type="text/css">
            html {
                margin: 0 !important;
            }
            body {
                padding: 20px 15px;
            }
        </style>
    </head>
    <body style="background:none;float: left" class="tk-preview">
        <?php echo do_shortcode( $shortcode ); ?>
    </body>
</html>