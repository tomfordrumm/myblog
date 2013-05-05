<?php

//loading wordpress functions
    require( '../../../wp-load.php' );


define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');


 $to = get_option('admin_email');                  //Enter your e-mail here.
 $subject =  get_theme_option(tk_theme_name.'_contact_contact_subject');

 $from = $_POST['contactname'];
$name = $_POST['email'];
$message = $_POST['message'];
$headers = "From: $name <$from>\n";
$headers .= "Reply-To: $subject <$from>\n";
$return = $_POST['returnurl'];
$sitename =get_bloginfo('name');

 $body = "You received e-mail from ".$from."  [".$name."] "." using ".$sitename."\n\n\n".$message;
 
 $send = wp_mail($to, $subject, $body, $headers) ;


if($send){
wp_redirect($return.'?sent=success');
}else{
    wp_redirect($return.'?sent=error');

    }

 ?> 