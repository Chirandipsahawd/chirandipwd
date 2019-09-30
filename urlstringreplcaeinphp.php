
$link  = 'http://www.johnsonsgaragedoor.com/Twin%20Cities';
//print_r(explode('/',$link,5));
  echo '<br/>';
$count = explode('/',$link,5);
//echo $count; 
 // echo '<br/>';
$newlink =  array_pop($count);
//echo $newlink; 

 // echo '<br/>';

$newuri = str_replace("$newlink","",$link);
//echo $newuri;
  
  if ($newuri === 'http://www.johnsonsgaragedoor.com/garage-door-replacement/'){
    echo '<title>garage-door-replacement</title>';
  }elseif ($newuri === 'http://www.johnsonsgaragedoor.com/'){
echo '<title>Home</title>';
  }
