// woocommerce  theme support

add_action( 'after_setup_theme', 'setup_woocommerce_support' );

 function setup_woocommerce_support()
{
  add_theme_support('woocommerce');
}

// remove default sorting dropdown
 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );



//register custom post type like gamestone

register_post_type('gamestone', array(	'label' => 'Gamestones','description' => 'This is the Gamestones section','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes',),'labels' => array (
  'name' => 'Gamestones',
  'singular_name' => 'Gamestone',
  'menu_name' => 'Gamestones',
  'add_new' => 'Add Gamestone',
  'add_new_item' => 'Add New Gamestone',
  'edit' => 'Edit',
  'edit_item' => 'Edit Gamestone',
  'new_item' => 'New Gamestone',
  'view' => 'View Gamestone',
  'view_item' => 'View Gamestone',
  'search_items' => 'Search Gamestone',
  'not_found' => 'No Gamestones Found',
  'not_found_in_trash' => 'No Gamestones Found in Trash',
  'parent' => 'Parent Gamestone',
  
),) );
//register custom taxonomy like gamestone
register_taxonomy( 'gamestone_category', 'gamestone', array( 'hierarchical' => true, 'label' => 'Gamestone Categories', 'query_var' => true, 'rewrite' => true ) );

