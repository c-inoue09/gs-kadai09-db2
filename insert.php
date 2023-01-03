<?php

//1. POSTデータ取得

$media_category = $_POST['media_category'];
$media_name = $_POST['media_name'];
$media_company_name = $_POST['media_company_name'];

//2. DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_php02_submit;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO 
                      media_table(media_id, media_category, media_name, media_company_name) 
                      VALUES(NULL, :media_category, :media_name, :media_company_name) ");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':media_category', $media_category, PDO::PARAM_STR);
$stmt->bindValue(':media_name', $media_name, PDO::PARAM_STR);
$stmt->bindValue(':media_company_name', $media_company_name, PDO::PARAM_STR);

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
