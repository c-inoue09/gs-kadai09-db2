<?php

function h($str){
  return htmlspecialchars($str, ENT_QUOTES);
}




//1.  DB接続します

require_once('funcs.php');
$pdo = db_connect();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM media_table");
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
    // $view .=  '<p>' . $result['id'] . '/' . h($result['name']) . '/' . h($result['email'])  .'</p>';

    $media_category = h($result['media_category']);
    $media_name = h($result['media_name']);
    $media_company_name = h($result['media_company_name']);
    // $view .= "<p> {$result['media_id']} / {$media_category} / {$media_name} / {$media_company_name} </p>";
    //$view .= "<tr><td>{$result['media_id']}</td><td>{$media_category}</td><td>{$media_name}</td><td>{$media_company_name}</td></tr>";

    $view .= '<tr><td>';
    $view .= "{$result['media_id']}";
    $view .= '</td><td>';
    $view .= "{$media_category}";
    $view .= '</td><td>';
    $view .= "{$media_name}";
    $view .= '</td><td>';
    $view .= "{$media_company_name}";
    $view .= '</td><td>';
    $view .= '<a href="media_detail.php?id=' . $result['media_id'] . '"> [編集] </a>';
    $view .= '</td><td>';
    $view .= '<a href="media_delete.php?id=' . $result['media_id'] . '"> [削除] </a>';
    $view .= '</td></tr>';

  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>登録メディア表示</title>
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
        <a class="navbar-brand" href="media_register.php">メディア登録</a>
        <a class="navbar-brand" href="index.php">記者登録</a>
        <a class="navbar-brand" href="journalist_select.php">記者一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  
    <div class="container jumbotron">
      <table style = "padding: 10px; margin:0 auto; width:600px; ">
        <tr>
          <th>ID</th>
          <th>媒体種別</th>
          <th>媒体名</th>
          <th>媒体社名</th>
        </tr>
        <?= $view ?>

      </table>

    </div>
</div>
<!-- Main[End] -->

</body>
</html>
