<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）

function db_connect(){
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=gs_php02_submit;charset=utf8;host=localhost','root','');  
        return $pdo;
      } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
      }
}


?>