<?php
    $month = array(
        'Jan'=> '01',
        'Feb'=> '02',
        'Mar'=> '03',
        'Apr'=> '04',
        'May'=> '05',
        'Jun'=> '06',
        'Jul'=> '07',
        'Aug'=> '08',
        'Sep'=> '09',
        'Oct'=> '10',
        'Nov'=> '11',
        'Dec'=> '12'
    );

    $planid = $_POST['planid'];
    $date = $_POST['date'];

    // scheduletbl接続
    try{
        $dsn = 'mysql:dbname=bislab_db;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password); //データベースに接続
        $dbh->query('SET NAMES utf8'); //文字コードのための設定
        $sql_schedule = "SELECT templateid,start_date,end_date,progress FROM scheduletbl WHERE planid = '".$planid."'";
        $stmt_schedule = $dbh->prepare($sql_schedule);
        $stmt_schedule->execute();
        $dbh = null; //データベースから切断
    }
    catch(Exception $e){
        print 'サーバが停止しておりますので暫くお待ちください。';
        exit();
    }
    $rec_schedule = $stmt_schedule->fetch(PDO::FETCH_BOTH);
    $templateid = $rec_schedule['templateid'];
    $start_date = new DateTime($rec_schedule['start_date']);
    $end_date = new DateTime($rec_schedule['end_date']);
    $progress = $rec_schedule['progress'];

    // templatetbl接続
    try{
        $dsn = 'mysql:dbname=bislab_db;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password); //データベースに接続
        $dbh->query('SET NAMES utf8'); //文字コードのための設定
        $sql_template = "SELECT task FROM templatetbl WHERE templateid = '".$templateid."'";
        $stmt_template = $dbh->prepare($sql_template);
        $stmt_template->execute();
        $dbh = null; //データベースから切断
    }
    catch(Exception $e){
        print 'サーバが停止しておりますので暫くお待ちください。';
        exit();
    }
    $rec_template = $stmt_template->fetch(PDO::FETCH_BOTH);
    $task = $rec_template['task'];

    // クリックした日付とend_dateの差
    $date = explode(' ', $date);
    $date = $date[3] . '-' . $month[$date[1]] . '-' . $date[2];
    $date = new DateTime($date);
    $diff = $end_date->diff($date)->format('%a') + 1;

    // 合計進捗率を算出
    $explode_progress = explode(',', $progress);
    $explode_task = explode(',', $task);
    $sum_progress_ratio = 0;
    for($i=0; $i<count($explode_progress); $i++) {
        $sum_progress_ratio += (int)(explode(':', $explode_progress[$i])[1]);
    };


    $ratio = (int)((100 - $sum_progress_ratio) / $diff);
    $goal = '';
    for($i=0; $i<count($explode_progress); $i++) {
        $temp_val = (int)(explode(':', $explode_task[$i])[1]) - (int)(explode(':', $explode_progress[$i])[1]);
        if ($temp_val == 0) {
            continue;
        }
        if ($ratio > $temp_val) {
            $ratio -= $temp_val;
            $goal = $goal . explode(':', $explode_task[$i])[0] . ':' . $temp_val . ',';
        } else {
            $goal = $goal . explode(':', $explode_task[$i])[0] . ':' . $ratio;
            break;
        }
    }

    $list = array(
        'goal' => $goal,
        'progress' => $progress,
        'task' => $task
    );
    // 明示的に指定しない場合は、text/html型と判断される
    header("Content-type: application/json; charset=UTF-8");
    //JSONデータを出力
    echo json_encode($list);
?>