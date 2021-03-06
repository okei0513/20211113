<?php

session_start();
include('functions.php');
check_session_id(); // idチェック関数の実行
$pdo = connect_to_db();

$id = $_SESSION["id"];
$name = $_SESSION["name"];

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了ファースト画面</title>
</head>

<body>
    <header>
        <ul>
            <li><a href="user_entry.php"><?= $name ?></a></li>
            <!-- <li><a href="tsuchi.html">通知</a></li> -->
            <li><a href="login_logout.php">ログアウト</a></li>
        </ul>
    </header>

    <div>
        <!-- 新規グループ作成 -->
        <p><a href="new_group_name.php">グループを作成</a></p>
    </div>
    <div>
        <form action="" method="post">
            <p>グループを検索する<br>
                グループID：<input type="text"><button>確認</button>
            </p>
        </form>
    </div>
    <footer>
        <ul>
            <!-- <li><a href="top.php">戻る</a></li> -->
            <li><a href="group_select.php">次へ</a></li>
        </ul>
    </footer>



    <script>
        // ここからグループIDをコピーするJS
        function
        copyToClipboard() {
            //コピー対象をJavaScript上で変数として定義する
            var group_code = document.getElementById("group_code");
            //コピー対象のテキストを選択する
            group_code.select();
            //選択しているテキストをクリップボードにコピーする
            document.execCommand("Copy");
            //コピーをお知らせする
            alert("コピーできました！:" + group_code.value);
        }
    </script>

</body>

</html>