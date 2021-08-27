<?php
$userid = $_POST["userid"];
$scheduleName = $_POST["scheduleName"];
$templateName = $_POST["templateName"];
$start_date = $_POST["start-Date"];
$end_date = $_POST["end-date"];

try{
    $dsn = 'mysql:dbname=bislab_db;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password); //データベースに接続
    $dbh->query('SET NAMES utf8'); //文字コードのための設定
    $sql2 = "SELECT userid,begin,end  FROM usertbl WHERE userid='".$userid."'";
    $stmt = $dbh->prepare($sql2);
    $stmt->execute();

    $sql3 = "UPDATE usertbl set begin = '".$begin_time."' WHERE userid='".$userid."'";
    $stmt = $dbh->prepare($sql3);
    $stmt->execute();

    $sql4 = "UPDATE usertbl set end = '".$end_time."' WHERE userid='".$userid."' ";
    $stmt = $dbh->prepare($sql4);
    $stmt->execute();
    $dbh = null; //データベースから切断

    $update_text = "保存しました！";
}
catch(Exception $e){
    print 'サーバが停止しておりますので暫くお待ちください。';
    exit();
}


?>



var data = {
                "userid": user.uid,
                "scheduleName": scheduleName,
                "templateName": templateName,
                "start-date": startDate,
                "end-date": endDate
            };
            post('/Hack_U_2021_Vol1/dist/index.php', data);