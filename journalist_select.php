<?php

function h($str){
  return htmlspecialchars($str, ENT_QUOTES);
}


//1.  DB接続します
require_once('funcs.php');
$pdo = db_connect();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM journalist_table");
$status = $stmt->execute();

//３．データ表示



$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  // else文内は、SQLが成功したときの処理
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){  //データから一行とってきてresultに格納
    $media_name = h($result['media_name']);
    $name = h($result['name']);
    $department = h($result['department']);
    $title = h($result['title']);
    $priority = h($result['priority']);
    $status = h($result['status']);
    $email = h($result['email']);
    $facebook = h($result['facebook']);
    $tel_mobile = h($result['tel_mobile']);
    $approach_preferred = h($result['approach_preferred']); 
    $date_registered =$result['date_registered'];    


    // $view .= "<p> {$result['journalist_id']} / {$media_id} / {$name} / {$department} / {$title} / {$priority} / {$status} / {$email} / {$facebook} / {$tel_mobile} / {$approach_preferred} </p>";

    $view .= "<tr>
    <td>{$result['journalist_id']}</td>
    <td>{$media_name}</td>
    <td>{$name}</td>
    <td>{$department}</td>    
    <td>{$title}</td> 
    <td>{$status}</td> 
    <td>{$priority}</td> 
    <td>{$email}</td> 
    <td>{$facebook}</td> 
    <td>{$tel_mobile}</td> 
    <td>{$approach_preferred} </td>
    <td>{$date_registered} </td>";
    $view .= '<td><a href="journalist_detail.php?id=' . $result['journalist_id'] . '"> [編集] </a></td>';
    $view .= '<td><a href="journalist_delete.php?id=' . $result['journalist_id'] . '"> [削除] </a></td>';
    $view .= "</tr>";
  }
}

?>




<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>記者一覧</title>
<link rel="stylesheet" href="./css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}

table{
  border-collapse:collapse;
font-size:14px;
color:#222;
margin:0 auto;
width:980px;
}
table td{
padding:10px 9px;
border:1px solid #999;
}
tr.top{
background:#000;
color:#fff;
font-size:16px;
font-weight:bold;
border-bottom:none;
}
tr.top td{
width:25%;
}
tr.one{
background:#eee;
}


</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">メディア登録</a>
        <a class="navbar-brand" href="select.php">メディア一覧</a>
        <a class="navbar-brand" href="index.php">記者登録</a></div>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>

    <div class="container jumbotron">
    <legend>記者一覧</legend>
    <table style = "padding: 10px; margin:0 auto; ">
        <tr>
          <th>ID</th>
          <th>媒体名</th>
          <th>名前</th>          
          <th>部署</th>
          <th>役職</th>
          <th>取材・露出</th>
          <th>優先度</th>
          <th>Email</th>
          <th>Facebook</th>
          <th>携帯電話</th>
          <th>連絡手段</th>
          <th>追加日</th>
          <!-- <th>最終接触日</th> -->
        </tr>

    <?= $view ?>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>
