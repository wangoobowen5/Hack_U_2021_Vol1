<?php
    // 本来はデータベースから初期値を取ってくる
    $begin_time = "09:00";
    $end_time = "21:00";

    // user.php内の更新ボタンが押された場合の処理
    // データベースに保存する機能も必要
    if ($_POST["begin-time"] and $_POST["end-time"]) {
        $begin_time = $_POST["begin-time"];
        $end_time = $_POST["end-time"];

        // 無事にデータベースを更新できた場合に表示
        $update_text = "保存しました！";
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/user.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.css">
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script>
    <title>ユーザー設定</title>
</head>
<body>
    <header>
        <div class="header-rapper common-rapper">
            <div class="title">
                <h1><a href="./index.php" class="title-link">ラクスケ</a></h1>
            </div>
            <nav>
                <a href="./index.php" class="home nav-link">ホーム</a>
                <a href="./template.php" class="calendar nav-link">テンプレート</a>
                <a href="./user.php" class="btn-circle-border-simple nav-link"></a>
            </nav>
        </div>
    </header>

    <main>
        <div class="main-rapper common-rapper">
            <div class="main-content flex user-area">
                <div class="main-user flex">
                    <div class="btn-circle-border-simple"></div>
                    <h1 class="user-name">ユーザー名</h1>
                </div>
                <p><button class="logout-button common-button" id="logout-button">ログアウト</button></p>
            </div>
            <form class="main-content" method="post" action="user.php">
                <div class="schedule-area flex">
                    <div class="schedule-description">
                        <h2 class="schedule-title">予定を追加しても良い時間</h2>
                        <p class="schedule-text">入力した時間内に自動で予定を追加します。</p>
                    </div>
                    <div class="update-area">
                        <p class="update-text"><?= $update_text ?></p>
                        <p class="update-p"><input type="submit" value="保存" class="schedule-update-button common-button"></input></p>
                    </div>
                </div>
                <div class="schedule-time flex">
                    <div class="begin flex">
                        <h2 class="begin-text">開始</h2>
                        <!-- PHPで開始時間の初期値を入れる -->
                        <p><input type="text" id="begin-time" name="begin-time" class="time-input" value=<?= $begin_time ?>></p>
                    </div>
                    <h2 class="schedule-tilde">〜</h2>
                    <div class="end flex">
                        <h2 class="end-text">終了</h2>
                        <!-- PHPで開始時間の初期値を入れる -->
                        <p><input type="text" id="end-time" name="end-time" class="time-input" value=<?= $end_time ?>></p>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="./script/firebase.js" type="module"></script>
    <script src="./script/user.js" type="module"></script>
</body>
</html>