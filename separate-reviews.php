
//woocommerce reviews - move out of tabs and to bottom of the product
//first remove reviews tab, with this code in your functions.php:


add_filter( 'woocommerce_product_tabs', '_remove_reviews_tab', 98 );
function _remove_reviews_tab( $tabs ) {
  unset( $tabs[ 'reviews' ] );
  return $tabs;
}

//then in the single-product.php template file, any line you want :D, call comments_template() function. 
/If you wish to have reviews tab in specific places, for example after "product tabs" and before "related products", 
/do it with hooks:

add_action( 'woocommerce_after_single_product_summary', '_show_reviews', 15 );
function _show_reviews() {
  comments_template();
}

//add this code in your content-single-product.php page to show reviews in out of the tab
<?php echo comments_template(); ?>
