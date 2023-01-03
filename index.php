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
    <form method="post" action="journalist_insert.php">
        <div class="jumbotron" style = "padding: 30px;">
            <fieldset>
                <legend>記者登録</legend>
                <label>メディア名：
                <?php // ①配列にデータを設定
                try {
                    //ID:'root', Password: xamppは 空白 ''
                    $pdo = new PDO('mysql:dbname=gs_php02_submit;charset=utf8;host=localhost','root','');
                    } catch (PDOException $e) {
                    exit('DBConnectError:'.$e->getMessage());
                }
                
                $sql = 'select * from media_table';
                $data ='<option value="未選択" selected hidden>--選択してください--</option>';
                 
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

                <label>氏名：<input type="text" name="name"></label><br>
                <label>部署名：<input type="text" name="department"></label><br>
                <label>肩書：<input type="text" name="title"></label><br>
                <label>優先度：<select name="priority">
                    <option value="未選択" selected hidden>--選択してください--</option>
                    <option value="低">低</option>
                    <option value="中">中</option>
                    <option value="高">高</option>
                    </select>
                </label><br>

                <label>取材・露出：<select name="status">                    
                    <option value="未選択" selected hidden>--選択してください--</option>
                    <option value="未接触">未接触</option>
                    <option value="面会済">面会済</option>
                    <option value="記事化">記事化</option>
                </select>
                </label><br>
                <label>Email：<input type="text" name="email"></label><br>
                <label>Facebook URL：<input type="text" name="facebook"></label><br>
                <label>携帯電話：<input type="text" name="tel_mobile"></label><br>
                <label>連絡手段：<input type="text" name="approach_preferred"></label><br>
                 <!-- <label>追加年：<input type="text" name="date_registered"></label><br> -->
                <!--<label>最終接触日：<input type="text" name="date_updated"></label><br>
                 -->

                <input type="submit" value="登録">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
