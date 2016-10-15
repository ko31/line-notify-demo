<?php
if (!(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')) {  
    header('HTTP/1.1 400 Bad Request');
    echo '400 Bad Request';
    return;
}  

$url = 'https://notify-api.line.me/api/notify';

$access_token = $_POST['access_token'];
$message = $_POST['message'];
$image = $_POST['image'];

$headers = array(
    'Authorization: Bearer '.$access_token
);

$post_data = array();
$post_data['message'] = $message;
if ($image) {
    $post_data['imageThumbnail'] = $image;
    $post_data['imageFullsize'] = $image;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
curl_close($ch);

return $result;
