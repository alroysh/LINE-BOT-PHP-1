<?php
  $access_token = '3YxSOfQKva9QC3/swCvMwJwJkdnmbiENnLvM5Qf1tF78RW2z5MZGrNnvH+CapO9xmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb/EqYvnqU2ZkJt2r3n/2+fcLspZqwyf0TJ7EdYGr8TwwAdB04t89/1O/w1cDnyilFU=';

 
  $userId ='U00e6d214ca004d0cc011f7924abd6a13';

  function getname($name,$access_token,$userId){

    $url = 'https://api.line.me/v2/bot/profile/'.$userId;

    $headers = array('Authorization: Bearer ' . $access_token);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }

  $result = getname($name,$access_token,$userId);
  $json = json_decode($result,TRUE);
  print_r($json);

  if(!is_null($json['displayName'])){

    foreach ($json as $type => $value){

       if($type == 'displayName'){
          $name = $value;
          echo "$name\n";
        }
        elseif ($type == 'userId') {
          $userId = $value;
          echo "$userId\n";
        }
    }

  }

