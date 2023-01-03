<?php

//1. POSTデータ取得

$id = $_GET['id'];
// $media_category = $_POST['media_category'];
// $media_name = $_POST['media_name'];
// $media_company_name = $_POST['media_company_name'];

// DB接続
require_once('funcs.php');
$pdo = db_connect();

//３．データ登録SQL作成

// SQL文を用意

// WHERE id=:idを利用して、１つだけ情報を取得
$stmt = $pdo->prepare('SELECT * FROM media_table WHERE media_id =:id;');
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

// データ表示
$result = '';
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

// header('Location: index.php');


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>



    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">メディア一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="journalist_select.php">記者一覧</a></div>
                <div class="navbar-header"><a class="navbar-brand" href="index.php">記者登録</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="media_update.php">
        <div class="jumbotron" style = "padding: 30px;">
            <fieldset>
                <legend>「<?= $result['media_name']?>」を編集中</legend>   
                <p>ID： No.<?= $result['media_id']?></p>
                <label>メディア種別：<select name="media_category" value ="<?= $result['media_category']?>">
                <option value="未選択">--選択してください--</option>
                    <option value="新聞(全国紙)" <?= $result['media_category'] == '新聞(全国紙)' ? 'selected' : "" ?>>新聞(全国紙)</option>
                    <option value="新聞(ブロック紙)" <?= $result['media_category'] == '新聞(ブロック紙)' ? 'selected' : "" ?>>新聞(ブロック紙)</option>
                    <option value="新聞(地方紙)" <?= $result['media_category'] == '新聞(地方紙)' ? 'selected' : "" ?>>新聞(地方紙)</option>
                    <option value="新聞(経済紙・産業情報紙)" <?= $result['media_category'] == '新聞(経済紙・産業情報紙)' ? 'selected' : "" ?>>新聞(経済紙・産業情報紙)</option>
                    <option value="新聞(その他)" <?= $result['media_category'] == '新聞(その他)' ? 'selected' : "" ?>>新聞(その他)</option>
                    <option value="雑誌" <?= $result['media_category'] == '雑誌' ? 'selected' : "" ?>>雑誌</option>
                    <option value="Webメディア" <?= $result['media_category'] == 'Webメディア' ? 'selected' : "" ?>>Webメディア</option>
                    <option value="TV" <?= $result['media_category'] == 'TV' ? 'selected' : "" ?>>TV</option>
                    <option value="ラジオ" <?= $result['media_category'] == 'ラジオ' ? 'selected' : "" ?>>ラジオ</option>
                    <option value="その他" <?= $result['media_category'] == 'その他' ? 'selected' : "" ?>>その他</option>
                </select></label><br>

                <label>媒体名：<input type="text" name="media_name" value ="<?= $result['media_name']?>"></label><br>
                <label>媒体社名：<input type="text" name="media_company_name" value ="<?= $result['media_company_name']?>"></label><br>
                <p style="font-size: 13px; color: #6F6F6F;">※正式名称で登録のこと。株式会社含む</p>
                <input type="hidden" name="media_id" value="<?= $result['media_id'] ?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
