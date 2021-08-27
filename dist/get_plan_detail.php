<?php
    $planid = $_POST['planid'];

    try{
        $dsn = 'mysql:dbname=bislab_db;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password); //データベースに接続
        $dbh->query('SET NAMES utf8'); //文字コードのための設定
        $sql1 = "SELECT templateid,start_date,end_date,progress FROM scheduletbl WHERE planid = '".$planid."'";
        $stmt = $dbh->prepare($sql1);
        $stmt->execute();
        $dbh = null; //データベースから切断
    }
    catch(Exception $e){
        print 'サーバが停止しておりますので暫くお待ちください。';
        exit();
    }
    $rec = $stmt->fetch(PDO::FETCH_BOTH);
    $progress = $rec['progress'];

    $list = array(
        'goal' => '内容書き出し:10,スライド:20',
        'progress' => $progress,
        'task' => '内容書き出し:20,スライド:60,発表練習:20'
    );
    // 明示的に指定しない場合は、text/html型と判断される
    header("Content-type: application/json; charset=UTF-8");
    //JSONデータを出力
    echo json_encode($list);
?>