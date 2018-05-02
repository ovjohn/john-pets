<?php 

/*
Plugin Name:  Pets
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Basic Plugin Pets
Version:      1.0
Author:       John
Author URI:   https://developer.wordpress.org/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wporg
*/


function john_pets_post_type()
{
    register_post_type('pets',
                       array(
                           'labels'      => array(
                               'name'          => __('Pet'),
                               'singular_name' => __('Pets'),
                           ),
                           'public'      => true,
                           'has_archive' => true, 
                           'show_in_menu' => true,
                       )
    );
}

add_action('init', 'john_pets_post_type');

 ?>