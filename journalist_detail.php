<?php

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */


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
$stmt = $pdo->prepare('SELECT * FROM journalist_table WHERE journalist_id =:id;');
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
                <div class="navbar-header">
                    <a class="navbar-brand" href="media_register.php">メディア登録</a>
                    <a class="navbar-brand" href="select.php">メディア一覧</a>
                <a class="navbar-brand" href="journalist_select.php">記者一覧</a>
            </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="journalist_update.php">
        <div class="jumbotron" style = "padding: 30px;">
            <fieldset>
                <legend>「<?= $result['name']?>」を編集中</legend>   
                <label>メディア名：
                <?php // ①配列にデータを設定
                try {
                    //ID:'root', Password: xamppは 空白 ''
                    $pdo = new PDO('mysql:dbname=gs_php02_submit;charset=utf8;host=localhost','root','');
                    } catch (PDOException $e) {
                    exit('DBConnectError:'.$e->getMessage());
                }
                
                $sql = 'select * from journalist_table';
                $data ="";
                 
                if ($stmt = $pdo->query($sql)) {
                foreach($stmt as $data_val){
                    $data .= "<option value='". $data_val['media_name'];
                    $data .= "'>". $data_val['media_name']. "</option>";
                    }
                }                
                ?>

                <select name='media_name'>
                <?php // ③optionタグを出力
                echo $data; ?>
                </select></label><br>
                <p style="font-size: 13px; color: #6F6F6F;">※該当するメディアがない場合は「メディア登録」から登録してください</p>

                <label>氏名：<input type="text" name="name" value ="<?= $result['name']?>"></label><br>
                <label>部署名：<input type="text" name="department" value="<?= $result['department'] ?>"></label><br>
                <label>肩書：<input type="text" name="title" value="<?= $result['title'] ?>"></label><br>
                <label>優先度：<select name="priority" value="<?= $result['priority'] ?>">
                    <option value="未選択">--選択してください--</option>
                    <option value="低" <?= $result['priority'] == '低' ? 'selected' : "" ?> >低</option>
                    <option value="中" <?= $result['priority'] == '中' ? 'selected' : "" ?> >中</option>
                    <option value="高" <?= $result['priority'] == '高' ? 'selected' : "" ?> >高</option>
                    </select>
                </label><br>
                <label>取材・露出：<select name="status">                    
                    <option value="未選択">--選択してください--</option>
                    <option value="未接触" <?= $result['status'] == '未接触' ? 'selected' : "" ?> >未接触</option>
                    <option value="面会済" <?= $result['status'] == '面会済' ? 'selected' : "" ?> >面会済</option>
                    <option value="記事化" <?= $result['status'] == '記事化' ? 'selected' : "" ?> >記事化</option>
                </select>
                </label><br>
                <label>Email：<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
                <label>Facebook URL：<input type="text" name="facebook" value="<?= $result['facebook'] ?>"></label><br>
                <label>携帯電話：<input type="text" name="tel_mobile" value="<?= $result['tel_mobile'] ?>"></label><br>
                <label>連絡手段：<input type="text" name="approach_preferred"  value="<?= $result['approach_preferred'] ?>"></label><br>
                <!-- <label>追加年：<input type="text" name="date_registered"></label><br> -->
                <!--<label>最終接触日：<input type="text" name="date_updated"></label><br>
                 -->
                <input type="hidden" name="journalist_id" value="<?= $result['journalist_id'] ?>">
                <input type="submit" value="登録">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
