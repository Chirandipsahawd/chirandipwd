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
<nav class="">
    
    <div class="menu-example-container">
<?php

$taxonomy = 'work_category';
$tax_terms = get_terms($taxonomy);
?><ul>
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
        echo '<h4>'.$custom_term->name.'</h4>';
?>
<div class="row">

<?php $i = '0'; ?>
<?php
        while($loop->have_posts()) : $loop->the_post();
?>

<div class="modal fade" id="myModal<?php echo $custom_term->slug; ?><?php echo $i++; ?>" role="dialog">
    <div class="modal-dialog" style="width: 100%;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="row">
              <div class="col-sm-6">
                <h4>Before</h4>
                <img class="img-responsive zoo" id="example" src="<?php $image = get_field('beforeimage'); echo($image['sizes']['fullimg']); ?>" alt="Example">
              </div>

              <div class="col-sm-6">
                <h4>After</h4>
                <img class="img-responsive zoo" id="example" src="<?php $image = get_field('afterimage'); echo($image['sizes']['fullimg']); ?>" alt="Example">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
        endwhile;
?>

  </div>
<div class="row">
<?php $i = '0'; ?>
<?php
        while($loop->have_posts()) : $loop->the_post();
?>


<div class="col-sm-3 text-center">
            <div class="allhov" data-toggle="modal" data-target="#myModal<?php echo $custom_term->slug; ?><?php echo $i++; ?>" >
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
