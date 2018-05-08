<?php 

/*
Plugin Name:  Pets
Plugin URI:   https://github.com/ovjohn/john-pets
Description:  Basic Plugin Pets
Version:      1.0
Author:       John
Author URI:   https://github.com/ovjohn/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  john
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

//Function for display last 5 entries of this custom post-type
function search_filter($query) {
  
    if($query->get('post_type') == 'pets'){
   	
   	$query->set('posts_per_page',5);
  }
  return $query;
}

add_action('pre_get_posts','search_filter');


//Funcion que permite crear una Taxonomia personalizada
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
'hierarchical'      => true, 
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => ['slug' => 'category_pets'],
];
register_taxonomy('category_pets', ['pets'], $args);
}
add_action('init', 'john_pets_register_taxonomy');


//Funcion que filtra la asociacion de etiquetas
function john_pets_save_post( $post_id, $post ) {

	$post_type = get_post_type($post_id);
	$error = false;

	if ($post_type === 'pets' && get_post_status( $post_id ) === 'publish' ) {

		$terms = get_the_terms( $post_id, 'category_pets'); 
		  
        
		if ($terms) {
			foreach ($terms as $term) {
			
						
				if (substr($term->name, 0, 5)   != 'Pets-') {
					$error = true;
				}
			}
		}else{
				$error = true;
		}
			
		
		if ($error) {
	
				$post->post_status = 'draft';

				wp_update_post( $post, $error );

				wp_die('Please enter a category that starts with the prefix "Pets-"'. '<a href="'.get_edit_post_link($post_id) . '"><br>Click here to go to edit</a>');
			
			}
	}
}

add_action( 'save_post', 'john_pets_save_post' , 10, 2);

?>

