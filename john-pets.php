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
                               'name'          => __('Pets'),
                               'singular_name' => __('Pets'),
                           ),
                           'public'      => true,
                           'has_archive' => true, 
                           'show_in_menu' => true,
                       )
    );
}

add_action('init', 'john_pets_post_type');

//Funtion que permite filtrar solo 5 post...++++++++++++++++++++++++++++++++++++++++++++++++++++
function search_filter($query) {
  
  //echo var_dump($query);
  //print_r($query);
   if($query->get('post_type') == 'pets'){
   	
   	$query->set('posts_per_page',3);
  }
  return $query;
}

add_action('pre_get_posts','search_filter');

//Funcion que permite crear una Taxonomia personalizada++++++++++++++++++++++++++++++++++++++++++

function john_pets_register_taxonomy()
{
    $labels = [
        'name'              => _x(' Category Pets', 'taxonomy general name'),
'singular_name'     => _x('Category Pet', 'taxonomy singular name'),
'search_items'      => __('Search Pets'),
'all_items'         => __('All Pets'),
'parent_item'       => __('Parent Pet'),
'parent_item_colon' => __('Parent Pet:'),
'edit_item'         => __('Edit Pet'),
'update_item'       => __('Update Pet'),
'add_new_item'      => __('Add New Pet'),
'new_item_name'     => __('New Pet Name'),
'menu_name'         => __('Category Pet'),
];
$args = [
'hierarchical'      => true, // make it hierarchical (like categories)
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => ['slug' => 'Pet'],
];
register_taxonomy('pet', ['pets'], $args);
}
add_action('init', 'john_pets_register_taxonomy');

 ?>