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