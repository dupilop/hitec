<?php


function sendmessage($tokken, $to, $message)
{
    $args = http_build_query(array(
        'auth_token' => $tokken,
        'to'    => $to,
        'text'  => $message
    ));
    $url = "https://sms.aakashsms.com/sms/v3/send/";

    # Make the call using API.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1); ///
    curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Response
    $response = curl_exec($ch);
    curl_close($ch);
    // echo $response;
}

if ((isset($_POST['action'])) && $_POST['action'] == 'sendmessage') {
    unset($_POST['action']);
    $send = sendmessage('3b83171c6652431626034ba629539855a8edb93d49b058738367a07956978dda', $_POST['num'], $_POST['message']);
    echo json_encode(array("success" => true, "message" => "Message Sent Successfully", "log" => $send));
}
