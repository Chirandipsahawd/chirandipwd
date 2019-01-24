<?php

/*
Template Name: Example Page
*/
get_header();
?>

<div class="inner-page-header">
<div class="container">
<div class="row">
	<div class="entry-header">
	 <h2 class="entry-title">Examples</h2>
	</div><!-- .entry-header -->

</div>
</div>
</div>


<div class="services-top-section">
<div class="container">
<!-- <div class="row"> -->
<nav class="navbar navbar-default">
    
    <div class="menu-example-container">
<?php

$taxonomy = 'work_category';
$tax_terms = get_terms($taxonomy);
?><ul id="price-menu" class="nav navbar-nav">
<li><a href="http://royalfixphoto.com/examples/">All</a></li><?php
foreach ($tax_terms as $tax_term) {
echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
}
?>
</ul></div>   </nav>     
<!-- </div> -->

</div>
</div>

	



<?php


$custom_terms = get_terms('work_category');

foreach($custom_terms as $custom_term) {
    wp_reset_query();
    $args = array('post_type' => 'work',
        'tax_query' => array(
            array(
                'taxonomy' => 'work_category',
                'field' => 'slug',
                'terms' => $custom_term->slug,
            ),
        ),
     );
?>
<?php
     $loop = new WP_Query($args);
     if($loop->have_posts()) {
?>

<div class="allumg">
<div class="container">
<?php
        echo '<h2>'.$custom_term->name.'</h2>';
?>
<div class="row">
<?php
        while($loop->have_posts()) : $loop->the_post();
?>

<div class="col-sm-3 text-center">
            <div class="allhov" data-toggle="modal" data-target="#myModal<?php echo $i++; ?>" >
              <img src="<?php $image = get_field('afterimage'); echo($image['sizes']['exmplimage']); ?>" alt="thumb" class="img-responsive">
              <div class="inner_msg">Click to see Before &amp; After</div>
            </div>
          </div>
<?php
        endwhile;
?>
</div>
</div>
</div>
<?php     }
}
?>



<?php get_footer(); ?>
