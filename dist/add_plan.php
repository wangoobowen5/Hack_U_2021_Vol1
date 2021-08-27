<?php
// useridの追加
$userid = $_POST["userid"];
$title = $_POST["title"];
$templateid = (int)$_POST["templateid"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

if($templateid == 1){
    $progress = "内容書き出し:0,スライド:0,発表練習:0";
}
elseif($templateid == 2){
    $progress = "調査:20,レポートを書く:80";
}
elseif($templateid == 3){
    $progress = "テキストの復習:50,練習問題:50";
}

try {
    $dsn = 'mysql:dbname=bislab_db;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password); //データベースに接続
    $dbh->query('SET NAMES utf8'); //文字コードのための設定
    $sql1 = "SELECT userid FROM usertbl WHERE userid='".$userid."'";

    $stmt = $dbh->prepare($sql1);
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

            $sql2 = "INSERT INTO scheduletbl (userid,title,templateid,start_date,end_date,progress) values (?,?,?,?,?,?)";
            $stmt = $dbh->prepare($sql2);
            $data[] = $userid;
            $data[] = $title;
            $data[] = $templateid;
            $data[] = $start_date;
            $data[] = $end_date;
            $data[] = $progress;
            $stmt->execute($data);
        

    $dbh = null; //データベースから切断
}

catch(Exception $e){
    print 'サーバが停止しておりますので暫くお待ちください。';
    exit();
}

header("Location: /Hack_U_2021_Vol1/dist/index.php"); 
?>

