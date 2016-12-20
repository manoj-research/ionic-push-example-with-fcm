<?php
	header('Content-Type: text/html; charset=utf-8');
	error_reporting(E_ALL);

    require 'simple_html_dom.php';
	
	$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

	//API Key(KEY) obtain in Firebase Console (!!!!Replace with Firebase Cloud Messaging Token!!!! instead API KEY)
    //https://console.firebase.google.com/project/<your_project_id>/settings/cloudmessaging
    $apiKey='<YOUR_FIREBASE_CLOUD MESSAGING TOKEN_VALUE_REPLACE>';

	$ids = array();

    /***************************************************
    READ TOKENS FROM SERVER OR ADD MANUALLY TOKENS
    ****************************************************/

    /*
    FROM SERVER
    $string = file_get_html(".../get_token.php");
    $json_a=json_decode($string,true);
    $tokens_list = $json_a[0]["tokens"];*/

    //MANUALLY
	array_push($ids, "<TOKEN(S)>");
	
    $message = $description;

    $messages_to_send = array();

    //Add all messages receive by Backend Push notifications panel
    foreach ($messages as $message) {
        array_push($messages_to_send, array("html"=>$message->htmlmsg, "img"=>$message->image, "source"=>$message->source, "app_message"=>$message->app_message));
    }

    /*Notification content (important to add 'data' and 'notification'. In notification ALWAYS all title, body and in data add custom values with want*/
    
	$fields = array(
		'registration_ids' => $ids,
        'data' => array('news'=>$messages_to_send, 'action' => 1, 'desc_msg' => 'Notification Example', 'type' => $type),
        'notification' => array("title"=>$title,  //Any value
                "body"=>$description,  //Any value
                "sound"=>"default", //If you want notification sound
                "click_action"=>"FCM_PLUGIN_ACTIVITY",  //Must be present for Android
                "icon"=>"fcm_push_icon"  //White icon Android resource);
    ));

    $headers = array(
        'Authorization:key=' . $apiKey,
        'Content-Type:application/json'
    );		
	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    //echo ($result);
   
    curl_close($ch);

    echo json_encode( $fields );

	
?>