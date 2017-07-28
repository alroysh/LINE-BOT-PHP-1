<?php
  $access_token = '3YxSOfQKva9QC3/swCvMwJwJkdnmbiENnLvM5Qf1tF78RW2z5MZGrNnvH+CapO9xmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb/EqYvnqU2ZkJt2r3n/2+fcLspZqwyf0TJ7EdYGr8TwwAdB04t89/1O/w1cDnyilFU=';

  function getname($name,$access_token)
  {
    $url = 'https://api.line.me/v2/bot/profile/U00e6d214ca004d0cc011f7924abd6a13';

    $headers = array('Authorization: Bearer ' . $access_token);


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }

  $result = getname($name,$access_token);

  $json = json_decode($result,TRUE);
  //print_r($result);

  if(!is_null($json['displayName'])){

    foreach ($json as $type => $value) 
    {

        echo "\$datas[$type] => $value.\n";
    }

  }

