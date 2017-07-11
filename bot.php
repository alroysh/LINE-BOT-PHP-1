<?php
$access_token = 'ncuzBPrsITjy6Rl9nUii1378IHzek1stjnsXQc8JKR1X9KVdgCBcZo4R05UeoONDmv9uYCdUUpYuo/MtK5hyYYTlIBVfBxBzhRxMFQwSjb+nhx0/yzhm2pvZonf/VFxAyHnj5m4e1oF/b8I/RCZqwAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
  // Loop through each event
  foreach ($events['events'] as $event) {
    // Reply only when message sent is in 'text' format
    if ($event['type'] == 'message' && $event['message']['type'] == 'text'){
      // Get text sent
      $text = $event['message']['text'];

      if($text == "สวัสดีครับ" or $text == "สวัสดีค่ะ" or $text == "ดีครับ" or $text == "ดีค่ะ" or $text == "ดี" ){
        $text = "สวัสดี ค่ะ มีอะไรให้รับใช้หรอคะ :)";
      }
      elseif ($text == "ป่าว" or $text == "เปล่า" or $text == "ไม่มีอะไร"){
        $text = "ยินดีที่ได้รับใช้ค่ะ :)";
      }
      elseif ($text == "ชื่อไร" or $text == "มีชื่อไหม" or $text == "ชื่อ") {
        $text = "ฉันชื่อ Mark I ฉันถูกสร้างโดย mr.capsLock ค่ะ ";
      }
      elseif ($text == "ทำไรได้บ้าง" or $text == "ทำไรได้" or $text == "ทำไรเป็น"){
        $text = "ตอนนี้ mr.capsLock กำลังพัฒนาให้ ฉันมีความสามารถตอบโต้กลับได้อย่างเดียวค่ะ";
      }
      elseif ($text == "ขอบคุณ" or $text == "แต็งกิว" or $text == "ขอบใจ"){
        $text = "ยินดีค่ะ ค่ะ";
      }
      elseif ($text == "ครับ" or $text == "ค่ะ" or $text == "คะ"  or $text == "อ่า"  or $text == "อื้ม"  or $text == "จ้ะ"  or $text == "จ่ะ"){
        $text = "ค่ะ :)";
      }
      else{
        $text = "ขอเวลาเรียนรู้ก่อนนะค่ะ ฉันยังไม่เข้าใจ";
      }

      // Get replyToken
      $replyToken = $event['replyToken'];
      // Build message to reply back
      $messages = [
        'type' => 'text',
        'text' => $text
      ];
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
elseif (is_null($events['events'])) {
  foreach ($events['events'] as $event) {
    // Reply only when message sent is in 'text' format
    if ($event['type'] == 'image' && $event['message']['type'] == 'image'){
      // Get text sent
      $text = $event['image']['id'];

      // Get replyToken
      $replyToken = $event['replyToken'];
      // Build message to reply back
      $messages = [
        'type' => 'id',
        'id' => $text
      ];
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
elseif (is_null($events['events'])) {
  foreach ($events['events'] as $event) {
    // Reply only when message sent is in 'text' format
    if ($event['type'] == 'sticker' && $event['message']['type'] == 'sticker'){
      // Get text sent
      $text = $event['sticker']['stickerId'];

      // Get replyToken
      $replyToken = $event['replyToken'];
      // Build message to reply back
      $messages = [
        'type' => 'stickerId',
        'stickerId' => $text
      ];
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
echo "OK";
