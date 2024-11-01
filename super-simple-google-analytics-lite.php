<?php 

/*
Plugin Name: Super Simple Google Analytics Lite
Description: The simplest way to add Google analytics to your site with no bloat.
Version: 1.0
Author: 5fifty
Author URI: https://profiles.wordpress.org/5fifty/
License: GPLv2 or later
*/

//register the page settings
function ssga_register_settings() {
   add_option( 'ssga_tracking_code', 'Tracking Code');
   register_setting('ssga_options', 'ssga_tracking_code');
}
add_action( 'admin_init', 'ssga_register_settings' );

//register the options page
function ssga_register_options_page() {
  add_options_page('Super Simple Google Analytics', 'Super Simple Google Analytics', 'manage_options', 'ssga', 'ssga_options_page');
}
add_action('admin_menu', 'ssga_register_options_page');


//create options page
function ssga_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Super Simple Google Analytics</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'ssga_options' ); ?>
  <p>Enter your tracking code. It should look something like this: <strong>UA-80290854-1</strong></p>
  <table>
  <tr valign="top">
  <td><input type="text" id="ssga_tracking_code" name="ssga_tracking_code" value="<?php echo get_option('ssga_tracking_code'); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
}

// Add tracking code to wp_head()
function ssga_insert_tracking_code() { 
	?> <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo get_option('ssga_tracking_code') ?>', 'auto');
  ga('send', 'pageview');

</script> <?php
}

add_action( 'wp_head', 'ssga_insert_tracking_code' );

 ?>