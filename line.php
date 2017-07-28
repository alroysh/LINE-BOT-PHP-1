<?php 

	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('3YxSOfQKva9QC3/swCvMwJwJkdnmbiENnLvM5Qf1tF78RW2z5MZGrNnvH+CapO9xmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb/EqYvnqU2ZkJt2r3n/2+fcLspZqwyf0TJ7EdYGr8TwwAdB04t89/1O/w1cDnyilFU=');
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'b782d7f297d72919e4c41762ab510b58']);
	$response = $bot->getProfile('U00e6d214ca004d0cc011f7924abd6a13');
	if ($response->isSucceeded()) {
	    $profile = $response->getJSONDecodedBody();
	    echo $profile['displayName'];
	    echo $profile['pictureUrl'];
	    echo $profile['statusMessage'];
	} 

?>