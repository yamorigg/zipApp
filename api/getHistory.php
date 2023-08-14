<?php
require_once './db.php';

$dbConnection = new PDO('mysql:host=localhost;dbname=dbname;charset=utf8', 'username', 'password');
$addressModel = new Address($dbConnection);

$history = $addressModel->getHistory(); // 履歴を取得するメソッドを作成

echo $history;

?>
