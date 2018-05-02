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

//Funtion que permite filtrar solo 5 post...
function search_filter($query) {
  
  //echo var_dump($query);
  //print_r($query);
   if($query->get('post_type') == 'pets'){
   	
   	$query->set('posts_per_page',3);
  }
  return $query;
}

add_action('pre_get_posts','search_filter');

 ?>