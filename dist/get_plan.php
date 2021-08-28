<?php
  // 全体のスケジュールの表示
  // index.jsからuserid, start, stopを取得
  $userid = $_GET["userid"];
  try {
    $dsn = 'mysql:dbname=bislab_db;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password); //データベースに接続
    $dbh->query('SET NAMES utf8'); //文字コードのための設定
    $sql = "SELECT begin,end FROM usertbl WHERE userid='".$userid."'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $dbh = null; //データベースから切断
}
catch(Exception $e){
  print 'サーバが停止しておりますので暫くお待ちくださ/い。';
  exit();
}
$time=$stmt->fetch(PDO::FETCH_ASSOC);

  try {
    $dsn = 'mysql:dbname=bislab_db;host=localhost';
    $user = 'root';
    $password = '';
    $dbh = new PDO($dsn, $user, $password); //データベースに接続
    $dbh->query('SET NAMES utf8'); //文字コードのための設定
    $sql = "SELECT planid,userid,title,templateid,start_date,end_date,progress FROM scheduletbl WHERE userid='".$userid."'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $dbh = null; //データベースから切断
}

catch(Exception $e){
    print 'サーバが停止しておりますので暫くお待ちください。';
    exit();
}
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

$k = array("planid", "title", "start", "end", "color");
$final = [];
$days = [];  //何日必要なのか?（各スケジュール）
$breaktime = 20; //休憩時間
$start_time = "";

for($i=0;$i<count($result);$i++){
  foreach ($result[$i] as $key => $value) {
    $value_all[] = $value;
    }
    if ($value_all[3] == 1){
      $color = "#EDAD0B";
      $task_time = [10,0.2,0.6,0.2];
      $task = ["内容書き出し,スライド,発表練習"];
    }elseif($value_all[3] == 2){
      $color = "#99CFE5";
      $task_time = [5,0.2,0.8,0];
      $task = ["調査,レポートを書く"];
    }else{
      $color = "#81C3A5";
      $task_time = [12,0.5,0.5,0];
      $task = ["テキストの復習,練習問題"];
    }
    // 期間の計算
    $Date_1 = $value_all[5]; //end
    $Date_2 = $value_all[4]; //start
    $Date_List_a1 = explode("-",$Date_1);
    $Date_List_a2=explode("-",$Date_2);
    $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
    $d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
    $Day=(int)round(($d1-$d2)/3600/24) + 1;  // 期間
    $days = $Day;

    $hour = round($task_time[0]/$Day, 1); //一日何時間必要か
    $min = (string)round($hour * 60, 1); // 分単位に変更 + breaktime
    $min_bre = $min + $breaktime;

    if($i == 0){
      $start_time = $value_all[4]."T".$time["begin"]; 
    }

    $value_re = array($value_all[0],$value_all[2],$start_time,$value_all[5], $color);
    $value_all = array();
    $start_time = (string)date("Y-m-d H:i",strtotime("$start_time + $min_bre minute  "));
    $start_time = str_replace(" ", "T", $start_time);
  
    $add_array = array_combine($k, $value_re);
    array_push($final,$add_array);
    
}
  header("Content-type: application/json; charset=UTF-8");
  //JSONデータを出力
  echo json_encode($final);
?>

