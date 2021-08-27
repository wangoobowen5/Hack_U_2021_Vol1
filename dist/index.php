<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/locales-all.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-auth.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <title>Document</title>
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

    <div id="modal" class="modal">
        <div id="modal-content" class="modal-content">
            <div class="modal-body">
                <div class="modal-rappar flex-column">
                    <section class="modal-menu modal-section flex-row">
                        <p class="modal-menu-left"><button id="button-close">×</button></p>
                        <div class="modal-menu-right flex-row">
                            <p><button id="button-edit"><img src="./image/edit.png" alt="edit"></button></p>
                            <p><button id="button-edit"><img src="./image/basket.png" alt="basket"></button></p>
                        </div>
                    </section>
                    <section class="modal-section flex-column">
                        <h2>HackUプレゼン</h2>
                        <p>8/27（金）13:00 ~ 15:00</p>
                    </section>
                    <section class="modal-section flex-column">
                        <h3>今日の目標</h3>
                        <div class="flex-column">
                            <div class="flex-row">
                                <p>スライド作成</p>
                                <p><span>10</span>%</p>
                            </div>
                            <div class="flex-row">
                                <p>発表練習</p>
                                <p><span>20</span>%</p>
                            </div>
                        </div>
                    </section>
                    <section class="modal-section flex-column">
                        <h3>進捗</h3>
                        <div>
                            <div class="flex-row">
                                <p>内容箇条書き</p>
                                <div class="flex-row">
                                <p><input type="text"></p>
                                    <p> / 20%</p>
                                </div>
                            </div>
                            <div class="flex-row">
                                <p>スライド作成</p>
                                <div class="flex-row">
                                <p><input type="text"></p>
                                    <p> / 60%</p>
                                </div>
                            </div>
                            <div class="flex-row">
                                <p>発表練習</p>
                                <div class="flex-row">
                                <p><input type="text"></p>
                                    <p> / 20%</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="modal-buttons modal-section flex-row">
                        <p><button id="button-cancel">キャンセル</button></p>
                        <p><button id="button-save">保存</button></p>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div id="calendar" class="common-rapper"></div>
    </main>

    <script src="./script/firebase.js" type="module"></script>
    <script src="./script/index.js" type="module"></script>
</body>
</html>


<?php
$userid = $_POST['userid'];
try {
    $dsn = 'mysql:dbname=bislab_db;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password); //データベースに接続
    $dbh->query('SET NAMES utf8'); //文字コードのための設定
    $sql = "SELECT userid FROM usertbl WHERE userid='".$userid."'";

    $stmt = $dbh->prepare($sql);
            $stmt->execute();
            if($stmt->fetch(PDO::FETCH_BOTH)!=false){
                $a = 0;
            }
            else{
                $sql = "INSERT INTO usertbl (userid) values (?)";
                $stmt = $dbh->prepare($sql);
                $data[] = $userid;
                $stmt->execute($data);
            }
            $dbh = null; //データベースから切断
}
catch(Exception $e){
    print 'サーバが停止しておりますので暫くお待ちください。';
    exit();
}

?>