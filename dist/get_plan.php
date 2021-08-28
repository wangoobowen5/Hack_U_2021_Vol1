<?php
  // 全体のスケジュールの表示
  // index.jsからuserid, start, stopを取得
  $userid = $_GET["userid"];
  $start = $_GET["start"];
  $end = $_GET["end"];


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

for($i=0;$i<count($result);$i++){
  foreach ($result[$i] as $key => $value) {
    $value_all[] = $value;
    }

    if ($value_all[3] == 1){
      $color = "#EDAD0B";
    }elseif($value_all[3] == 2){
      $color = "#99CFE5";
    }else{
      $color = "#81C3A5";
    }

    $value_re = array($value_all[0],$value_all[2],$value_all[4],$value_all[5], $color);
    $add_array = array_combine($k, $value_re);
    $value_all = array();
    array_push($final,$add_array);
}

  header("Content-type: application/json; charset=UTF-8");
  //JSONデータを出力
  echo json_encode($final);
?>
