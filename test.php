<?php 
	header("Content-type:application/json; charset=UTF-8");    
    header("Cache-Control: no-store, no-cache, must-revalidate");         
    header("Cache-Control: post-check=0, pre-check=0", false); 
	$content = file_get_contents('http://203.151.143.172/Json/gen_json1.php');
    $result = json_decode($content, true);
    
    //print_r($result);

    if(isset($result)){  
        $json = json_encode($result); 
        echo $json;
    }
     
 ?>
