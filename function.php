function add_extra_woocommerce_shipping_rate_cost( $rates, $method ) {
    /* let's assume its applicable for flat rate and local pickup
     * And instance id for flat rate = 12
     * And instance id for local pickup = 14 
     * 
     */

//       $data_store = WC_Data_Store::load( 'shipping-zone' );
//    $raw_zones = $data_store->get_zones();
//    foreach ( $raw_zones as $raw_zone ) {
//       $zones[] = new WC_Shipping_Zone( $raw_zone );
//    }

//print_r($raw_zones);
     $product_category_id = array( 16,17 ); // applicable categories
        $product_category_id_check = false;
        $items = WC()->cart->get_cart();
        foreach( $items as $item => $values ) { 
            $product_cats_ids = wp_get_post_terms($values['data']->get_id(),'product_cat',array('fields'=>'ids'));
            //print_r($product_cats_ids);
            foreach ( $product_cats_ids as $id ) {
                if( in_array( $id, $product_category_id ) ) 
                    $product_category_id_check = true;
                    $WC_Shipping_Zone = new WC_Shipping_Zone();
                    $rates = $WC_Shipping_Zone->set_zone_name( "All" );
                
//print_r($WC_Shipping_Zone);
            // foreach ( $rates as $rate_key => $rate ) {
            //     // Unset
            //     unset( $rates[$rate_key] );
            // }
            
            }
        }
//      $data_store = WC_Data_Store::load( 'shipping-zone' );
//    $raw_zones = $data_store->get_zones();
//    foreach ( $raw_zones as $raw_zone ) {
//       $zones[] = new WC_Shipping_Zone( $raw_zone );
//    }
    // if ( in_array( $zone_id, array( 1) ) && WC()->cart ) {
    //     // if ( get_field( 'multiplier', 'option' ) ) :
    //     //     $multiplier = get_field( 'multiplier', 'option' );
    //     // else :
    //     //     $multiplier = 1;
    //     // endif;
    //     $multiplier = 3;

    //     $product_category_id = array( 16,17 ); // applicable categories
    //     $product_category_id_check = false;
    //     $items = WC()->cart->get_cart();
    //     foreach( $items as $item => $values ) { 
    //         $product_cats_ids = wp_get_post_terms($values['data']->get_id(),'product_cat',array('fields'=>'ids'));
    //         foreach ( $product_cats_ids as $id ) {
    //             if( in_array( $id, $product_category_id ) ) 
    //                 $product_category_id_check = true;
    //         }
    //     }
    //     if( $product_category_id_check ){
    //         $cost = $cost * 3;
    //     }
    // }
     return $rates;
}
add_filter( 'woocommerce_package_rates', 'add_extra_woocommerce_shipping_rate_cost', 99, 2 );


function add_extra_woocommerce_shipping_rate_cost( $rates, $method ) {
    $product_category_id = array( 16,17 ); // applicable categories
       $product_category_id_check = false;
       $items = WC()->cart->get_cart();
       foreach( $items as $item => $values ) { 
           $product_cats_ids = wp_get_post_terms($values['data']->get_id(),'product_cat',array('fields'=>'ids'));
           print_r($product_cats_ids);
           foreach ( $product_cats_ids as $id ) {
               if( in_array( $id, $product_category_id ) ) 
                   $product_category_id_check = true;
                   $WC_Shipping_Zone = new WC_Shipping_Zone();
                   $rates = $WC_Shipping_Zone->set_zone_locations( "All" );
                }
            
            }
            return $rates;
        }
// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '/';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';
           
    }
       
}





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




/*==================================product count drtopdown========================================================*/
// Lets create the function to house our form

function woocommerce_catalog_page_ordering() {
?>
<?php echo '<span class="itemsorder">Items Per Page:' ?>
    <form action="" method="POST" name="results" class="woocommerce-ordering">
    <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
<?php
 
//Get products on page reload
if  (isset($_POST['woocommerce-sort-by-columns']) && (($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns']))) {
        $numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
          } else {
        $numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
          }
 
//  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
			$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
			//Add as many of these as you like, -1 shows all products per page
			  //  ''       => __('Results per page', 'woocommerce'),
				'10' 		=> __('10', 'woocommerce'),
				'20' 		=> __('20', 'woocommerce'),
				'-1' 		=> __('All', 'woocommerce'),
			));

		foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
			echo '<option value="' . $sort_id . '" ' . selected( $numberOfProductsPerPage, $sort_id, true ) . ' >' . $sort_name . '</option>';
?>
</select>
</form>

<?php echo ' </span>' ?>
<?php
}
 
// now we set our cookie if we need to
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'www.your-domain-goes-here.com', false); //this will fail if any part of page has been output- hope this works!
    $count = $_POST['woocommerce-sort-by-columns'];
  }
  // else normal page load and no cookie
  return $count;
}
 
add_filter('loop_shop_per_page','dl_sort_by_page');
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_page_ordering', 20 );

/*=================================================procduct dropdown counter end===============================================*/



/**
 * Add the product's short description (excerpt) to the WooCommerce shop/category pages. The description displays after the product's name, but before the product's price.
 *
 * Ref: https://gist.github.com/om4james/9883140
 *
 * Put this snippet into a child theme's functions.php file
 */
function woocommerce_after_shop_loop_item_title_short_description() {
	global $product;
	if ( ! $product->post->post_excerpt ) return;
	?>
	<div itemprop="description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
	</div>
	<?php
}
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);


//I had to use echo $product->get_short_description() instead:



// Display custom field on single product page
function d_extra_product_field(){
    $value = isset( $_POST['extra_product_field'] ) ? sanitize_text_field( $_POST['extra_product_field'] ) : '';
    printf( '<label>%s</label><input name="extra_product_field" value="%s" />', __( 'Enter your custom text' ), esc_attr( $value ) );
    $value1 = isset( $_POST['extra_product_field_select'] ) ? sanitize_text_field( $_POST['extra_product_field_select'] ) : '';
	printf( '<label>%s</label><select name="extra_product_field_select"><option value="">--select</option><option value="legend2">Legend2</option><option value="legend1">Legend1</option></select>', __( 'select your custom text' ), esc_attr( $value ) );
}
add_action( 'woocommerce_after_add_to_cart_button', 'd_extra_product_field', 9 );

// validate when add to cart
function d_extra_field_validation($passed, $product_id, $qty){

    if( isset( $_POST['extra_product_field'] ) && sanitize_text_field( $_POST['extra_product_field'] ) == '' ){
        $product = wc_get_product( $product_id );
        wc_add_notice( sprintf( __( '%s cannot be added to the cart until you enter some text.' ), $product->get_title() ), 'error' );
        return false;
    }
    if( isset( $_POST['extra_product_field_select'] ) && sanitize_text_field( $_POST['extra_product_field_select'] ) == '' ){
        $product = wc_get_product( $product_id );
        wc_add_notice( sprintf( __( '%s cannot be added to the cart until Selects some text.' ), $product->get_title() ), 'error' );
        return false;
    }

    return $passed;

}
add_filter( 'woocommerce_add_to_cart_validation', 'd_extra_field_validation', 10, 3 );

 // add custom field data in to cart
function d_add_cart_item_data( $cart_item, $product_id ){

    if( isset( $_POST['extra_product_field'] ) ) {
        $cart_item['extra_product_field'] = sanitize_text_field( $_POST['extra_product_field'] );
    }
    return $cart_item;

}
add_filter( 'woocommerce_add_cart_item_data', 'd_add_cart_item_data', 10, 2 );


 // add custom field data in to cart extra_product_field_select
 function d_add_cart_item_data_select( $cart_item1, $product_id ){

    if( isset( $_POST['extra_product_field_select'] ) ) {
        $cart_item1['extra_product_field_select'] = sanitize_text_field( $_POST['extra_product_field_select'] );
    }
    return $cart_item1;

}
add_filter( 'woocommerce_add_cart_item_data', 'd_add_cart_item_data_select', 10, 2 );


// load data from session
function d_get_cart_data_f_session( $cart_item, $values ) {

    if ( isset( $values['extra_product_field'] ) ){
        $cart_item['extra_product_field'] = $values['extra_product_field'];
    }

    return $cart_item;

}
add_filter( 'woocommerce_get_cart_item_from_session', 'd_get_cart_data_f_session', 20, 2 );


// load data from session select
function d_get_cart_data_f_session_select( $cart_item1, $values1 ) {

    if ( isset( $values1['extra_product_field_select'] ) ){
        $cart_item1['extra_product_field_select'] = $values1['extra_product_field_select'];
    }

    return $cart_item1;

}
add_filter( 'woocommerce_get_cart_item_from_session', 'd_get_cart_data_f_session_select', 20, 2 );


//add meta to order
function d_add_order_meta( $item_id, $values ) {

    if ( ! empty( $values['extra_product_field'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'extra_product_field', $values['extra_product_field'] );           
    }
}
add_action( 'woocommerce_add_order_item_meta', 'd_add_order_meta', 10, 2 );


//add meta to order select
function d_add_order_meta_select( $item_id, $values1 ) {

    if ( ! empty( $values1['extra_product_field_select'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'extra_product_field', $values1['extra_product_field_select'] );           
    }
}
add_action( 'woocommerce_add_order_item_meta', 'd_add_order_meta_select', 10, 2 );

// display data in cart
function d_get_itemdata( $other_data, $cart_item ) {

    if ( isset( $cart_item['extra_product_field'] ) ){

        $other_data[] = array(
            'name' => __( 'Your extra field text' ),
            'value' => sanitize_text_field( $cart_item['extra_product_field'] )
        );

    }

    return $other_data;

}
add_filter( 'woocommerce_get_item_data', 'd_get_itemdata', 10, 2 );


// display data in cart select
function d_get_itemdata_select( $other_data1, $cart_item1 ) {

    if ( isset( $cart_item1['extra_product_field_select'] ) ){

        $other_data1[] = array(
            'name' => __( 'Your extra field text' ),
            'value' => sanitize_text_field( $cart_item1['extra_product_field_select'] )
        );

    }

    return $other_data1;

}
add_filter( 'woocommerce_get_item_data', 'd_get_itemdata_select', 10, 2 );

// display custom field data in order view
function d_dis_metadata_order( $cart_item, $order_item ){

    if( isset( $order_item['extra_product_field'] ) ){
        $cart_item_meta['extra_product_field'] = $order_item['extra_product_field'];
    }

    return $cart_item;

}
add_filter( 'woocommerce_order_item_product', 'd_dis_metadata_order', 10, 2 );


// display custom field data in order view extra_product_field_select
function d_dis_metadata_order_select( $cart_item1, $order_item1 ){

    if( isset( $order_item1['extra_product_field_select'] ) ){
        $cart_item_meta1['extra_product_field_select'] = $order_item1['extra_product_field_select'];
    }

    return $cart_item1;

}
add_filter( 'woocommerce_order_item_product', 'd_dis_metadata_order_select', 10, 2 );


// add field data in email
function d_order_email_data( $fields ) { 
    $fields['extra_product_field'] = __( 'Your extra field text' ); 
    return $fields; 
} 
add_filter('woocommerce_email_order_meta_fields', 'd_order_email_data');


// add field data in email select
function d_order_email_data_select( $fields ) { 
    $fields['extra_product_field_select'] = __( 'Your extra field text' ); 
    return $fields; 
} 
add_filter('woocommerce_email_order_meta_fields', 'd_order_email_data_select');

// again order
function d_order_again_meta_data( $cart_item, $order_item, $order ){

    if( isset( $order_item['extra_product_field'] ) ){
        $cart_item_meta['extra_product_field'] = $order_item['extra_product_field'];
    }

    return $cart_item;

}
add_filter( 'woocommerce_order_again_cart_item_data', 'd_order_again_meta_data', 10, 3 );

// again order
function d_order_again_meta_data_select( $cart_item1, $order_item1, $order ){

    if( isset( $order_item1['extra_product_field_select'] ) ){
        $cart_item_meta1['extra_product_field_select'] = $order_item1['extra_product_field_select'];
    }

    return $cart_item1;

}
add_filter( 'woocommerce_order_again_cart_item_data', 'd_order_again_meta_data_select', 10, 3 );




add_filter( 'woocommerce_product_get_price', 'custom_discount_price', 10, 2 );
add_filter( 'woocommerce_product_variation_get_price', 'custom_discount_price', 10, 2 );
function custom_discount_price( $price, $product ) {
    // For logged in users
    if ( is_user_logged_in() ) {
		if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
        $discount_rate = 0.95; // 10% of discount
        
        // Product is on sale
        if ( $product->is_on_sale() ) { 
            // return the smallest price value between on sale price and custom discounted price
            return min( $price, ( $product->get_regular_price() * $discount_rate ) );
        }
        // Product is not on sale
        else {
            // Returns the custom discounted price
            return $price * $discount_rate;
        }
    }
}
    return $price;
}

add_action( 'woocommerce_single_product_summary', 'ts_you_save', 11 );
function ts_you_save() {
	global $product;
	
    if ( is_user_logged_in() ) {
	 if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
		?>
		<p style="font-size:24px;color:red;"><b>You Save: 5%</b></p>                
		<?php   
	 }
	}
}
