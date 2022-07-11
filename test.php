<?php
function send_message($receiverID, $TextMessage)
{

  $curl = curl_init();
  $json_data = '{
"receiver":"' . $receiverID . '",
"min_api_version":1,
"sender":{
"name":"NameBot",
"avatar":"avatar.example.com"
},
"tracking_data":"tracking data",
"type":"text",
"text":"' . $TextMessage . '"
}
';
  $data = json_decode($json_data); // Преобразовываем в json код

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://chatapi.viber.com/pa/send_message",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($data), // отправка кода

    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Content-Type: application/JSON",
      "X-Viber-Auth-Token: 4f1e8855cca7e65d-60325f198d2a7ff7-7a252d891d901365"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}

// сообщение в viber
send_message('+380956407483', 'Привет Это бот!');

?>
