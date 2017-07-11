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

      if($text == "สวัสดีครับ" or $text == "สวัสดีค่ะ" or $text == "สวัสดี"){
        $text = "สวัสดีค่ะ มีอะไรให้รับใช้หรือคะ :)"
      }
      elseif ($text == "มีครับ" or $text == "มีค่ะ" or $text == "มี") {
        $text = "ต้องการให้รับใช้อะไรบอกได้เลยนะค่ะ :)"
      }
      elseif ($text == "ทำอะไรได้บ้างครับ" or $text == "ทำอะไรได้บ้างคะ") {
        $text = "ตอนนี้ อุ๋ง ทำได้แค่ตอบกลับค่ะ  :)"
      }
      elseif ($text == "ใครสร้างอุ๋ง" or $text == "ใครสร้าง" $text == "ใครสร้างอุ๋งครับ" or $text == "ใครสร้างอุ๋งคะ") {
        $text = "Mr.MachMellows ค่ะ เป็นนิสิตคณะวิศวกรรมคอมพิวเเตอร์ชั้นปีที่ 3 ค่ะ"
      }
      elseif ($text == "ไม่มีครับ" or $text == "ไม่มีค่ะ" or $text == "ไม่มี" or $text == "ไม่มีอะไรครับ" or $text == "ไม่มีค่ะ") {
        $text = "ค่ะ ยินดีที่ได้รับใช้นะค่ะ มีอะให้รับใช้ก็บอกน้องอุ๋งนะค่ะ" 
      }
      elseif ($text == "กินข้าวยังครับ" or $text == "กินข้าวยังคะ" or $text == "กินไรยังคะ" or $text == "กินไรยังครับ" or $text == "หิวไหมครับ" or $text == "หิวไหมคะ") {
        $text = "น้องอุ๋งเป็น bot ค่ะ ไม่กินข้าวและ คุณกินข้าวยังค่ะ" 
      }
      elseif ($text == "กินข้าวยังครับ" or $text == "กินข้าวยังคะ" or $text == "กินไรยังคะ" or $text == "กินไรยังครับ" or $text == "หิวไหมครับ" or $text == "หิวไหมคะ") {
        $text = "น้องอุ๋งเป็น bot ค่ะ ไม่กินข้าวและ คุณกินข้าวยังค่ะ" 
      }
      elseif ($text == "ขอบคุณครับ" or $text == "ขอบคุณค่ะ" or $text == "จ้า" or $text == "อ่า" or $text == "ครับ" or $text == "ค่ะ") {
        $text = "ยินดีค่ะ :)" 
      }
      else{
        $text = "น้องอุ๋งยังเป็นเด็กยังต้องเรียนรู้อีกเยอะ บ้างเรื่องน้องอุ๋งก็ไม่เข้าใจ -.-"
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
echo "OK";
