<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

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
$date_registered = $_POST['date_registered'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_connect();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO 
                      journalist_table(journalist_id, media_name, name, department, title, status, priority, email, facebook, tel_mobile, approach_preferred, date_registered, date_updated) 
                      VALUES(NULL, :media_name, :name, :department, :title, :status, :priority, :email, :facebook, :tel_mobile, :approach_preferred, sysdate(), sysdate()) ");

// バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':media_name', $media_name, PDO::PARAM_STR);
$stmt->bindValue(':department', $department, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':facebook', $facebook, PDO::PARAM_STR);
$stmt->bindValue(':tel_mobile', $tel_mobile, PDO::PARAM_INT);
$stmt->bindValue(':approach_preferred', $approach_preferred, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status === false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:'.$error[2]);
}else{
  //５．index.php,へリダイレクト

header('Location: index.php');

}
?>
