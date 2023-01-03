<?php

//1. POSTデータ取得
$media_name = $_POST['media_name'];
$name = $_POST['name'];
$department = $_POST['department'];
$title = $_POST['title'];
$priority = $_POST['priority'];
$status = $_POST['status'];
$email = $_POST['email'];
$facebook = $_POST['facebook'];
$tel_mobile = $_POST['tel_mobile'];
$approach_preferred = $_POST['approach_preferred'];

$id = $_POST['journalist_id']; // ←追加

//2. DB接続
require_once('funcs.php');
$pdo = db_connect();

//３．データ登録SQL作成

// UPDATE文にする

$stmt = $pdo->prepare('UPDATE journalist_table
                            SET media_name = :media_name, 
                                name = :name,
                                department = :department, 
                                title = :title, 
                                status = :status, 
                                priority = :priority, 
                                email = :email, 
                                facebook = :facebook, 
                                tel_mobile = :tel_mobile, 
                                approach_preferred = :approach_preferred
                            WHERE journalist_id = :id;' );

$stmt->bindValue(':media_name', $media_name, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':department', $department, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':facebook', $facebook, PDO::PARAM_STR);
$stmt->bindValue(':tel_mobile', $tel_mobile, PDO::PARAM_INT);
$stmt->bindValue(':approach_preferred', $approach_preferred, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // 数値の場合 PDO::PARAM_INT

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