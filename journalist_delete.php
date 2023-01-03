<?php
//1.対象のIDを取得
// GETで取得するので、GETに書き換え
$id = $_GET['id']; 

//2. DB接続
require_once('funcs.php');
$pdo = db_connect();

//３．データ登録SQL作成

$stmt = $pdo->prepare('DELETE FROM journalist_table WHERE journalist_id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: journalist_select.php');
    exit();
}

?>