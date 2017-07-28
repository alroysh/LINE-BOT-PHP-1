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
        }elseif($type == 'humidity'){
          $humidity = $value;
          
        }elseif($type == 'tempC') {
          $tempC = $value;
        
        }elseif($type == 'tempF') {
          $tempF = $value;
          
        }elseif($type == 'heatIndexC') {
          $heatIndexC = $value;
         
        }elseif($type == 'heatIndexF') {
          $heatIndexF = $value;
          
        }elseif($type == 'datetime') {
          $datetime = $value;
          
        } 
    }  
}

if (!is_null($events['events'])) {

  foreach ($events['events'] as $event) {

      if (isset($event['displayName'])) {
        $name = $event['displayName'];
      }
      elseif ($event['type'] == 'message' && $event['message']['type'] == 'text'){

      $text = $event['message']['text'];
      ///$name = $event['displayName'];

      if ($text == "สวัสดี" or $text == "สวัสดีอุ๋งๆ"){
        $text = $text."คุณ".$name."\nมีอะไรให้รับใช้หรอค่ะ :) \n สอบถามสภาพอากาศ \n - อุณหภูมิ \n - ความชิ้น";
      }elseif($text == "ความชื้น"){
        $text = "ความชื้นตอนนี้จะอยู่ที่ ".$humidity." ค่ะ";
      }elseif ($text == "อุณหภูมิ"){
        $text = "อุณหภูมิ ตอนนี้จะอยู่ที่ ".$tempC." (°C) ค่ะ และ ".$tempF." (°F) ค่ะ\n - ค่าเฉลี่ยจะอยู่ที่ ".$heatIndexC." (°C) ค่ะ และ ".$heatIndexF." (°F) ค่ะ\n อับเดจล่าสุดเมื่อวันที่ ".$datetime." ค่ะ";
      }elseif ($text == "tempC"){
        $text = $tempC;
      }elseif ($text == "tempF"){
        $text = $tempF;
      }elseif ($text == "IndexC"){
        $text = $heatIndexC;
      }elseif ($text == "IndexF"){
        $text = $heatIndexF;
      }elseif ($text == "datetime") {
        $text = $datetime;
      }else if($text == "ใครสร้างอุ๋งๆ"){
        $text ="อุ๋งๆ ถูกสร้างโดย mr.mach ค่ะ";
      }else{
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

}
echo "sucess full";

