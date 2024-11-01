<?php
/*
Plugin Name: WP Lessn
Plugin URI: http://jayrobinson.org/wordpress/wp-lessn-plugin
Description: Published posts get a Shaun Inman Lessn'd URL. Please thank Shaun Inman for being awesome, not me. But <a href="mailto:jay@jayrobinson.org">email me</a> for support, not him.
Author: Jay Robinson
Version: 1.0
Author URI: http://jayrobinson.org

    Copyright 2009  Jay Robinson  (email: jay@jayrobinson.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/



// Create WP Lessn Administration Menu
add_action('admin_menu', 'my_plugin_menu');

function my_plugin_menu() {
    add_submenu_page('plugins.php', 'Configure WP Lessn', 'WP Lessn', 'administrator', 'wp_lessn', 'my_plugin_options'); 
}

function my_plugin_options() {

    $opt_name_my_lessn_domain     = 'my_lessn_domain';
    $opt_name_my_lessn_api_key    = 'my_lessn_api_key';
    $hidden_field_name            = 'wp_lessn_hidden';
    $data_field_my_lessn_domain   = 'my_lessn_domain';
    $data_field_my_lessn_api_key  = 'my_lessn_api_key';
    $wp_lessn_submit              = 'wp_lessn_submit';

    // Read in existing option value from database
    $opt_val_my_lessn_domain  = get_option( $opt_name_my_lessn_domain );
    $opt_val_my_lessn_api_key = get_option( $opt_name_my_lessn_api_key );
    
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val_my_lessn_domain  = $_POST[ $data_field_my_lessn_domain ];
        $opt_val_my_lessn_api_key = $_POST[ $data_field_my_lessn_api_key ];

        // Save the posted value in the database
        update_option( $opt_name_my_lessn_domain,   $opt_val_my_lessn_domain);
        update_option( $opt_name_my_lessn_api_key,  $opt_val_my_lessn_api_key);

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php } ?>

<div class="wrap">
<h2>WP Lessn Admin</h2>
<h3>Description</h3>
<p>This plugin uses Shaun Inman's Lessn to create a short URL for each new post you publish. The Lessn'd link is attached to the post meta data.</p>
<p>Lessn, according to Shaun Inman, is "an extremely simple, personal url shortener written in PHP with MySQL and mod_rewrite." If you are unfamiliar with Lessn, then this plugin will have little value to you until you read about it, download it, and install it on your own server.</p>
<p>WP Lessn was written by Jay Robinson. Please thank Shaun Inman for being awesome, not me. But <a href="mailto:jay@jayrobinson.org">email me</a> for support, not him.</p>
<ul><li>Read more about <a href="http://jwr.cc/x/2n">Lessn</a> and how to install</li><li>Find out more about the plugin, <a href="#">WP Lessn</a>, at WordPress.org</li><li>About <a href="http://shauninman.com">Shaun Inman</a></li><li>About <a href="http://jayrobinson.org">Jay Robinson</a></li></ul>

<h3>Configuration</h3>
<form action="" method="post" name="wp_lessn_form">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y" />
<p><label for="my_lessn_domain">Lessn domain <input id="my_lessn_domain" name="<?php echo $data_field_my_lessn_domain; ?>" type="text" value="<?php echo $opt_val_my_lessn_domain; ?>" size="40" /> <small>(e.g. http://yourdomain.com/lessn/-/)</small></label></p>
<p><label for="my_lessn_api_key">Lessn API key <input id="my_lessn_api_key" name="<?php echo $data_field_my_lessn_api_key; ?>" type="text" value="<?php echo $opt_val_my_lessn_api_key; ?>" size="40" /> <small>(found at http://yourdomain.com/lessn/-/)</small> </label></p>
<p><label for="wp_lessn_submit"><input id="wp_lessn_submit" name="wp_lessn_submit" type="submit" value="Save" /></label></p>
</form>
</div>

<?php }



// When a post is published, or a post with published status is updated, run my function
add_action('publish_post', 'add_test_post_meta');

// Get the post and attach new test meta data
function add_test_post_meta($post_ID) {
    
    // Let's see if the post meta already exists
    $already_lessnd_url = get_post_meta($post_ID, 'wp_lessnd_url');
    
    // If it already exists, no need to run the request
    if ( $already_lessnd_url == true ) {
            
    } else {

        // Hopefully our User will supply use with the essentials to his particular Lessn installation

        $my_lessn_domain  = get_option('my_lessn_domain');
        $my_wp_domain     = get_bloginfo('url');
        $my_lessn_api_key = get_option('my_lessn_api_key');
        
        // Build the Lessn API request URL
        $lessn_api_request = $my_lessn_domain . '?url=' . $my_wp_domain . '?p=' . $post_ID . '&api=' . $my_lessn_api_key;

        // Open the request and read the returned, Lessn'd URL
        $handle = fopen($lessn_api_request, "r");
        $wp_lessnd_url = stream_get_contents($handle);
        fclose($handle);
        
        // Add Lessn'd URL to post meta data
        add_post_meta($post_ID, 'wp_lessnd_url', $wp_lessnd_url, true); 

    }

}