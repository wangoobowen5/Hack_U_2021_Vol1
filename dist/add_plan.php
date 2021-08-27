<?php
// useridの追加
$userid = $_POST["userid"];
$title = $_POST["title"];
$templateid = $_POST["templateid"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

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

            $sql2 = "INSERT INTO templatetbl (userid,title,templateid,start_date,end_date) values (?,?,?,?,?)";
            $stmt = $dbh->prepare($sql2);
            $data[] = $userid;
            $data[] = $title;
            $data[] = $templateid;
            $data[] = $start_date;
            $data[] = $end_date;
            $stmt->execute($data);
        

    $dbh = null; //データベースから切断
}

catch(Exception $e){
    print 'サーバが停止しておりますので暫くお待ちください。';
    exit();
}
?>

