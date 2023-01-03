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
    <form method="post" action="insert.php">
        <div class="jumbotron" style = "padding: 30px;">
            <fieldset>
                <legend>メディア登録</legend>   
                <label>メディア種別：<select name="media_category">
                <option value="未選択" selected hidden>--選択してください--</option>
                    <option value="新聞(全国紙)">新聞(全国紙)</option>
                    <option value="新聞(ブロック紙)">新聞(ブロック紙)</option>
                    <option value="新聞(地方紙)">新聞(地方紙)</option>
                    <option value="新聞(経済紙・産業情報紙)">新聞(経済紙・産業情報紙)</option>
                    <option value="新聞(その他)">新聞(その他)</option>
                    <option value="雑誌">雑誌</option>
                    <option value="Webメディア">Webメディア</option>
                    <option value="TV">TV</option>
                    <option value="ラジオ">ラジオ</option>
                    <option value="その他">その他</option>
                </select></label><br>

                <label>媒体名：<input type="text" name="media_name"></label><br>
                <label>媒体社名：<input type="text" name="media_company_name"></label><br>
                <p style="font-size: 13px; color: #6F6F6F;">※正式名称で登録のこと。株式会社含む</p>
                <input type="submit" value="登録">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
