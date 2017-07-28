<?php
$access_token = '3YxSOfQKva9QC3/swCvMwJwJkdnmbiENnLvM5Qf1tF78RW2z5MZGrNnvH+CapO9xmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb/EqYvnqU2ZkJt2r3n/2+fcLspZqwyf0TJ7EdYGr8TwwAdB04t89/1O/w1cDnyilFU=';


$content = file_get_contents('php://input');
$events = json_decode($content, true);

$database = file_get_contents('https://4c3012f4.ngrok.io/code/node/jsontoline.php');
$datas = json_decode($database, true);

if (!is_null($datas['id'])) {

    //print_r($datas); 
    foreach ($datas as $type => $value) {
        //echo "$type => $value\n";
        if($type == 'id'){
          $id = $value;
          //echo "$id\n";
        }
        elseif($type == 'humidity'){
          $humidity = $value;
          //echo "$humidity\n";
        }
        elseif($type == 'tempC') {
          $tempC = $value;
         // echo "$tempC\n";
        }
        elseif($type == 'tempF') {
          $tempF = $value;
          //echo "$tempF\n";
        }
        elseif($type == 'heatIndexC') {
          $heatIndexC = $value;
          //echo "$heatIndexC\n";
        }
        elseif($type == 'heatIndexF') {
          $heatIndexF = $value;
          //echo "$heatIndexF\n";
        }
        elseif($type == 'datetime') {
          $datetime = $value;
          //echo "$datetime\n";
        } 
    }  
}

if (!is_null($events['events'])) {

  foreach ($events['events'] as $event) {

    if ($event['type'] == 'message' && $event['message']['type'] == 'text'){

      $text = $event['message']['text'];

      if($text == "ความชื้น")
      {
        $text = $humidity;
      }
      elseif ($text == "tempC") 
      {
        $text = $tempC;
      }
      elseif ($text == "tempF") 
      {
        $text = $tempF;
      }
      elseif ($text == "IndexC") 
      {
        $text = $heatIndexC;
      }
      elseif ($text == "IndexF") 
      {
        $text = $heatIndexF;
      }
      elseif ($text == "datetime") 
      {
        $text = $datetime;
      }
      else if($text == "ใครสร้างอุ๋งๆ")
      {
        $text ="อุ๋งๆ ถูกสร้างโดย mr.mach ค่ะ";
      }
      else
      {
        $text = "ขอเวลาเรียนรู้ก่อนนะค่ะ";
      }
      $replyToken = $event['replyToken'];
      $messages = [
        'type' => 'text',
        'text' => $text
      ];
    }
    elseif ($event['type'] == 'message' && $event['message']['type'] == 'sticker'){

      $id = $event['message']['id'];
      $stickerId = $event['message']['stickerId'];
      $packageId = $event['message']['packageId'];

      $replyToken = $event['replyToken'];
      $messages = [
        'type' => 'sticker',
        'id' => $id,
        'stickerId' => $stickerId,
        'packageId' => $packageId      
      ];
    
    }
     // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/reply';
      $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages],
      ];
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n";
  }

}
echo "sucess full";

