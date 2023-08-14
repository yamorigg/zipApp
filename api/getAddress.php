<?php

require_once './db.php';
$zipCode = $_POST['zipCode'];
if($zipCode==='') {
    echo 'Error:郵便番号が入力されていません';
    exit;
}
$zipCode = mb_convert_kana($zipCode, 'a');
$zipCode = preg_replace('/[^0-9]/', '', $zipCode);
if (!preg_match("/^[0-9]{7}$/", $zipCode)) {
    echo 'Error:郵便番号は半角数字7桁で入力してください'. $zipCode;
    exit;
}
$address = fetchFromAPI($zipCode); 
if($address===null) {
    echo 'Error:該当するデータが見つかりませんでした';
    exit;
}

// DB接続設定
$dbConnection = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'username', 'password');
$addressModel = new Address($dbConnection);

// 郵便番号API
$addressModel->save($zipCode, $address);

echo $address;

function fetchFromAPI($zipCode) {
    $appId =""; // Yahoo!デベロッパーで取得したアプリケーションIDを入力
    $url = 'https://map.yahooapis.jp/search/zip/V1/zipCodeSearch?query=' . $zipCode . '&results=1&appid=' . $appId .'&output=json';
    $response = file_get_contents($url);
    $response = json_decode($response);
    $address = $response->Feature[0]->Property->Address;
    return $address;
}
?>

