
<?php

// ini_set('display_errors', 1);



//1. POSTデータ取得
$media_category = $_POST['media_category'];
$media_name = $_POST['media_name'];
$media_company_name = $_POST['media_company_name'];

$id = $_POST['media_id']; // ←追加

//2. DB接続
require_once('funcs.php');
$pdo = db_connect();

//３．データ登録SQL作成

// UPDATE文にする

$stmt = $pdo->prepare('UPDATE media_table 
                            SET media_category = :media_category, 
                                media_name = :media_name, 
                                media_company_name = :media_company_name 
                            WHERE media_id = :id;' );

$stmt->bindValue(':media_category', $media_category, PDO::PARAM_STR);
$stmt->bindValue(':media_name', $media_name, PDO::PARAM_STR);
$stmt->bindValue(':media_company_name', $media_company_name, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // 数値の場合 PDO::PARAM_INT

$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: select.php');
    exit();
}

?>