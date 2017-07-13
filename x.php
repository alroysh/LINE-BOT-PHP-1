<?php
		$content1 = file_get_contents('http://203.151.143.172/Json/gen_json1.php');
        $events1 = json_decode($content1, true);
        echo $events1['tempC'];
?>