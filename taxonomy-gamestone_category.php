<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php 

$queried_object = get_queried_object();
//print_r($queried_object);
  $term_id = $queried_object->term_id;
//echo single_cat_title();
?>

<div class="inner-banner has-base-color-overlay text-center" style="background: url(<?php echo get_bloginfo( 'template_url' ); ?>/images/background/1.jpg);">
  <div class="container">
    <div class="box">
      <h3><?php echo single_cat_title(); ?></h3>
    </div>
    <!-- /.box --> 
  </div>
  <!-- /.container --> 
</div>

<section class="our-services style-2">

<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?php //the_archive_description(); ?>
				<p>&nbsp;</p>
					
				</p>
			</div>
		</div>
	</div>
    <div class="container"> 
    <?php $s = '1'; ?>
    <?php 
// Define the query
$args = array(
    'post_type' => 'gamestone',
    'tax_query' => array(
            array(
                'taxonomy' => 'gamestone_category',
                'field' => 'term_id',
                'terms' => $term_id,
           		 )
        	   )
);
$query = new WP_Query( $args ); ?>

    <?php 
     if ($query->have_posts()) { ?>
    
    
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php if($s % 2 == 1):
            $addcl = "pull-right";
            elseif($i % 2 == 0):
            $addcl = "";
         endif;         
        ?>
    <div class="row mb50">
    <div class="gems_area">
        
        <div class="col-md-7 <?php echo $addcl; ?>">
        <div class="image_text">
        <h2><?php the_title(); ?> </h2>
        <p> <?php the_content(); ?></p>
        </div>
        </div>
                                 <div class="col-md-4  <?php echo $s++; ?>">
        <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
    <div class='carousel-outer'>
        <!-- me art lab slider -->
        <div class='carousel-inner '>
            
  <?php $i = 0;?>
          <?php if( have_rows('slider') ): ?>


	<?php while( have_rows('slider') ): the_row(); ?>
           <?php if ($i == '0'):
         $action = 'active';
         else:
         $action = '';
         endif;         
         ?>
            <div class='item <?php echo $action; ?>  <?php echo $i++; ?>'>
                <img src="<?php the_sub_field('image'); ?>" alt='' id="zoom_05"/>
            </div>   
           
                      
	<?php endwhile; ?>

<?php endif; ?>
        </div>
            
        
    </div>
    
    <!-- thumb -->
    <ol class='carousel-indicators mCustomScrollbar meartlab'>
        
  <?php $i = 0;?>
          <?php if( have_rows('slider') ): ?>


	<?php while( have_rows('slider') ): the_row(); ?>
           <?php if ($i == '0'):
         $action = 'active';
         else:
         $action = '';
         endif;         
         ?>
        <li data-target='#carousel-custom' data-slide-to='<?php echo $i++; ?>' class='<?php echo $action; ?>'><img src="<?php the_sub_field('image'); ?>" alt='' /></li>
   
	<?php endwhile; ?>

<?php endif; ?>
    </ol>
    </div>
    </div>
        
        </div>
        
    </div>
    
        <?php endwhile;
         
} // end of check for query having posts
     
// use reset postdata to restore orginal query
wp_reset_postdata();
 
?>
    
    </div>
</section>

    

<?php get_footer();
