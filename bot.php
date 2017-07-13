<?php
$access_token = '3YxSOfQKva9QC3/swCvMwJwJkdnmbiENnLvM5Qf1tF78RW2z5MZGrNnvH+CapO9xmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb/EqYvnqU2ZkJt2r3n/2+fcLspZqwyf0TJ7EdYGr8TwwAdB04t89/1O/w1cDnyilFU=';


$content = file_get_contents('php://input');
$events = json_decode($content, true);


if (!is_null($events['events'])) {

  foreach ($events['events'] as $event) {

    if ($event['type'] == 'message' && $event['message']['type'] == 'text'){

      $text = $event['message']['text'];

      if($text == "สวัสดี")
      {

        $text = "อิอิ";
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

