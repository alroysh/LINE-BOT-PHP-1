<?php 

$con = file_get_contents('http://203.151.143.172/Json/gen_json1.php');
$even = json_decode($con, true);

  if(!is_null($events))
  {
    print_r($events); 
  }
 ?>
