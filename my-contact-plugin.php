<?php
/**
 *Plugin Name: Gedoni Contact Plugin
 */

 function my_contact_plugin(){
   $content = '';
   $content .= '<h2>Contact Us!</h2>';
   $content .= '<form method="post" action="">';
   $content .= '<br/><label for="your_name">Name:</label>';
   $content .= '<input type="text" class="form-control" name="your_name" placeholder="Enter your name" />';
   
   $content .= '<br/><label for="your_email">Name:</label>';
   $content .= '<input type="email" class="form-control" name="your_email" placeholder="Enter your email" />';

   $content .='<br/><label for="your_message">Message:</label>';
   $content .='<textarea name="your_message" class="form-control" placeholder="Enter your message"></textarea>';

   $content .='<br/><input type="submit" name="my_contact_submit" class="btn btn-primary" value="Send Message" />';
   $content .='</form>';
   return $content;
 }

 add_shortcode('my_contact', 'my_contact_plugin');

 function my_contact_capture(){
   if(isset($_POST['my_contact_submit'])){
      $name = sanitize_text_field($_POST['your_name']);
      $email = sanitize_text_field($_POST['your_email']);
      $details = sanitize_textarea_field($_POST['your_message']);

      $to = get_option('admin_email');
      $subject = 'Contact form submitted';
      $message = ''.$name.' - '.$email.' - '.$details;

      wp_mail($to,$subject,$message);

      echo '<div class="alert alert-success">
      <p>' . __('Success! Form submitted successfully!.') . '</p>
      </div>';
   } else {
      echo '<div class="alert alert-danger">
      <p>' . __('Error! Form submission failed!.') . '</p>
      </div>';
   }
 }

 add_action('wp_head', 'my_contact_capture');

?>