
<div border="1">


 <?php
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT `post_id` FROM `wp_postmeta` WHERE `meta_key` = 'Location'" );

    foreach ( $result as $print )   {
    ?>
    <div>
  <?php 
    $post_id =  $print->post_id; 
    $result1 =  $wpdb->get_results ( "SELECT * FROM `wp_postmeta` WHERE `post_id` = $post_id " );

    foreach ( $result1 as $print1 )   {
?>  <p>
<?php 
$meta_key = $print1->meta_key ;
$meta_value = $print1->meta_value ;
$arrayName = array($meta_key => $meta_value );
//print_r($arrayName);

echo $arrayName['location'];
echo $arrayName['duration'];
echo $arrayName['price'];
echo $arrayName['max_people'];
echo $arrayName['tour_itinerary'];
/*
print_r($print1->meta_key);
print_r($print1->meta_value);*/

?></p>
<?php
    }
    ?>
    </div>
        <?php }
  ?>            


</div>
